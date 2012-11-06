<?php

class Recruit extends AppModel{

	public $table = 'recruits';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'company', 'companydesc'),
			'length' => array('title'=>250, 'description'=>1000, 'companydesc'=>500),
			'int' => array('num', 'identity', 'degree', 'eatroom'),
			'number' => array(),
			'word'=> array('title', 'description', 'specialty', 'area', 
							'pay', 'age', 'company', 'companydesc'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title', 'description', 'specialty', 
						'area', 'pay', 'age', 'company', 'companydesc'),
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