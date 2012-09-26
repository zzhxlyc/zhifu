<?php

class Idea extends AppModel{

	public $table = 'ideas';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'company', 'budget', 'description'),
			'length' => array('description'=>1000),
			'int' => array('one', 'two', 'three'),
			'number' => array('budget', 'one_m', 'two_m', 'three_m'),
			'word'=> array('title', 'description'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title'),
			'url'=>array(),
			'html'=>array('description')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public static function default_image(){
		return IMAGE_HOME.'/default.jpg';
	}
	
	public function get_status(){
		$status = $this->status;
		if($status == 0){
			return '竞标中';
		}
		else if($status == 1){
			return '评奖中';
		}
		else if($status == 2){
			return '发放奖金';
		}
		else if($status == 3){
			return '结束';
		}
		else{
			return '';
		}
	}

}