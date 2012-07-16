<?php

class Recruit extends AppModel{

	public $table = 'recruits';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('belong', 'type', 'available'),
			'length' => array(),
			'int' => array('belong'),
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