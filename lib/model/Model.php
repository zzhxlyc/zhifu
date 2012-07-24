<?php

class Model{
	
	private static $models = array();
	
	private $DB;
	public $_fuzzy = 'both';
	public $_join = 'AND';
	public $last_sql;
	public $affect_num;
	
	function Model(){
		global $DB;
		$this->DB = $DB;
	}
	
	public static function load_model($model){
		$file = MODEL_DIR."/$model.php";
		if(file_exists($file) && !in_array($model, self::$models)){
			include($file);
			self::$models[] = $model;
		}
	}
	
	public static function load(array $models){
		foreach($models as $model){
			self::load_model($model);
		}
	}
	
	private function split_word($str){
		$r = explode(' ', $str);
		$a = array();
		foreach($r as $v){
			if(!empty($v)){
				$a[] = $v;
			}
		}
		return $a;
	}
	
	private function _get_table_name(){
		$db_name = $this->DB->get_database_name();
		return "`$db_name`.`$this->table`";
	}
	
	private function _get_table_field($key){
		if(strpos($key, '.') !== false){
			$r = explode('.', $key);
			if(count($r) == 2){
				$table = $r[0];
				$field = $r[1];
			}
		}
		else{
			$field = trim($key);
		}
		if(!empty($table)){
			return " `$table`.".$this->_get_field($field);
		}
		else{
			return $this->_get_field($field);
		}
	}
	
	private function _get_field($field){
		if($field == '*') return '*';
		else if($field == '1') return '1';
		else return "`$field`";
	}
	
	private function _get_value($value){
		if(is_string($value)) return "'$value'";
		else return $value;
	}
	
	private function build_field($field_array){
		$sql = '';
		$len = count($field_array);
		$i = -1;
		foreach($field_array as $key){
			$i++;
			$_key = strtolower($key);
			$table = $field = $alias = '';
			if(strpos($_key, 'as') === false){
				$field = trim($key);		
			}
			else{
				$r = $this->split_word($key);
				if(count($r) == 3 && strtolower($r[1]) == 'as'){
					$field = trim($r[0]);
					$alias = trim($r[2]);
				}
			}
			if(!empty($field)){
				$sql .= $this->_get_table_field($field);
				if(!empty($alias)){
					$sql .= " AS `$alias` ";
				}
				if($i < $len - 1){
					$sql .= ',';
				}
			}
		}
		return $sql;
	}
	
	private function build_table($table_array){
		$sql = '';
		$len = count($table_array);
		$i = -1;
		foreach($table_array as $key){
			$i++;
			$_key = strtolower($key);
			$table = $alias = '';
			if(strpos($_key, 'as') === false){
				$table = trim($key);		
			}
			else{
				$r = $this->split_word($key);
				if(count($r) == 3 && strtolower($r[1]) == 'as'){
					$table = trim($r[0]);
					$alias = trim($r[2]);
				}
			}
			if(!empty($table)){
				$sql .= " `$table` ";
				if(!empty($alias)){
					$sql .= " AS `$alias` ";
				}
				if($i < $len - 1){
					$sql .= ',';
				}
			}
		}
		return $sql;
	}
	
	private function _make_array_to_string(&$array){
		$id_array = array();
		foreach($array as $id){
			$id_array[] = intval($id);
		}
		$id_array = array_unique($id_array);
		return implode(',', $id_array);
	}
	
	private function build_condition($condition){
		$sql = '';
		$len = count($condition);
		$i = -1;
		foreach($condition as $key => $cond){
			$i++;
			$field = $op = '';
			$key = trim($key);
			if(strpos($key, ' ') === false){
				$field = $key;
				$op = '=';
			}
			else{
				$r = explode(' ', $key);
				$rcopy = $r;
				foreach($rcopy as $index => $rr){
					if(empty($rr)){
						unset($r[$index]);
					}
				}
				$count = count($r); 
				if($count == 1){
					$field = trim($key);
					$op = '=';
				}
				else if($count == 2){
					$field = array_shift($r);
					$op = array_shift($r);
				}
				else{
					continue;
				}
			}
			if(!empty($field) && !empty($op)){
				$field = $this->_get_table_field($field);
				$op = strtolower($op);
				if($op == 'in'){
					if(is_array($cond) && count($cond) > 0){
						$ids = $this->_make_array_to_string($cond);
						$cond = "($ids)";
					}
					else{
						if(strpos($cond, ',') === false){
							$id = intval($cond);
							$cond = "($id)";
						}
						else{
							$id_list = explode(',', $cond);
							$ids = $this->_make_array_to_string($id_list);
							$cond = "($ids)";
						}
					}
					$sql .= " $field $op $cond ";
				}
				else if($op == 'like'){
					if($this->_fuzzy == 'both'){
						$cond = "%$cond%";
					}
					else if($this->_fuzzy == 'left'){
						$cond = "%$cond";
					}
					else if($this->_fuzzy == 'right'){
						$cond = "$cond%";
					}
					$sql .= " $field $op '$cond' ";
				}
				else if(is_string($cond)){
					if(strpos($key, '.') !== false && strpos($cond, '.') !== false){
						$other_field = $this->_get_table_field($cond);
						$sql .= " $field $op $other_field ";
					}
					else {
						$sql .= " $field $op '$cond' ";
					}
				}
				else{
					$sql .= " $field $op $cond ";
				}
				if($i < $len - 1){
					$sql .= " $this->_join ";
				}
			}
		}
		return $sql;
	}
	
	private function build_set($set_array){
		$sql = '';
		$len = count($set_array);
		$i = -1;
		$op = '=';
		$join = ',';
		foreach($set_array as $key => $value){
			$i++;
			$field = $key;
			if(!empty($field) && !empty($op)){
				$field = $this->_get_field($field);
				if($op == '='){
					$value = $this->_get_value($value);
					$sql .= " $field $op $value ";
				}
				if($i < $len - 1){
					$sql .= " $join ";
				}
			}
		}
		return $sql;
	}
	
	private function build_order($order){
		$sql = '';
		$len = count($order);
		$i = -1;
		foreach($order as $key => $cond){
			$i++;
//			$field = $this->_get_field($key);
			$field = $this->_get_table_field($key);
			$ordr = strtolower($cond);
			if($ordr == 'desc'){
				$sql .= " $field DESC ";
			}
			else if($ordr == 'asc'){
				$sql .= " $field ASC ";
			}
			if($i < $len - 1){
				$sql .= ',';
			}
		}
		return $sql;
	}
	
	private function _convert($std){
		if($std){
			$className = get_class($this);
			$obj = new $className();
			if(is_object($std) || is_array($std)){
				foreach($std as $n => $v){
					$obj->$n = $v;
				}
			}
			return $obj;
		}
		return null;
	}
	
	public function get($id){
		$id = intval($id);
		$db_name = $this->_get_table_name();
		$sql = "SELECT * FROM $db_name WHERE `id` = $id";
		$this->last_sql = $sql;
		$std = $this->DB->get_row($sql);
		return $this->_convert($std);
	}
	
	public function get_row($condition = array(), $order = array()){
		$sql = 'SELECT * FROM '.$this->_get_table_name();
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.$this->build_condition($condition);
		}
		if(is_array($order) && count($order) > 0){
			$sql .= ' ORDER BY '.$this->build_order($order);
		}
		$sql .= ' LIMIT 1';
		$this->last_sql = $sql;
		$std = $this->DB->get_row($sql);
		return $this->_convert($std);
	}
	
	public function count(array $condition = null){
		$sql = 'SELECT count(*) as count FROM '.$this->_get_table_name();
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.$this->build_condition($condition);
		}
		$this->last_sql = $sql;
		$std = $this->DB->get_row($sql);
		$count = $std->count;
		$this->affect_num = $count;
		return $count;
	}
	
	public function get_page($condition = array(), $order = array(), $page, $page_num){
		if($page <= 1) $page = 1;
		if($page_num <= 0) $page_num = 10;
		$limit = array(($page - 1) * $page_num, $page_num);
		return $this->get_list($condition, $order, $limit);
	}

	public function get_list($condition = array(), $order = array(), $limit = ''){
		$sql = 'SELECT * FROM '.$this->_get_table_name();
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.$this->build_condition($condition);
		}
		if(is_array($order) && count($order) > 0){
			$sql .= ' ORDER BY '.$this->build_order($order);
		}
		if(!empty($limit)){
			if(is_int($limit)){
				$sql .= ' LIMIT '.$limit;
			}
			else if(is_array($limit) && count($limit) == 2){
				$sql .= ' LIMIT '.$limit[0].','.$limit[1];
			}
		}
		$this->last_sql = $sql;
		$list = $this->DB->get_list($sql);
		$count = count($list);
		for($i = 0;$i < $count;$i++){
			$list[$i] = $this->_convert($list[$i]);
		}
		return $list;
	}
	
	public function get_joins($fields = array(), $tables = array(), 
					$condition = array(), $order = array(), $limit = ''){
		$sql = 'SELECT ';
		if(is_array($fields) && count($fields) > 0){
			$sql .= $this->build_field($fields);
		}
		$sql .= ' FROM ';
		if(is_array($tables) && count($tables) > 0){
			$sql .= $this->build_table($tables);
		}
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.$this->build_condition($condition);
		}
		if(is_array($order) && count($order) > 0){
			$sql .= ' ORDER BY '.$this->build_order($order);
		}
		if(!empty($limit)){
			if(is_int($limit)){
				$sql .= ' LIMIT '.$limit;
			}
			else if(is_array($limit) && count($limit) == 2){
				$sql .= ' LIMIT '.$limit[0].','.$limit[1];
			}
		}
		$this->last_sql = $sql;
		$list = $this->DB->get_list($sql);
		$count = count($list);
		for($i = 0;$i < $count;$i++){
			$list[$i] = $this->_convert($list[$i]);
		}
		return $list;
	}

	/*
	 * delete with id or id array
	 * $param = $id, or array of id
	 */
	public function delete($param){
		$table = $this->_get_table_name();
		if(is_int($param) || is_string($param)){
			$id = intval($param);
			if($id <= 0) return -1;
			$sql = "DELETE FROM $table WHERE `id` = $id";
		}
		else if(is_array($param) && count($param) > 0){
			for($i = 0;$i < count($param);$i++){
				$param[$i] = intval($param[$i]);
			}
			$ids = implode(',', $param);
			$sql = "DELETE FROM $table WHERE `id` in ($ids)";
		}
		else{
			return;
		}
		$this->last_sql = $sql;
		$this->affect_num = $this->DB->query($sql);
		return $this->affect_num;
	}
	
	/*
	 * delete with conditions
	 * $condition = array('field [op]' => 'value', )
	 */
	public function delete_all($condition){
		$sql = 'DELETE FROM '.$this->_get_table_name();
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.$this->build_condition($condition);
		}
		else{
			return;
		}
		$this->last_sql = $sql;
		$this->affect_num = $this->DB->query($sql);
	}
	
	public function update($set, $condition, $order = array(), $limit = ''){
		$sql = 'UPDATE '.$this->_get_table_name();
		if(is_array($set) && count($set) > 0){
			$sql .= ' SET '.$this->build_set($set);
		}
		else{
			return;
		}
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.$this->build_condition($condition);
		}
		else{
			return ;
		}
		if(is_array($order) && count($order) > 0){
			$sql .= ' ORDER BY '.$this->build_order($order);
		}
		if(!empty($limit)){
			if(is_int($limit)){
				$sql .= ' LIMIT '.$limit;
			}
			else if(is_array($limit) && count($limit) == 2){
				$sql .= ' LIMIT '.$limit[0].','.$limit[1];
			}
		}
		$this->last_sql = $sql;
		$this->affect_num = $this->DB->query($sql);
		return $this->affect_num;
	}
	
	public function save($data){
		$sql = 'INSERT INTO '.$this->_get_table_name();
		if(is_array($data) && count($data) > 0){
			if(array_key_exists('id', $data)){
				$condition = array('id'=>$data['id']);
				$new_data = $data;
				unset($new_data['id']);
				$this->update($new_data, $condition);
				return 0;
			}
			$sql .= '(';
			$fields = $values = array();
			foreach($data as $k => $v){
				$i++;
				$fields[] = $this->_get_field($k);
				$values[] = $this->_get_value($v);
			}
			$sql .= implode(',', $fields);
			$sql .= ') VALUES(';
			$sql .= implode(',', $values);
			$sql .= ')';
		}
		else{
			return -1;
		}
		$this->last_sql = $sql;
		$id = $this->DB->insert($sql);
		return $id;
	}
	
	public function query($sql){
		$this->last_sql = $sql;
		return $this->DB->query($sql);
	}
	
	public function select($sql){
		$this->last_sql = $sql;
		return $this->DB->get_list($sql);
	}
	
	protected function _check_get_value(&$data, $name){
		if(is_object($data)){
			return $data->$name;
		}
		else if(is_array($data)){
			return $data[$name];
		}
	}
	
	protected function _check_set_value(&$data, $name, $value){
		if(is_object($data)){
			$data->$name = $value;
		}
		else if(is_array($data)){
			$data[$name] = $value;
		}
	}
	
	public function check(&$data, array $check_arrays, array $ignore = array()){
		$must_need = $check_arrays['need'];
		$length_check = $check_arrays['length'];
		$must_int = $check_arrays['int'];
		$must_number = $check_arrays['number'];	//int or double
		$email = $check_arrays['email'];
		if(is_array($ignore) && count($ignore) > 0){
			$must_need = array_diff($must_need, $ignore);
			$length_check = array_diff($length_check, $ignore);
			$must_int = array_diff($must_int, $ignore);
			$email = array_diff($email, $ignore);
		}
		$error = array();
		if($must_need){
			foreach($must_need as $field){
				$v = $this->_check_get_value($data, $field);
				if(empty($error[$field]) && strlen($v) == 0){
					$error[$field] = "不能为空";
				}
			}
		}
		if($length_check){
			foreach($length_check as $field => $length){
				$v = $this->_check_get_value($data, $field);
				if(empty($error[$field]) && strlen($v) > $length){
					$error[$field] = "不能超过{$length}个字符";
				}
			}
		}
		if($must_int){
			$must_int[] = 'id';
			foreach($must_int as $field){
				$v = $this->_check_get_value($data, $field);
				if(empty($error[$field]) && strlen($v) > 0){
					if($v != '0'){
						$r = intval($v);
						if($r == 0){
							$error[$field] = "不是整数";
							continue;
						}
					}
					$this->_check_set_value($data, $field, 
								intval($this->_check_get_value($data, $field)));
				}
			}
		}
		if($must_number){
			foreach($must_number as $field){
				$v = $this->_check_get_value($data, $field);
				if(empty($error[$field]) && strlen($v) > 0){
					if($v != '0'){
						$r = doubleval($v);
						if($r == 0){
							$error[$field] = "不是数";
							continue;
						}
					}
					$this->_check_set_value($data, $field, 
								intval($this->_check_get_value($data, $field)));
				}
			}
		}
		if($email){
			foreach($email as $field){
				$v = $this->_check_get_value($data, $field);
				if(empty($error[$field]) && strlen($v) > 0){
					if(!StringUtils::check_email($v)){
						$error[$field] = "邮箱格式不正确";
					}
				}
			}
		}
		return $error;
	}
	
	public function escape(&$data, array $escape_array, array $ignore){
		$url = $escape_array['url'];
		$string = $escape_array['string'];
		$html = $escape_array['html'];
		if(is_array($ignore) && count($ignore) > 0){
			$url = array_diff($url, $ignore);
			$string = array_diff($string, $ignore);
			$html = array_diff($html, $ignore);
		}
		if($string){
			foreach($string as $field){
				$v = $this->_check_get_value($data, $field);
				if($v){
					$v = esc_text($v);
					$this->_check_set_value($data, $field, $v);
				}
			}
		}
		if($url){
			foreach($url as $field){
				$v = $this->_check_get_value($data, $field);
				if($v){
					$v = esc_html($v);
					$v = esc_url($v);
					$this->_check_set_value($data, $field, $v);
				}
			}
		}
		if($html){
			foreach($html as $field){
				$v = $this->_check_get_value($data, $field);
				if($v){
					$v = addslashes($v);
					$this->_check_set_value($data, $field, $v);
				}
			}
		}
	}
	
	public function format(array $format_array){
		$string = $format_array['string'];
		$url = $format_array['url'];
		$html = $format_array['html'];
		if($string){
			foreach($string as $field){
				$v = $this->$field;
				if($v){
					$this->$field = esc_attr($v);
				}
			}
		}
		if($url){
			foreach($url as $field){
				$v = $this->$field;
				if($v){
					$v = esc_textarea($v);
					$v = esc_url($v);
					$this->$field = $v;
				}
			}
		}
		if($html){
			foreach($html as $field){
				$v = $this->$field;
				if($v){
					$this->$field = esc_textarea($v);
				}
			}
		}
	}
	
}

function Model_TEST($model){
	$model->get(1);
	echo '1:'.$model->last_sql.'<br>';
	$model->get_row(array('id'=>1));
	echo '2:'.$model->last_sql.'<br>';
	$model->get_row(array('id  '=>1));
	echo '3:'.$model->last_sql.'<br>';
	$model->get_row(array(' id  '=>1));
	echo '4:'.$model->last_sql.'<br>';
	$model->get_row(array('id   <> '=>1));
	echo '5:'.$model->last_sql.'<br>';
	$model->get_row(array('id <='=>1));
	echo '6:'.$model->last_sql.'<br>';
	$model->get_row(array('id !='=>1));
	echo '7:'.$model->last_sql.'<br>';
	$model->get_row(array('id'=>1, 'name'=>'abc'));
	echo '8:'.$model->last_sql.'<br>';
	$model->get_row(array('id'=>1, 'name like'=>'abc'));
	echo '9:'.$model->last_sql.'<br>';
	$model->get_row(array('id in'=>array(1, 2, 3), 'name like'=>'abc'));
	echo '10:'.$model->last_sql.'<br>';
	$model->get_row(array('id in'=>array(1), 'name like'=>'abc'));
	echo '11:'.$model->last_sql.'<br>';
	$model->get_row(array('id in'=>'1'), array('id'=>'desc', 'name'=>'desc'));
	echo '12:'.$model->last_sql.'<br>';
	$model->get_row(array(' id   in '=>1));
	echo '13:'.$model->last_sql.'<br>';
	
	$model->get_list(array('id >'=>1));
	echo '14:'.$model->last_sql.'<br>';
	$model->get_list(array('id >'=>1, 'id <'=>10));
	echo '15:'.$model->last_sql.'<br>';
	$model->get_list(array('id >'=>1, 'name like'=>'a bc'));
	echo '16:'.$model->last_sql.'<br>';
	$model->get_list(array('id >'=>1, 'name like'=>'a bc'), array(), array(1, 3));
	echo '17:'.$model->last_sql.'<br>';
	
	$model->get_joins(array('users.*', 'items.title as title'), array('users', 'items'), array('items.id >'=>1));
	echo '18:'.$model->last_sql.'<br>';
	$model->get_joins(array('u.*', 'i.title as title'), array('users as u', 'items as i'), array('i.id >'=>1));
	echo '19:'.$model->last_sql.'<br>';
	
	echo '10:'.'DELETE -------------<br>';
	$model->delete(100);
	echo '11:'.$model->last_sql.'<br>';
	$model->delete(array(100));
	echo '12:'.$model->last_sql.'<br>';
	$model->delete(array(100,200));
	echo '13:'.$model->last_sql.'<br>';
	
	echo '14:'.'delete_all -------------<br>';
	$model->delete_all(array());
	echo '15:'.$model->last_sql.'<br>';
	$model->delete_all(array('id'=>100));
	echo '16:'.$model->last_sql.'<br>';
	$model->delete_all(array('id >'=>100, 'sex'=>'M'));
	echo '17:'.$model->last_sql.'<br>';
	
	echo '18:'.'UPDATE -------------<br>';
	$model->update(array(), array());
	echo '19:'.$model->last_sql.'<br>';
	$model->update(array('name'=>'a', 'sex'=>'F'), array());
	echo '20:'.$model->last_sql.'<br>';
	$model->update(array('name1'=>'a', 'sex1'=>'F'), array('1'=>1));
	echo '21:'.$model->last_sql.'<br>';
	$model->update(array('name'=>'a', 'sex'=>'F'), array('id'=>100));
	echo '22:'.$model->last_sql.'<br>';
	$model->update(array('name'=>'a', 'sex'=>'F'), array('id'=>100), array('id'=>'DESC'), array(10,20));
	echo '23:'.$model->last_sql.'<br>';
	
	echo '24:'.'COUNT -------------<br>';
	$model->count(array());
	echo '25:'.$model->last_sql.'<br>';
	$model->count(array('id'=>100));
	echo '26:'.$model->last_sql.'<br>';
	$model->count(array('id'=>100, 'name'=>'abc'));
	echo '27:'.$model->last_sql.'<br>';
	
	echo '28:'.'SAVE -------------<br>';
	$model->save(array());
	echo '29:'.$model->last_sql.'<br>';
	$model->save(array('age'=>1));
	echo '30:'.$model->last_sql.'<br>';
	$model->save(array('id'=>100, 'name'=>'abc', 'time'=>'2012-6-24 14:37:57'));
	echo '31:'.$model->last_sql.'<br>';
	
	$model->get_list(array('name'=>'a.b'));
	echo '14:'.$model->last_sql.'<br>';
}