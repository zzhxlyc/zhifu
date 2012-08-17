<?php

class Topic extends AppModel{

	public $table = 'topics';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('content', 'parent', 'belong', 'type'),
			'length' => array('title'=>250),
			'int' => array('parent', 'belong'),
			'word' => array('title', 'content')
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title'),
			'url'=>array(),
			'html'=>array('content')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function comment_plus($id = Null){
		if($id){
			$this->update(array('comments eq'=>'comments + 1'), array('id'=>$id));
		}
		else{
			$this->update(array('comments eq'=>'comments + 1'), array('id'=>$this->parent));
		}
	}
	
	public function get_author_link(){
		if($this->type == BelongType::COMPANY){
			return COMPANY_HOME.'/detail?id='.$this->belong;
		}
		else if($this->type == BelongType::EXPERT){
			return EXPERT_HOME.'/profile?id='.$this->belong;
		}
		else if($this->type == BelongType::ADMIN){
			return '#';
		}
		else{
			return '#';
		}
	}

}