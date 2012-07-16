<?php

class ManageController extends AdminBaseController {
	
	public $models = array('Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_MANAGE_HOME.'/index');
	}
	
	public function index(){
		
	}
	
	public function base(){
		
	}
	
	public function statistics(){
		
	}
	
	public function head(){
		
	}
	
	public function foot(){
		
	}
	
}