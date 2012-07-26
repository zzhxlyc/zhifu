<?php

class Company extends AppModel{

	public $table = 'companys';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'verified', 'email'),
			'length' => array('name'=>250, 'email'=>200, 'phone'=>200, 'url'=>250),
			'int' => array('verified', 'rate_total', 'rate_num'),
			'email' => array('email'),
			'word' => array('name', 'description')
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name'),
			'url'=>array('url'),
			'html'=>array('description')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function status(){
		if($this->verified == 1){
			return '已验证';
		}
		else{
			return '未验证';
		}
	}

}