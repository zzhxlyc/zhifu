<?php

class Admin extends User {

	public $table = 'admins';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('user', 'password', 'flag' ,'limit'),
			'length' => array('user'=>200, 'password'=>200),
			'int' => array(),
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
	
	public function is_admin(){
		return false;
	}
	
	public function status(){
		if($this->flag == 1){
			return '有效';
		}
		else{
			return '无效';
		}
	}

}