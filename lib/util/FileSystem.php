<?php

class FileSystem {
	
	public static function get_ext($file_name){
		$index = strrpos($file_name, '.');
		$index2 = strrpos($file_name, '/');
		if($index !== false && $index > $index2){
			return strtolower(substr($file_name, $index + 1));
		}
		return '';
	}
	
	public static function gen_upload_path($name = null, $ext = null){
		if($name){
			$ext = self::get_ext($name);
			$file_name = self::gen_file_name().'.'.$ext;
		}
		else if($ext){
			$file_name = self::gen_file_name().'.'.$ext;
		}
		else{
			$file_name = self::gen_file_name();
		}
		return self::get_upload_path($file_name);
	}
	
	public static function get_upload_path($file_name){
		$second_path = self::get_second_path();
		return $second_path.DS.$file_name;
	}
	
	private static function get_second_path(){
		$year = date('Y');
		$month = date('m');
		$first = UPLOAD_DIR.DS.$year;
		$second = $first.DS.$month;
		if(!file_exists($first)){
			mkdir($first, 0755);
		}
		if(!file_exists($second)){
			mkdir($second, 0755);
		}
		return $year.DS.$month;
	}
	
	public static function get_save_path($path){
		return UPLOAD_DIR.DS.$path;
	}
	
	public static function save_url_file($url, $abstract_path, $override = 1){
		$save_path = self::get_save_path($abstract_path);
		if($override || !file_exists($save_path)){
			$image = file_get_contents($url);
			file_put_contents($save_path, $image);
		}
	}
	
	public static function save_file($image_binary, $abstract_path, $override = 1){
		$save_path = self::get_save_path($abstract_path);
		if($override || !file_exists($save_path)){
			file_put_contents($save_path, $image_binary);
		}
	}
	
	public static function gen_file_name(){
		return TIMESTAMP.rand(100, 999);
	}
	
}