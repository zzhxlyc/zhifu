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
		$cond = array();
		$all = $this->Message->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Message->get_page($cond, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_MESSAGE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function send(){
		if($this->request->post){
			$post = $this->request->post;
			$Admin = $this->get('User');
			$errors = array();
			if(empty($post['to_name'])){
				$errors['to_name'] = '发送用户不能为空';
			}
			if(count($errors) == 0){
				$User = $this->find_user($post['to_name']);
				if($User){
					$post['to'] = $User->id;
					$post['to_type'] = $User->get_type();
					$post['to_author'] = $User->name;
					$post['read'] = 0;
					$post['from'] = $Admin->id;
					$post['from_type'] = BelongType::ADMIN;
					$post['from_name'] = $Admin->user;
					$post['from_author'] = '管理员';
					$errors = $this->Message->check($post);
					if(count($errors) == 0){
						$post['time'] = DATETIME;
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
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$message = $this->Message->get($id);
			if($message){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$message = $this->set_model($post, $message);
			$errors = $this->Message->check($message);
			if(count($errors) == 0){
				$this->Message->escape($post);
				$this->Message->save($post);
				$this->response->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('message', $message);
	}
	
}