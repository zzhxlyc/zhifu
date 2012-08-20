<?php

class BelongType {
	
	const ADMIN = 'Admin';
	const EXPERT = 'Expert';
	const COMPANY = 'Company';
	const PROBLEM = 'Problem';
	const PATENT = 'Patent';
	
	public static function value_of($const){
		$const = ucfirst(strtolower($const));
		if($const == self::ADMIN){
			return self::ADMIN;
		}
		else if($const == self::EXPERT){
			return self::EXPERT;
		}
		else if($const == self::COMPANY){
			return self::COMPANY;
		}
		return '';
	}
	
	public static function to_string($const){
		if($const == self::ADMIN){
			return '管理员';
		}
		else if($const == self::EXPERT){
			return '专家';
		}
		else if($const == self::COMPANY){
			return '企业';
		}
		return '未知';
	}
	
	public static function get_user($id, $const, $obj = 0){
		if($const == self::ADMIN){
			$model = new Admin();
			$admin = $model->get($id);
			if($obj) return $admin;
			else return $admin->user;
		}
		else if($const == self::EXPERT){
			$model = new Expert();
			$expert = $model->get($id);
			if($obj) return $expert;
			else return $expert->name;
		}
		else if($const == self::COMPANY){
			$model = new Company();
			$company = $model->get($id);
			if($obj) return $company;
			else return $company->name;
		}
		return '';
	}
	
	public static function get_user_by_name($name, $const, $obj = 0){
		if($const == self::ADMIN){
			$model = new Admin();
			$admin = $model->get_row(array('user'=>$name));
			if($obj) return $admin;
			else return $admin->id;
		}
		else if($const == self::EXPERT){
			$model = new Expert();
			$expert = $model->get_row(array('name'=>$name));
			if($obj) return $expert;
			else return $expert->id;
		}
		else if($const == self::COMPANY){
			$model = new Company();
			$company = $model->get_row(array('name'=>$name));
			if($obj) return $company;
			else return $company->id;
		}
		return 0;
	}
	
}