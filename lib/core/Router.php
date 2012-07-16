<?php

class Router{
	public static $DEFAULT_PREFIX = '/';
	public $map;
	public $prefix_map;
	
	public function __construct() {
		$this->map = array(self::$DEFAULT_PREFIX => array());
		$this->prefix_map = array();
	}
	
	public function add_prefix($prefix, $folder){
		if(!array_key_exists($prefix, $this->map)){
			$this->map[$prefix] = array();
			$this->prefix_map[$prefix] = $folder;
		}
	}
	
	public function get_prefix_folder($prefix){
		return $this->prefix_map[$prefix];
	}
	
	public function add($url, $caller = array()){
		if(empty($url) || !is_array($caller)){
			return;
		}
		if(!isset($caller['C']) || !isset($caller['M'])){
			return;
		}
		if(isset($caller['prefix'])){
			$prefix = $caller['prefix'];
		}
		else{
			$prefix = self::$DEFAULT_PREFIX;
		}
		if(array_key_exists($prefix, $this->map)){
			$this->map[$prefix][$url] = $caller;
		}		
	}
	
	public function find($prefix, $url){
//		print_r($this->map);
		if($url == '') $url = '/';
		if(array_key_exists($prefix, $this->map)){
			if(array_key_exists($url, $this->map[$prefix])){
				return $this->map[$prefix][$url];
			}
		}
		return false;
	}
}