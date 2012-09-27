<?php

class Company extends User {

	public $table = 'companys';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'verified', 'email'),
			'length' => array('description'=>1000, 'phone'=>20, 'url'=>250),
			'int' => array('verified', 'rate_total', 'rate_num'),
			'email' => array('email'),
			'word' => array('name', 'description', 'contact')
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name', 'contact'),
			'url'=>array('url'),
			'html'=>array('description')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function is_company(){
		return true;
	}
	
	public function status(){
		if($this->verified == 1){
			return '已验证';
		}
		else{
			return '未验证';
		}
	}
	
	public static function default_image(){
		return IMAGE_HOME.'/default.jpg';
	}

}