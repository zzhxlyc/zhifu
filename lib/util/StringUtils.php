<?php

class StringUtils{
	
	public static function start_with($string, $search){
		return strpos($string, $search) === 0;
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