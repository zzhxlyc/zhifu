<?php

class Problem extends AppModel{

	public $table = 'problems';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'company', 'description', 'phone', 'mobile', 'email'),
			'length' => array('title'=>250, 'phone'=>20, 'mobile'=>20, 'email'=>250),
			'int' => array('company', 'cat', 'subcat'),
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
			'string'=>array('title'),
			'url'=>array(),
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
	
	public function get_status(){
		$status = $this->status;
		if($status == 0){
			return '发布蓝图';
		}
		else if($status == 1){
			return '竞标中';
		}
		else if($status == 2){
			return '选定合作专家';
		}
		else if($status == 3){
			return '交付互评';
		}
		if($this->closed == 1){
			return '已关闭';
		}
	}
	
	public static function default_image(){
		return IMAGE_HOME.'/default.jpg';
	}

}