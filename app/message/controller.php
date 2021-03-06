<?php

class MessageController extends AppController {
	
	public $models = array('Message');
	
	public function before(){
		$this->set('home', MESSAGE_HOME);
		parent::before();
		$need_login = array('send', 'sendbox', 'detail', 'index', 'unreadcount');	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$User = $this->get('User');
		$cond = array('to'=>$User->id, 'to_type'=>$User->get_type());
		$order = array('time'=>'DESC');
		$all = $this->Message->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Message->get_page($cond, $order, $pager->now(), $limit);
		$links = $pager->get_page_links(MESSAGE_HOME.'?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function sendbox(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$User = $this->get('User');
		$condition = array('from'=>$User->id);
		$order = array('time'=>'DESC');
		$all = $this->Message->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Message->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links(MESSAGE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function detail(){
		$get = $this->request->get;
		$id = get_id($get);
		$has_error = true;
		if($id){
			$Message = $this->Message->get($id);
			if($Message){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$User = $this->get('User');
		if($User->id == $Message->to && $User->get_type() == $Message->to_type){
			$d = array('id'=>$id, 'read'=>1);
			$this->Message->save($d);
		}
		
		$this->set('$Message', $Message);
	}
	
	public function send(){
		if($this->request->post){		
			$post = $this->request->post;
			$user = esc_text($post['user']);
			$data = array('title'=>$post['title'], 'content'=>$post['content']);
			$User = $this->get('User');
			$data['from'] = $User->id;
			$data['from_type'] = $User->get_type();
			$data['from_name'] = $User->username;
			$data['from_author'] = $User->name;
			$U = $this->find_user($user);
			if($U){
				$data['to'] = $U->id;
				$data['to_type'] = $U->get_type();
				$data['to_name'] = $U->username;
				$data['to_author'] = $U->name;
			}
			$errors = $this->Message->check($data);
			if(!isset($data['to'])){
				$errors['user'] = '用户不存在';
			}
			else if($data['to'] == $data['from'] &&
					$data['to_type'] == $data['from_type']){
				$errors['user'] = '不能发送给自己';
			}
			if(count($errors) == 0){
				$data['read'] = 0;
				$data['time'] = DATETIME;
				$this->Message->escape($data);
				$id = $this->Message->save($data);
				$this->redirect('detail?id='.$id);
			}
			$Message = $this->set_model($post);
			$this->set('errors', $errors);
			$this->set('message', $Message);
			$this->set('user', $post['user']);
		}
		else{
			$get = $this->request->get;
			if(!empty($get['user'])){
				$user = $get['user'];
				$this->set('user', $user);
			}
		}
	}
	
	public function unreadcount(){
		$this->layout('ajax');
		$User = $this->get('User');
		$cond = array('to'=>$User->id, 'to_type'=>$User->get_type(), 'read'=>0);
		$count = $this->Message->count($cond);
		echo $count;
	}
	
}