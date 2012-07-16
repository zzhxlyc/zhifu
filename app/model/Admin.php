<?php

class Admin extends Model{

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

}