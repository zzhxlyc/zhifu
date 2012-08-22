<?php

class Solution extends AppModel{

	public $table = 'solutions';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'problem', 'expert', 'description'),
			'length' => array('title'=>250),
			'int' => array('problem', 'expert'),
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
	
	public function get_status(){
		$s = $this->status;
		if($s == 0){
			return '竞标中';
		}
		else if($s == 1){
			return '被选中';
		}
	}

}