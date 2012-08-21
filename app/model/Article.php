<?php

class Article extends AppModel {

	public $table = 'articles';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'content', 'admin'),
			'length' => array('title'=>250),
			'int' => array('admin'),
			'word'=> array('title', 'content'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title'),
			'url'=>array(),
			'html'=>array('content')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function format(){
		$format_array = array(
			'string'=>array('title'),
			'url'=>array(),
			'html'=>array('content')
		);
		return parent::format($format_array);
	}
	
	public static function default_image(){
		return IMAGE_HOME.'/default.jpg';
	}

}