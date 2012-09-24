<?php

class Recruit extends AppModel{

	public $table = 'recruits';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title'),
			'length' => array('title'=>250, 'description'=>1000),
			'int' => array('num', 'identity', 'degree', 'age', 'eatroom'),
			'number' => array('pay'),
			'word'=> array('title', 'description', 'specialty', 'area'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title', 'description', 'specialty', 'area'),
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

}