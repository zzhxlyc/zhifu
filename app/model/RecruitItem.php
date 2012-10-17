<?php

class RecruitItem extends AppModel{

	public $table = 'recruit_items';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'sex', 'mobile', 'phone', 'email', 'resume'),
			'length' => array('mobile'=>20, 'phone'=>20),
			'int' => array('sex', 'mobile', 'phone'),
			'number' => array(),
			'email' => array('email'),
			'word'=> array('name'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}