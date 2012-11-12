<?php

class IdeaItem extends AppModel{

	public $table = 'idea_items';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'content'),
			'length' => array('content'=>5000),
			'int' => array('idea', 'expert'),
			'word'=> array('title', 'content', 'c_comment', 'e_comment'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title', 'c_comment', 'e_comment'),
			'url'=>array(),
			'html'=>array('content')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function get_status(){
		$status = $this->status;
		if($status == 0){
			return '竞标中';
		}
		else if($status == 1){
			return '一等奖';
		}
		else if($status == 2){
			return '二等奖';
		}
		else if($status == 3){
			return '三等奖';
		}
	}

}