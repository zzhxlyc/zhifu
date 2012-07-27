<?php

class MessageController extends AdminBaseController {
	
	public $models = array('Message', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_MESSAGE_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Message->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Message->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_MESSAGE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function send(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$errors = array();
			if(empty($post['to_name'])){
				$errors['to_name'] = '发送用户不能为空';
			}
			$post['to_type'] = BelongType::value_of($post['to_type']);
			if(empty($post['to_type'])){
				$errors['to_type'] = '发送用户类型不能为空';
			}
			if(count($errors) == 0){
				$user_id = BelongType::get_user_by_name($post['to_name'], $post['to_type']);
				if($user_id > 0){
					$post['to'] = $user_id;
					$post['read'] = 0;
					$post['from'] = $admin;
					$post['from_type'] = BelongType::ADMIN;
					$errors = $this->Message->check($post);
					if(count($errors) == 0){
						$post['time'] = DATETIME;
						unset($post['to_name']);
						$this->Message->escape($post);
						$this->Message->save($post);
						$this->Log->action_message_send($admin, $post);
						$this->response->redirect('index');
					}
				}
				else{
					$errors['to_name'] = '发送用户不存在';
				}
			}
			$message = $this->set_model($post);
			$this->set('errors', $errors);
			$this->set('message', $message);
		}
	}
	
	private function add_data(&$message){
		$message->from_name = BelongType::get_user($message->from, $message->from_type);
		$message->to_name = BelongType::get_user($message->to, $message->to_type);
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$message = $this->Message->get($id);
			}
			if($message){
				$message = $this->set_model($post, $message);
				$errors = $this->Message->check($message);
				if(count($errors) == 0){
					$this->Message->escape($post);
					$this->Message->save($post);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->add_data($message);
					$this->set('message', $message);
				}
			}
			else{
				$this->set('error', '不存在');
			}
		}
		else{
			$get = $this->request->get;
			$id = get_id($get);
			if($id > 0){
				$message = $this->Message->get($id);
			}
			if($message){
				$this->add_data($message);
				$this->set('message', $message);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
}