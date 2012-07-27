<?php

class Recruit extends AppModel{

	public $table = 'recruits';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'description', 'belong', 'type', 'available'),
			'length' => array('title'=>250),
			'int' => array('belong'),
			'word'=> array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title', 'description'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function get_status(){
		if($this->status == 0){
			return '招聘中';
		}
		else{
			return '已关闭';
		}
	}

}