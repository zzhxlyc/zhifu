<?php

class Deal extends AppModel{

	public $table = 'deals';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('patent', 'company'),
			'length' => array(),
			'int' => array('patent', 'company'),
			'word'=> array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array(),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}