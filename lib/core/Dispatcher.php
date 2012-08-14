<?php

class Dispatcher{
	
	public $request;
	public $response;
	public $router;
	public $view;
	
	public function __construct($request, $response, $router, $view) {
		$this->request = $request;
		$this->response = $response;
		$this->router = $router;
		$this->view = $view;
	}
	
	private function _parse_url_no_prefix($url){
		if($url[0] == '/'){
			$url = substr($url, 1);
		}
		$r = explode('/', $url);
		if(count($r) == 2 && !empty($r[0]) && !empty($r[1])){
			$module = $r[0];
			$method = $r[1];
			return array($module, $method);
		}
		else if(count($r) == 1){
			$module = $r[0];
			$method = 'index';
			return array($module, $method);
		}
		return false;
	}
	
	private function _parse_request(){
		$url = $this->request->url;
		$prefix_map = &$this->router->prefix_map;
		$prefix = Router::$DEFAULT_PREFIX;
		foreach($prefix_map as $pre => $folder){
			if(StringUtils::start_with($url, $pre)){
				$prefix = $pre;
				$url = substr($url, strlen($prefix));
				break;
			}
		}
		$ret = $this->router->find($prefix, $url);
//		echo 'router find result:';
//		print_r($ret);
		if($ret === false){
			$array = $this->_parse_url_no_prefix($url);
			if($array === false){
				$_404 = true;
			}
			else{
				list($module, $method) = $array;
			}
		}
		else{
			if(isset($ret['C'])){
				$controller = $ret['C'];
			}
			if(isset($ret['module'])){
				$module = $ret['module'];
			}
			$method = $ret['M'];
			if(empty($module) && !empty($controller)){
				$c = strtolower($controller);
				$index = strrpos($c, 'controller');
				if($index !== false){
					$module = substr($c, 0, $index);
				}
			}
		}
		if(isset($_404) && $_404 === true){
			$this->response->redirect_404();
		}
		else{
			$result = array('prefix'=>$prefix, 
						 'module'=>$module, 
						 'controller'=>$controller, 
						 'method'=>$method);
			if($prefix != Router::$DEFAULT_PREFIX){
				$result['prefix_folder'] = $this->router->get_prefix_folder($prefix);
			}
			return $result;
		}
	}
	
	public function get_invoke(){
		$array = $this->_parse_request();
		if(!$array){
			$this->response->redirect_404();
			return null;
		}
//		echo 'dispatcher get_invoke : ';
//		print_r($array);
		$prefix = $array['prefix'];
		$module = $array['module'];
		$controller = $array['controller'];
		$method = $array['method'];
		if(empty($controller) && !empty($module)){
			$controller = ucfirst($module).'Controller';
		}
		if($prefix == '/'){
			$file = APP_DIR."/$module/controller.php";
		}
		else{
			$prefix_folder = $array['prefix_folder'];
			$this->view->prefix_folder = $prefix_folder;
			$file = APP_DIR."/$prefix_folder/$module/controller.php";
			$init_file = APP_DIR."/$prefix_folder/init.php";
			if(file_exists($init_file)){
				include($init_file);
			}
		}
		
		if(file_exists($file)){
			include_once($file);
			$ret = get_reflection($controller, $method);
			if($ret){
				list($class, $method_obj) = $ret;
				$this->request->set_dispatcher($prefix, $module, 
										$controller, $method_obj->name);
				$instance = $class->newInstance($this->request, 
												$this->response, 
												$this->view);
				return array($instance, $method_obj);
			}
			else{
				$this->response->redirect_404();
				return null;
			}
		}
		else{
			global $ERROR;
			$ERROR->add_warning('Dispatcher', 'no file : '.$file);
			$this->response->redirect_404();
			return null;
		}
	}
	
	public function dispatch(){
		$ret = $this->get_invoke();
		if($ret){
			list($controller, $method) = $ret;
			$controller->before();
			$method->invoke($controller);
			$controller->after();
			$controller->render();
			return $controller;
		}
		return null;
	}
	
}