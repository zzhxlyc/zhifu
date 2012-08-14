<?php

class Solution extends AppModel{

	public $table = 'solutions';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('problem', 'expert'),
			'length' => array(),
			'int' => array('problem', 'expert'),
			'word'=> array(),
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
	
	public function get_status(){
		$s = $this->status;
		if($s == 0){
			return '竞标中';
		}
	}

}