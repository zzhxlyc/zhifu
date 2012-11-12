<?php

class CheckUtils{
	
	public static function check_mobile($mobile){
		$chars = "/^[0-9]{11}\$/i";
		if(preg_match($chars, $mobile)){
			return true;
		}
		return false;
	}
	
	public static function check_phone($phone, $gang = 0){
		return self::check_phone2($phone, 5, 11, $gang);
	}
	
	public static function check_phone2($phone, $min, $max, $gang = 0){
		if($gang){
			$max += 5;
			$chars = "/^[0-9\-]{{$min},{$max}}\$/i";
		}
		else{
			$chars = "/^[0-9]{{$min},{$max}}\$/i";
		}
		if(preg_match($chars, $phone)){
			return true;
		}
		return false;
	}
	
	public static function check_email($email){
		$chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
		if(strpos($email, '@') !== false && strpos($email, '.') !== false) {
			if(preg_match($chars, $email)){
				return true;
			}
			return false;
		}
		return false;
	}
	
}