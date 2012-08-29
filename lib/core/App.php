<?php

class App{
	
	private static $modules = array(
		'mail' => 'mail/class.phpmailer.php'
	);
	
	private static function _load($file){
		if(file_exists($file)){
			include($file);
		}
	}
	
	public static function load($module, $class){
		if($module == 'util'){
			$file = CORE_UTIL_DIR."/$class.php";
			self::_load($file);
		}
	}
	
	public static function load_util($module){
		if(array_key_exists($module, self::$modules)){
			$file = CORE_UTIL_DIR.'/'.self::$modules[$module];
			self::_load($file);
		}
	}
	
}