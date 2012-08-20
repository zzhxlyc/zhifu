<?php

class ExpertController extends AdminBaseController {
	
	public $models = array('Expert', 'Patent', 'Log', 'Tag', 'TagItem');
	public $no_session = array();
	
	public function before(){
		$this->set('home', EXPERT_HOME);
		parent::before();
		parent::before();
		$need_login = array();	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
}