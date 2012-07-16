<?php

Model::load_model('BelongType');

class File extends AppModel{

	public $table = 'files';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('path', 'belong', 'type'),
			'length' => array(),
			'int' => array('belong'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function save_by_admin($path, $id){
		$data = array('path'=>$path, 'belong'=>$id, 'type'=>BelongType::ADMIN);
		$data['time'] = DATETIME;
		$this->save($data);
	}
	
	public function save_by_company($path, $id){
		$data = array('path'=>$path, 'belong'=>$id, 'type'=>BelongType::COMPANY);
		$data['time'] = DATETIME;
		$this->save($data);
	}
	
	public function save_by_expert($path, $id){
		$data = array('path'=>$path, 'belong'=>$id, 'type'=>BelongType::EXPERT);
		$data['time'] = DATETIME;
		$this->save($data);
	}

}