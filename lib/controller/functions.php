<?php

function get_reflection($class_name, $method_name){
	try{
		$class = new ReflectionClass($class_name);
		foreach($class->getmethods() as $method){
			if($method->name == $method_name){
				return array($class, $method);
			}
		}
		global $ERROR;
		$ERROR->add_warning('get_controller_class', 'no this method : '.$method_name);
		return null;
	}
	catch(ReflectionException $e){
		global $ERROR;
		$ERROR->add_warning('get_controller_class', 'no this class : '.$class_name);
		return null;
	}
}

function call_controller($class_name, $method_name){
	global $request, $response;
	$view = new View();
	$ret = get_reflection($class_name, $method_name);
	if($ret){
		list($class, $method) = $ret;
		$instance = $class->newInstance($request, $response, $view);
		$method->invoke($instance);
		return array($instance->get_vars(), $instance->view->get_template());
	}
}