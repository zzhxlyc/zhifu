<?php

class MessageController extends AppController {
	
	public $models = array('Message');
	
	public function before(){
		$this->set('home', MESSAGE_HOME);
		parent::before();
		$need_login = array();	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$User = $this->get('User');
		$condition = array('to'=>$User->id);
		$order = array('time'=>'DESC');
		$all = $this->Message->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Message->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links(MESSAGE_HOME.'/index?');
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
			$data['from_author'] = $User->name;
			$cond = array('name'=>$user);
			$Company = $this->Company->get_row($cond);
			if($Company){
				$data['to'] = $Company->id;
				$data['to_type'] = BelongType::COMPANY;
				$data['to_name'] = $Company->name;
			}
			else{
				$Expert = $this->Expert->get_row($cond);
				if($Expert){
					$data['to'] = $Expert->id;
					$data['to_type'] = BelongType::EXPERT;
					$data['to_name'] = $Expert->name;
				}
			}
			$errors = $this->Message->check($data);
			if(!isset($data['to'])){
				$errors['user'] = '用户不存在';
			}
			else if($data['to'] == $data['from']){
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
	
}