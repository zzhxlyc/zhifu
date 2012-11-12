<?php

class Link extends AppModel{

	public $table = 'links';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'url'),
			'length' => array(),
			'int' => array(),
			'word'=> array('title'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title'),
			'url'=>array('url'),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}