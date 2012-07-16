<?php

class Config{
	public $m;
	
	function Config(){
		$file_path = CONF_DIR.'/config.conf';
		$file = fopen ($file_path, 'r');
		while (!feof($file)) {
		    $line = fgets($file);
		    if($line != '' && strpos($line, '=') !== false){
			    list($key, $value) = explode('=', $line);
			    $this->m[trim($key)] = trim($value);
		    }
		}
		fclose ($file);
	}
	
	function get($key){
		return $this->m[$key];
	}
}