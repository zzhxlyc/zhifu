<?php

class Category extends AppModel{

	public $table = 'categorys';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'parent'),
			'length' => array('name'=>250),
			'int' => array('parent'),
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
	
	public function get_category(){
		$list = $this->get_list();
		$cat_array = array();
		foreach($list as $cat){
			if($cat->parent == 0){
				$cat_array[$cat->id] = array('id'=>$cat->id, 'name'=>$cat->name, 'c'=>array());
			}
		}
		foreach($list as $cat){
			if($cat->parent > 0){
				$cat_array[$cat->parent]['c'][$cat->id] = array('id'=>$cat->id, 'name'=>$cat->name);
			}
		}
		return $cat_array;
	}

}