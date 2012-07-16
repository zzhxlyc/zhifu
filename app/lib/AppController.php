<?php

class AppController extends Controller{
	
	public function upload_file($array){
		$path = FileSystem::gen_upload_path($array['name']);
		$save_path = FileSystem::get_save_path($path);
		move_uploaded_file($array['tmp_name'], $save_path);
		return $path;
	}
	
}