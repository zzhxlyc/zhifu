<?php

class CreditController extends AppController {
	
	public $models = array();
	
	public function before(){
		$this->set('home', APPLY_HOME);
		parent::before();
		$need_login = array('show', 'add', 'edit');	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function cash(){
	}
	
	
	
}