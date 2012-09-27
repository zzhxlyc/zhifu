<?php

class Patent extends AppModel{

	public $table = 'patents';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'expert', 'pid', 'description', 'phone', 'mobile', 'email'),
			'length' => array('description'=>1000, 'pid'=>250, 'phone'=>20, 'mobile'=>20, 'email'=>200, 'url'=>250),
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
	
	public function app_tostring(){
		$s = $this->app;
		if($s == 1){
			return '高新技术';
		}
		else if($s == 2){
			return '可产业化';
		}
		else if($s == 3){
			return '小本创业';
		}
		else if($s == 4){
			return '社会公益';
		}
		else if($s == 5){
			return '民间秘方';
		}
		else{
			return '';
		}
	}
	
	public function skill_tostring(){
		$s = $this->skill;
		if($s == 1){
			return '构想阶段';
		}
		else if($s == 2){
			return '图纸阶段';
		}
		else if($s == 3){
			return '成功案例';
		}
		else if($s == 4){
			return '批量推广';
		}
		else if($s == 5){
			return '研发成功';
		}
		else{
			return '';
		}
	}
	
	public function kind_tostring(){
		$s = $this->kind;
		if($s == 1){
			return '发明';
		}
		else if($s == 2){
			return '外观';
		}
		else if($s == 3){
			return '实用新型';
		}
		else if($s == 4){
			return '未申请专利';
		}
		else{
			return '';
		}
	}
	
	public function example_tostring(){
		$s = $this->example;
		if($s == 1){
			return '无';
		}
		else if($s == 2){
			return '有';
		}
		else if($s == 3){
			return '正在制作';
		}
		else{
			return '';
		}
	}
	
	public function transfer_tostring(){
		$s = $this->transfer;
		if($s == 1){
			return '完全转让';
		}
		else if($s == 2){
			return '许可转让';
		}
		else if($s == 3){
			return '合作生产';
		}
		else if($s == 4){
			return '接受投资';
		}
		else{
			return '';
		}
	}
	
	public function owner_tostring(){
		$s = $this->owner;
		if($s == 1){
			return '个人';
		}
		else if($s == 2){
			return '企业';
		}
		else if($s == 3){
			return '科研单位';
		}
		else if($s == 4){
			return '大专院校';
		}
		else{
			return '';
		}
	}

}