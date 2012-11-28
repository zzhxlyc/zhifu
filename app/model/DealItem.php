<?php

class DealItem extends AppModel{

	public $table = 'deal_items';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('comment'),
			'length' => array('comment'=>1000),
			'int' => array(),
			'word'=> array('comment'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}	
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('comment'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}