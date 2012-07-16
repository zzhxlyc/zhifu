<?php

class UserController extends Controller{
	
	public $models = array('User');
	
	public function before(){
		$this->load_session();
	}
	
	public function index(){
		$this->set('name', 'abc');
		$this->set('list', array('a', 'c', 'gs'));
//		$this->title('留言');
		$this->view->add_js('user');
		$this->view->add_css('user');
		$this->view->set_icon('http://localhost/wp/favicon.ico');
		$this->view->set_keywords('abc');
//		$this->layout('ajax');
		$user = $this->User->get(1);
//		$this->response->cookie(array(name=>'abc', value=>'123'));
	}
	
	public function test(){
		$this->redirect('index');
	}
	
	public function div(){
		$this->render('home_div');
	}
	
}