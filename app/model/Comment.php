<?php

class Comment extends AppModel{

	public $table = 'comments';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('object', 'type', 'content', 'user', 'author', 'user_type'),
			'length' => array(),
			'int' => array('object', 'type'),
			'word'=> array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('content'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}

}