<?php

class Apply extends AppModel{

	public $table = 'applys';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'name'),
			'length' => array('description'=>3000),
			'int' => array('num', 'identity', 'education', 'year', 'age'),
			'email' => array('email'),
			'mobile' => array('mobile'),
			'word'=> array('title', 'name', 'description', 
								'address', 'area', 'evaluate'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		
		$array = array();
		$a = get_value($data, 'available');
		$ret = explode(' ', $a);
		if(count($ret) == 7){
			for($i = 0;$i < 7;$i++){
				$r = $ret[$i];
				$rr = explode('-', $r);
				if(count($rr) == 3){
					array_map('intval', $rr);
					$array[] = implode('-', $rr);
				}
				else{
					$errors['available'] = '选择日期有误';
					break;
				}
			}
			if(!isset($errors['available'])){
				set_value($data, 'available', implode(' ', $array));
			}
		}
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title', 'name', 'description', 'address', 'area', 'evaluatere'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function get_status(){
		if($this->status == 1){
			return '有效';
		}
		else{
			return '已关闭';
		}
	}
	
	public function do_available(){
		$available = $this->available;
		$this->days = array();
		$days = explode(' ', $available);
		foreach($days as $day){
			$day = trim($day);
			$this->days[] = explode('-', $day);
		}
	}

}