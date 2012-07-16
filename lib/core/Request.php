<?php

class Request{
	public $root;
	public $base;	//start with /
	public $url;	//start with /
	
	public $post;
	public $get;
	public $cookie;
	public $file;
	
	public function __construct($parseEnvironment = true) {
		$this->_root();
		$this->_base();
		$this->_url();

		if ($parseEnvironment) {
			$this->_post();
			$this->_get();
			$this->_cookie();
			$this->_file();
		}
		
	}
	
	protected function _root(){
		$root = ROOT_URL;
		while($root[strlen($root) - 1] == '/'){
			$root = substr($root, 0, strlen($root) - 1);
		}
		$this->root = $root;
	}
	
	protected function _base(){
		$index = strrpos($this->root, '/');
		if ($index > 7) {
			$base = substr($this->root, $index + 1);
		}
		else{
			$base = '';
		}
		$this->base = '/'.$base;
	}
	
	protected function _url(){
		$uri = $_SERVER['REQUEST_URI'];
		$base = $this->base;
		if (strlen($base) > 0 && strpos($uri, $base) === 0) {
			$uri = substr($uri, strlen($base));
		}
		if (strpos($uri, '?') !== false) {
			list($uri) = explode('?', $uri, 2);
		}
		if (empty($uri) || $uri == '/' || $uri == '//') {
			$uri = '/';
		}
		$this->url = $uri;
	}
	
	protected function _post(){
		$this->post = $_POST;
		if (ini_get('magic_quotes_gpc') === '1') {
			$this->post = stripslashes_deep($this->post);
		}
	}
	
	protected function _get(){
		$this->get = $_GET;
		if (ini_get('magic_quotes_gpc') === '1') {
			$this->get = stripslashes_deep($this->get);
		}
	}
	
	protected function _cookie(){
		$this->cookie = $_COOKIE;
	}
	
	/**
	 * 	@return Array ( [file] => Array ( 
	 * 								[name] => aa.xls 
	 * 								[type] => application/vnd.ms-excel 
	 * 								[tmp_name] => E:\Xampp\xampp\tmp\php8CD.tmp 
	 * 								[error] => 0 
	 * 								[size] => 25088))
	 */
	public function _file(){
		if (isset($_FILES) && is_array($_FILES)) {
			foreach ($_FILES as $name => $data) {
				if ($name != 'data') {
					$this->file[$name] = $data;
				}
			}
		}
	}
	
	public function set_dispatcher($prefix, $module, $controller, $method){
		$this->prefix = $prefix;
		$this->module = $module;
		$this->controller = $controller;
		$this->method = $method;
	}
	
	public function get_controller(){
		return $this->controller;
	}
	
	public function get_method(){
		return $this->method;
	}
	
	public function get_module(){
		return $this->module;
	}
	
	public function get_prefix(){
		return $this->prefix;
	}
	
}