<?php

class MysqlDAO {
	
	function MysqlDAO(){}
	
	private static function get_db(){
		global $DB;
		return $DB;
	}
	
	private static function _get_db_name(){
		return self::get_db()->get_database_name();
	}
	
	private static function _get_table_name($table){
		$db_name = self::_get_db_name();
		if(defined('DB_TABLE_PREFIX')){
			$table = DB_TABLE_PREFIX.$table;
		}
		return "`$db_name`.`$table`";
	}
	
	private static function _get_table_field($key){
		$key = trim($key);
		if(strpos($key, '.') !== false){
			$r = explode('.', $key);
			if(count($r) == 2){
				$table = $r[0];
				$field = $r[1];
			}
		}
		else{
			$field = $key;
		}
		if(!empty($table)){
			return "`$table`.".self::_get_field($field);
		}
		else{
			return self::_get_field($field);
		}
	}
	
	private static function _get_field($field){
		if($field == '*') return '*';
		else if($field == '1') return '1';
		else return "`$field`";
	}
	
	private static function _get_key($key){
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
				return array(Null, NULL);
			}
		}
		return array($field, $op);
	}
	
	private static function _get_value($value){
		if(is_string($value)){
			return "'$value'";
		}
		else if(is_null($value)){
			return "''";
		}
		else{
			return $value;
		}	
	}

	private static function build_column($attr){
		$length_array = array('int'=>11, 'tinyint'=>4, 
						'smallint'=>6, 'mediumint'=>9, 'bigint'=>20, 'varchar'=>255);
		$string_array = array('char', 'varchar', 'text', 'date', 
								'time', 'datetime', 'tinytext', 'mediumtext', 'longtext');
		$sql = '';
		$name = esc_text($attr['name']);
		$sql .= "`$name`";
		if(isset($attr['newname'])){
			$newname = esc_text($attr['newname']);
			$sql .= " `$newname`";
		}
		$type = $attr['type'];
		if(!isset($attr['length'])){
			if(array_key_exists($type, $length_array)){
				$length = $length_array[$type];
			}
			else{
				return;
			}
		}
		else{
			$length = intval($attr['length']);
		}
		$sql .= " $type($length)";
		if(isset($attr['null']) && $attr['null'] === false){
			$sql .= ' NOT NULL';
		}
		else if(isset($attr['default'])){
			$default = esc_text($attr['default']);
			if(in_array($type, $string_array)){
				$sql .= " DEFAULT '$default'";
			}
			else{
				$sql .= " DEFAULT $default";
			}
		}
		else{
			$sql .= ' DEFAULT NULL';
		}
		if(isset($attr['auto']) && $attr['auto'] === true){
			$sql .= ' AUTO_INCREMENT';
		}
		if(isset($attr['comment'])){
			$comment = esc_text($attr['comment']);
			$sql .= " COMMENT '$comment'";
		}
		return $sql;
	}
	
	private static function build_field(array $field_array){
		$sql = '';
		$len = count($field_array);
		for($i = 0;$i < $len;$i++){
			$key = trim($field_array[$i]);	
			$table = $field = $alias = '';
			if(strpos(strtolower($key), 'as') === false){
				$field = $key;
			}
			else{
				$r = self::split_by_blank($key);
				if(count($r) == 3 && strtolower($r[1]) == 'as'){
					$field = trim($r[0]);
					$alias = trim($r[2]);
				}
			}
			if(!empty($field)){
				$sql .= self::_get_table_field($field);
				if(!empty($alias)){
					$sql .= " AS `$alias` ";
				}
				if($i < $len - 1){
					$sql .= ', ';
				}
			}
		}
		return $sql;
	}
	
	private static function _turn_table_name($table){
		$f = ord($table);
		if($f >= ord('A') && $f <= ord('Z')){
			if(array_key_exists($table, Model::$objects)){
				$Model = Model::$objects[$table];
				$t = $Model->table;
			}
			else{
				$t = strtolower($table);
			}
		}
		else{
			$t = $table;
		}
		return " `$t` ";
	}
	
	private static function build_table(array $table_array){
		$sql = '';
		$len = count($table_array);
		for($i = 0;$i < $len;$i++){
			$key = trim($table_array[$i]);
			$table = $alias = '';
			if(strpos(strtolower($key), 'as') === false){
				$table = $key;		
			}
			else{
				$r = self::split_by_blank($key);
				if(count($r) == 3 && strtolower($r[1]) == 'as'){
					$table = trim($r[0]);
					$alias = trim($r[2]);
				}
			}
			if(!empty($table)){
				$sql .= self::_turn_table_name($table);
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
	
	private static function build_condition(array $condition){
		$sql = '';
		$len = count($condition);
		$i = -1;
		foreach($condition as $key => $cond){
			$i++;
			$field = $op = '';
			$key = trim($key);
			if(is_string($cond)){
				$cond = trim($cond);
			}
			list($field, $op) = self::_get_key($key);
			if($field == Null || $op == Null){
				continue;
			}
			if(!empty($field) && !empty($op)){
				$field = self::_get_table_field($field);
				$op = strtolower($op);
				if($op == 'in'){
					if(is_array($cond)){
						if(count($cond) > 0){
							$ids = self::id_array_to_string($cond);
							$cond = "($ids)";
						}
						else{
							continue;
						}
					}
					else{
						if(strpos($cond, ',') === false){
							$id = intval($cond);
							$cond = "($id)";
						}
						else{
							$id_list = explode(',', $cond);
							$ids = self::id_array_to_string($id_list);
							$cond = "($ids)";
						}
					}
					$sql .= " $field $op $cond ";
				}
				else if($op == 'str_in'){
					$op = 'in';
					if(is_array($cond)){
						if(count($cond) > 0){
							$temp = array();
							foreach($cond as $t){
								$temp[] = "'$t'";
							}
							$temp = implode(',', $temp);
							$cond = "($temp)";
						}
						else{
							continue;
						}
						$sql .= " $field $op $cond ";
					}
				}
				else if($op == 'like'){
					$sql .= " $field $op '%$cond%' ";
				}
				else if($op == 'leftlike'){
					$sql .= " $field $op '%$cond' ";
				}
				else if($op == 'rightlike'){
					$sql .= " $field $op '$cond%' ";
				}
				else if($op == 'eq'){
					$c = self::_get_table_field($cond);
					$sql .= " $field = $c ";
				}
				else if(is_string($cond)){
					$sql .= " $field $op '$cond' ";
				}
				else{
					$sql .= " $field $op $cond ";
				}
				if($i < $len - 1){
					$sql .= " AND ";
				}
			}
		}
		return $sql;
	}
	
	private static function build_set($set_array){
		$sql = '';
		$len = count($set_array);
		$i = -1;
		$join = ',';
		foreach($set_array as $key => $value){
			$i++;
			list($field, $op) = self::_get_key($key);
			if(empty($field) || empty($op)){
				continue;
			}
			$field = self::_get_field($field);
			if($op == '='){
				$value = self::_get_value($value);
				$sql .= " $field $op $value ";
			}
			else if($op == 'eq'){
				$sql .= " $field = $value ";
			}
			if($i < $len - 1){
				$sql .= " $join ";
			}
		}
		return $sql;
	}
	
	private static function build_order($order){
		$sql = '';
		$len = count($order);
		$i = -1;
		foreach($order as $key => $cond){
			$i++;
			$field = self::_get_table_field($key);
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
	
	private static function build_limit($limit){
		if(!empty($limit)){
			if(is_int($limit)){
				return 'LIMIT '.$limit;
			}
			else if(is_array($limit) && count($limit) == 2){
				return 'LIMIT '.$limit[0].', '.$limit[1];
			}
			else if(strpos($limit, ',') !== false){
				$r = explode(',', $limit);
				if(count($r) == 2){
					$begin = intval(trim($r[0]));
					$size = intval(trim($r[1]));
					return "LIMIT $begin, $size";
				}
			}
		}
		return '';
	}

	public static function describe_table($table_name, array $array){
		$db_name = self::_get_db_name();
		$sql = "SELECT";
		$num = count($array);
		for($i = 0;$i < $num;$i++){
			$column = $array[$i];
			if($i > 0){
				$sql .= ',';
			}
			if($column == '*'){
				$sql .= " *";
			}
			else{
				$sql .= " `$column`";
			}
		}
		$sql .= " FROM `information_schema`.`columns`";
		$sql .= " WHERE table_schema = '$db_name' and `table_name` = '$table_name'";
		return self::get_db()->get_list($sql);
	}
	
	/**
	 * @param $arrts = array(array('name'=>'id', 'type'=>'int', 'length'=>11, 
	 * 							'null'=>false, 'auto'=>true)); 
	 */
	public static function create_table($table, array $attrs, $key = 'id', 
						$charset = 'utf8', $engine = 'MyISAM'){
		$table = self::_get_table_name($table);
		$sql = "CREATE TABLE $table ( ";
		$count = count($attrs);
		for($i = 0;$i < $count;$i++){
			$attr = $attrs[$i];
			$sql .= self::build_column($attr);
			$sql .= ', ';
		}
		$sql .= "PRIMARY KEY (`$key`)";
		$sql .= " ) ENGINE=$engine DEFAULT CHARSET=$charset";
		self::get_db()->query($sql);
		return true;
	}
	
	public static function alter_table($action, $table, $column, $param = array()){
		$table = self::_get_table_name($table);
		$sql = "ALTER TABLE $table ";
		if($action == 'add'){
			$param['name'] = $column;
			$sql .= "ADD ".self::build_column($param);
		}
		else if($action == 'modify'){
			$param['name'] = $column;
			$param['newname'] = $column;
			$sql .= "CHANGE ".self::build_column($param);
		}
		else if($action == 'remove'){
			$sql .= "DROP `$column`";
		}
		self::get_db()->query($sql);
		return true;
	}
	
	public static function drop_table($table){
		$table = self::_get_table_name($table);
		$sql = "DROP TABLE $table";
		self::get_db()->query($sql);
		return true;
	}
	
	public static function _get($table, $id){
		$id = intval($id);
		$table_name = self::_get_table_name($table);
		$sql = "SELECT * FROM $table_name WHERE `id` = $id";
		return self::get_db()->get_row($sql);
	}
	
	public static function _get_row($table, 
			array $condition = array(), array $order = array()){
		$sql = 'SELECT * FROM '.self::_get_table_name($table);
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.self::build_condition($condition);
		}
		if(is_array($order) && count($order) > 0){
			$sql .= ' ORDER BY '.self::build_order($order);
		}
		$sql .= ' LIMIT 1';
		return self::get_db()->get_row($sql);
	}

	public static function _count($table, array $condition = array()){
		$sql = 'SELECT count(*) as count FROM '.self::_get_table_name($table);
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.self::build_condition($condition);
		}
		$std = self::get_db()->get_row($sql);
		return $std->count;
	}
	
	public static function _find($table, $condition = array(), $order = array(), $limit = ''){
		$sql = 'SELECT * FROM '.self::_get_table_name($table);
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.self::build_condition($condition);
		}
		if(is_array($order) && count($order) > 0){
			$sql .= ' ORDER BY '.self::build_order($order);
		}
		if(!empty($limit)){
			$sql .= ' '.self::build_limit($limit);
		}
		return self::get_db()->get_list($sql);
	}
	
	public static function get_joins($fields = array(), $tables = array(), 
					$condition = array(), $order = array(), $limit = ''){
		$sql = 'SELECT ';
		if(is_array($fields) && count($fields) > 0){
			$sql .= self::build_field($fields);
		}
		$sql .= ' FROM ';
		if(is_array($tables) && count($tables) > 0){
			$sql .= self::build_table($tables);
		}
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.self::build_condition($condition);
		}
		if(is_array($order) && count($order) > 0){
			$sql .= ' ORDER BY '.self::build_order($order);
		}
		if(!empty($limit)){
			$sql .= ' '.self::build_limit($limit);
		}
		return self::get_db()->get_list($sql);
	}
	
	public static function _delete($table, $param){
		$table_name = self::_get_table_name($table);
		if(is_int($param) || is_string($param)){
			$id = intval($param);
			if($id <= 0) return -1;
			$sql = "DELETE FROM $table WHERE `id` = $id";
		}
		else if(is_array($param) && count($param) > 0){
			$ids = self::id_array_to_string($param);
			$sql = "DELETE FROM $table WHERE `id` in ($ids)";
		}
		else{
			return;
		}
		return self::get_db()->query($sql);
	}

	public static function _delete_all($table, array $condition){
		$sql = 'DELETE FROM '.self::_get_table_name($table);
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.self::build_condition($condition);
		}
		else{
			return;
		}
		return self::get_db()->query($sql);
	}

	public static function _update($table, array $set, array $condition = array(), 
									array $order = array(), $limit = ''){
		$sql = 'UPDATE '.self::_get_table_name($table);
		if(is_array($set) && count($set) > 0){
			$sql .= ' SET '.self::build_set($set);
		}
		else{
			return;
		}
		if(is_array($condition) && count($condition) > 0){
			$sql .= ' WHERE '.self::build_condition($condition);
		}
		if(is_array($order) && count($order) > 0){
			$sql .= ' ORDER BY '.self::build_order($order);
		}
		if(!empty($limit)){
			$sql .= ' '.self::build_limit($limit);
		}
		return self::get_db()->query($sql);
	}

	public static function _save($table, array $data){
		$sql = 'INSERT INTO '.self::_get_table_name($table);
		if(is_array($data) && count($data) > 0){
			if(array_key_exists('id', $data)){
				$condition = array('id'=>$data['id']);
				$new_data = $data;
				unset($new_data['id']);
				self::_update($table, $new_data, $condition);
				return 0;
			}
			$sql .= '(';
			$fields = $values = array();
			foreach($data as $k => $v){
				$i++;
				$fields[] = self::_get_field($k);
				$values[] = self::_get_value($v);
			}
			$sql .= implode(',', $fields);
			$sql .= ') VALUES(';
			$sql .= implode(',', $values);
			$sql .= ')';
		}
		else{
			return -1;
		}
		return self::get_db()->insert($sql);
	}

	public static function _query($sql){
		return self::get_db()->query($sql);
	}

	public static function _select($sql){
		return self::get_db()->get_list($sql);
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
		$std = self::_get($this->table, $id);
		return $this->_convert($std);
	}
	
	public function get_row($condition = array(), $order = array()){
		$std = self::_get_row($this->table, $condition, $order);
		return $this->_convert($std);
	}
	
	public function count(array $condition = array()){
		return self::_count($this->table, $condition);
	}
	
	public function get_page($condition = array(), $order = array(), $page, $page_num){
		if($page <= 1) $page = 1;
		if($page_num <= 0) $page_num = 10;
		$limit = array(($page - 1) * $page_num, $page_num);
		return $this->get_list($condition, $order, $limit);
	}
	
	public function get_list(array $condition = array(), array $order = array(), $limit = ''){
		$list = self::_find($this->table, $condition, $order, $limit);
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
		return self::_delete($this->table, $param);
	}
	
	
	/*
	 * delete with conditions
	 * $condition = array('field [op]' => 'value', )
	 */
	public function delete_all(array $condition){
		return self::_delete_all($this->table, $condition);
	}
	
	public function update(array $set, array $condition = array(), 
									array $order = array(), $limit = ''){
		return self::_update($this->table, $set, $condition, $order, $limit);
	}
	
	public function save(array $data){
		return self::_save($this->table, $data);
	}
	
	
	public function query($sql){
		return self::_query($sql);
	}
	
	
	public function select($sql){
		return self::_select($sql);
	}
	
	private static function split_by_blank($str){
		$r = explode(' ', $str);
		$a = array();
		foreach($r as $v){
			if(!empty($v)){
				$a[] = $v;
			}
		}
		return $a;
	}
	
	private static function id_array_to_string($array){
		$id_array = array();
		foreach($array as $id){
			$t = intval($id);
			if($t > 0){
				$id_array[] = $t; 
			}
		}
		$id_array = array_unique($id_array);
		return implode(',', $id_array);
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
	
//	$model->get_joins(array('users.*', 'items.title as title'), array('users', 'items'), array('items.id >'=>1));
//	echo '18:'.$model->last_sql.'<br>';
//	$model->get_joins(array('u.*', 'i.title as title'), array('users as u', 'items as i'), array('i.id >'=>1));
//	echo '19:'.$model->last_sql.'<br>';
	
	echo '20:'.'DELETE -------------<br>';
	$model->delete(100);
	echo '21:'.$model->last_sql.'<br>';
	$model->delete(array(100));
	echo '22:'.$model->last_sql.'<br>';
	$model->delete(array(100,200));
	echo '23:'.$model->last_sql.'<br>';
	
	echo '24:'.'delete_all -------------<br>';
	$model->delete_all(array());
	echo '25:'.$model->last_sql.'<br>';
	$model->delete_all(array('id'=>100));
	echo '26:'.$model->last_sql.'<br>';
	$model->delete_all(array('id >'=>100, 'sex'=>'M'));
	echo '27:'.$model->last_sql.'<br>';
	
	echo '28:'.'UPDATE -------------<br>';
	$model->update(array(), array());
	echo '29:'.$model->last_sql.'<br>';
	$model->update(array('name'=>'a', 'sex'=>'F'), array());
	echo '30:'.$model->last_sql.'<br>';
	$model->update(array('name1'=>'a', 'sex1'=>'F'), array('1'=>1));
	echo '31:'.$model->last_sql.'<br>';
	$model->update(array('name'=>'a', 'sex'=>'F'), array('id'=>100));
	echo '32:'.$model->last_sql.'<br>';
	$model->update(array('name'=>'a', 'sex'=>'F'), array('id'=>100), array('id'=>'DESC'), array(10,20));
	echo '33:'.$model->last_sql.'<br>';
	
	echo '34:'.'COUNT -------------<br>';
	$model->count(array());
	echo '35:'.$model->last_sql.'<br>';
	$model->count(array('id'=>100));
	echo '36:'.$model->last_sql.'<br>';
	$model->count(array('id'=>100, 'name'=>'abc'));
	echo '37:'.$model->last_sql.'<br>';
	
	echo '38:'.'SAVE -------------<br>';
	$model->save(array());
	echo '39:'.$model->last_sql.'<br>';
	$model->save(array('age'=>1));
	echo '40:'.$model->last_sql.'<br>';
	$model->save(array('id'=>100, 'name'=>'abc', 'time'=>'2012-6-24 14:37:57'));
	echo '41:'.$model->last_sql.'<br>';
	
	$model->get_list(array('name'=>'a.b'));
	echo '42:'.$model->last_sql.'<br>';
	$model->update(array('count eq'=>'count + 1'));
	echo '43:'.$model->last_sql.'<br>';
}