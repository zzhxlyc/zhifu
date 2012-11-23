<?php

class Company extends User {

	public $table = 'companys';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'email'),
			'length' => array('description'=>3000),
			'email' => array('email'),
			'phone' => array('phone'),
			'mobile' => array('mobile'),
			'word' => array('name', 'description', 'contact')
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name', 'contact', 'description'),
			'url'=>array('url'),
			'html'=>array()
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
		return IMAGE_HOME.'/default_company.jpg';
	}

}