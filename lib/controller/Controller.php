<?php

class Controller{
	
	public $response;
	public $view;
	public $session;
	
	public $vars;
	
	public function __construct($request, $response, $view){
		$this->response = $response;
		$this->request = $request;
		$this->view = $view;
		$this->vars = array();
		
		$this->load_model();
	}
	
	private function var_key($key){
		if(substr($key, 0, 1) == '$'){
			$key = substr($key, 1);
		}
		return $key;
	}
	
	public function set($key, $value){
		$key = $this->var_key($key);
		$this->vars[$key] = $value;
	}
	
	public function get($key){
		$key = $this->var_key($key);
		return $this->vars[$key];
	}
	
	public function is_set($key){
		$key = $this->var_key($key);
		return array_key_exists($key, $this->vars);
	}
	
	public function get_vars(){
		return $this->vars;
	}
	
	public function layout($layout = null){
		$this->view->set_layout($layout);
	}
	
	public function render($template = null, $module = null){
		if(empty($this->view->template)){
			if($template == null){
				$template = $this->request->get_method();
			}
			if($module == null){
				$module = $this->request->get_module();
			}
			$this->view->set_template($module, $template);
		}
		if(empty($this->view->title)){
			$this->view->set_title($this->request->get_method());
		}
	}
	
	public function title($title){
		$this->view->set_title($title);
	}
	
	public function load_model(){
		Model::load($this->models);
		foreach($this->models as $model){
			$this->$model = new $model();
		}
	}
	
	public function redirect($method, $module = null, $prefix = null){
		if($module == null){
			$module = $this->request->get_module();
		}
		if($prefix == null){
			$prefix = $this->request->get_prefix();
		}
		if($prefix == '/'){
			$url = ROOT_URL."/$module/$method";
		}
		else{
			$url = ROOT_URL."$prefix/$module/$method";
		}
		$this->response->redirect($url);
	}
	
	public function load_session(){
		$this->session = new Session();
	}
	
	public function before(){}
	public function after(){}
	
	protected function set_model($data, $obj = null){
		$class_name = ucfirst($this->request->get_module());
		if($obj == null){
			$obj = new $class_name();
		}
		foreach($data as $key => $value){
			$obj->$key = $value;
		}
		return $obj;
	}
	
}