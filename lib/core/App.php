<?php

class App{
	
	private function _load($class, $file){
		if(file_exists($file) && !class_exists($class)){
			include($file);
		}
	}
	
	public function load($module, $class){
		if($module == 'util'){
			$file = CORE_UTIL_DIR."/$class.php";
			self::_load($class, $file);
		}
	}
	
}