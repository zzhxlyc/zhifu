<?php

class Recruit extends AppModel{

	public $table = 'recruits';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'description', 'belong', 'type', 'available'),
			'length' => array('title'=>250),
			'int' => array('belong'),
			'word'=> array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		
		$array = array();
		$a = $data['available'];
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
				$data['available'] = implode(' ', $array);
			}
		}
		else{
			$errors['available'] = '选择日期有误';
		}
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title', 'description'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function get_status(){
		if($this->status == 0){
			return '招聘中';
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