<?php

class VideoCategory extends AppModel{

	public $table = 'video_categorys';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name', 'parent'),
			'length' => array(),
			'int' => array(),
			'word'=> array('name'),
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
	
	public function save(&$data){
		if(get_value($data, 'id')){
			parent::save($data);
			return;
		}
		$parent = intval($data['parent']);
		if($parent == 0){
			$sql = 'SELECT max(id) as mid FROM `'.$this->table."` WHERE id < 99";
			$maxid = $this->select_val($sql)->mid;
			if(empty($maxid)) $maxid = 0;
			if($maxid == 98){
				return;
			}
		}
		else{
			$id_low = $parent * 100;
			$id_high = ($parent + 1) * 100;
			$sql = 'SELECT max(id) as mid FROM `'.$this->table."` WHERE id > $id_low and id < $id_high";
			$ret = $this->select_val($sql);
			if(empty($ret->mid)){
				$maxid = $id_low;
			}
			else{
				$maxid = intval($ret->mid);
			}
		}
		$data['id'] = $maxid + 1;
		parent::save($data, true);
		return $data->id;
	}

}