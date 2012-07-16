<?php

define ('FATAL', E_USER_ERROR);
define ('ERROR', E_USER_WARNING);
define ('WARNING', E_USER_NOTICE);

class Error{

	public $error_list;
	public $warning_list;

	public function __construct(){
		$this->error_list = array();
		$this->warning_list = array();
	}

	public function add_error($where, $error){
		$this->error_list[] = array('where'=>$where,'error'=>$error);
	}

	public function add_warning($where, $warning){
		$this->warning_list[] = array('where'=>$where,'warning'=>$warning);
	}

}

function error_handler ($errno, $errstr, $errfile, $errline){
	global $response;
	$response->redirect_500();
}
