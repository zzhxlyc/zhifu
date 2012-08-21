<?php

class Patent extends AppModel{

	public $table = 'patents';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'expert', 'description'),
			'length' => array('title'=>250),
			'int' => array('expert', 'cat', 'subcat'),
			'word'=> array('title', 'description'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title'),
			'url'=>array(),
			'html'=>array('description')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function format(){
		$format_array = array(
			'string'=>array('title'),
			'url'=>array(),
			'html'=>array('description')
		);
		return parent::format($format_array);
	}
	
	public static function get_status($status){
		if($status == 0){
			return '竞标中';
		}
	}
	
	public static function default_image(){
		return IMAGE_HOME.'/default.jpg';
	}

}