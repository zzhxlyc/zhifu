<?php

class Patent extends AppModel{

	public $table = 'patents';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'expert', 'pid', 'description', 'phone', 'mobile', 'email'),
			'length' => array('title'=>250, 'pid'=>250, 'phone'=>20, 'mobile'=>20, 'email'=>100, 'url'=>250),
			'int' => array('expert', 'cat', 'subcat', 'app', 'skill', 'example', 'kind', 'transfer', 'owner'),
			'number' => array('budget'),
			'email' => array('email'), 
			'word'=> array('title', 'description'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		$phone = get_value($data, 'phone');
		$mobile = get_value($data, 'mobile');
		if(empty($errors['phone']) && intval($phone) == 0){
			$errors['phone'] = '电话格式有误';
		}
		if(empty($errors['mobile']) && intval($mobile) == 0){
			$errors['mobile'] = '手机格式有误';
		}
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title', 'pid', 'phone', 'mobile'),
			'url'=>array('url'),
			'html'=>array('description')
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function format(){
		$format_array = array(
			'string'=>array('title'),
			'url'=>array(),
			'html'=>array('description')
		);
		return parent::format($format_array);
	}
	
	public static function get_status($status){
		if($status == 0){
			return '竞标中';
		}
	}
	
	public static function default_image(){
		return IMAGE_HOME.'/default.jpg';
	}

}