<?php

class Deal extends AppModel{

	public $table = 'deals';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'phone'),
			'length' => array('phone'=>20, 'note'=>1000),
			'int' => array('patent', 'company', 'phone'),
			'word'=> array('name', 'note', 'price'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name', 'note', 'price'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}