<?php

class Tag extends AppModel{

	public $table = 'tags';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'count'),
			'length' => array('name'=>250),
			'int' => array('count'),
			'word' => array('name'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function plus(array $id_array){
		if(is_array($id_array) && count($id_array) > 0){
			$this->update(array('count eq'=>'`count` + 1'), array('id in'=>$id_array));
		}
	}
	
	public function minus(array $id_array){
		if(is_array($id_array) && count($id_array) > 0){
			$this->update(array('count eq'=>'`count` - 1'), array('id in'=>$id_array));
		}
	}
	
}