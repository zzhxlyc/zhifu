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
	
	public function get($id){
		$company = parent::get($id);
		if($company){
			$company->description = base64_decode($company->description);
		}
		return $company; 
	}
	
	public function get_list($condition = array(), $order = array(), $limit = ''){
		$list = parent::get_list($condition, $order, $limit);
		if($list){
			foreach($list as $company){
				$company->description = base64_decode($company->description);
			}
		}
		return $list; 
	}

}