<?php

class Expert extends User {
	
	public $table = 'experts';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'verified', 'email'),
			'length' => array('description'=>1000, 'phone'=>20),
			'int' => array('verified', 'rate_total', 'rate_num'),
			'email' => array('email'),
			'word' => array('name', 'description', 'workplace', 'job')
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name', 'description', 'workplace', 'job'),
			'url'=>array('url'),
			'html'=>array('description')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function is_expert(){
		return true;
	}
	
	public function get_rate(){
		if($this->rate_num == 0){
			return 0;
		}
		else{
			return sprintf('%.1f', $this->rate_total / $this->rate_num);
		}
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