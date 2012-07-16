<?php

class Pay extends AppModel{

	public $table = 'pay';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('belong', 'type', 'title', 'kind', 'method', 'paid'),
			'length' => array('title'=>250),
			'int' => array('paid'),
			'word' => array('title'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
}