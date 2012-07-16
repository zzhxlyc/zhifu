<?php

class AdminController extends AdminBaseController {
	
	public $models = array('Admin', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_ADMIN_HOME.'/index');
	}
	
	public function login(){
		if($this->request->post){
			$post = $this->request->post;
			$errors = array();
			if(empty($post['user'])){
				$errors['user'] = '不能为空';
			}
			if(empty($post['password'])){
				$errors['password'] = '不能为空';
			}
			if(count($errors) == 0){
				$post['password'] = md5($post['password']);
				$search = array('user'=>$post['user'], 'password'=>$post['password']);
				$admin = $this->Admin->get_row($search);
				if($admin){
					set_admin_session($this->session, $admin->id);
					$this->Log->action_login($admin);
					$this->response->redirect('index');
				}
				else{
					$errors['password'] = '用户名或密码错误';
				}
			}
			$this->set('user', $post['user']);
			$this->set('errors', $errors);
		}
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Admin->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Admin->get_page(null, array('id'=>'ASC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_ADMIN_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	private function check_username(&$user, &$error, $id = null){
		if(empty($error['user'])){
			$search = array('user'=>$user);
			if($id){
				$search['id !='] = $id;
			}
			$count = $this->Admin->count($search);
			if($count > 0){
				$error['user'] = '此用户名已被使用';
			}
		}
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$post['limit'] = 0;
			$post['flag'] = 1;
			$errors = $this->Admin->check($post);
			if($post['password'] != $post['password2']){
				$errors['password2'] = '密码不一致';
			}
			$this->check_username($post['user'], $errors);
			if(count($errors) == 0){
				$post['password'] = md5($post['password']);
				$post['time'] = DATETIME;
				unset($post['password2']);
				$this->Admin->save($post);
				$this->response->redirect('index');
			}
			else{
				$admin = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('admin', $admin);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_id($post);
			if($id > 0){
				$admin = $this->Admin->get($id);
			}
			if($admin){
				$admin = $this->set_model($post, $admin);
				$errors = $this->Admin->check($admin);
				$this->check_username($admin->user, $errors, $id);
				if(count($errors) == 0){
					$this->Admin->save($post);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('admin', $admin);
				}
			}
			else{
				$this->set('error', '此账户不存在');
			}
		}
		else{
			$get = $this->request->get;
			$id = get_id($get);
			if($id > 0){
				$admin = $this->Admin->get($id);
			}
			if($admin){
				$this->set('admin', $admin);
			}
			else{
				$this->set('error', '此账户不存在');
			}
		}
	}
	
	public function pswd(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_admin_session($this->session);
			if($id > 0){
				$admin = $this->Admin->get($id);
			}
			if($admin){
				$admin = $this->set_model($post, $admin);
				$errors = $this->Admin->check($admin);
				if($post['password'] != $post['password2']){
					$errors['password2'] = '密码不一致';
				}
				if(count($errors) == 0){
					$post['id'] = $id;
					$post['password'] = md5($post['password']);
					unset($post['password2']);
					$this->Admin->save($post);
					$this->response->redirect('index');
				}
				else{
					$this->set('errors', $errors);
					$this->set('admin', $admin);
				}
			}
			else{
				$this->set('error', '此账户不存在');
			}
		}
		else{
			$get = $this->request->get;
			$id = get_admin_session($this->session);
			if($id > 0){
				$admin = $this->Admin->get($id);
			}
			if($admin){
				$this->set('admin', $admin);
			}
			else{
				$this->set('error', '此账户不存在');
			}
		}
	}
	
	public function delete(){
		if($this->request->post){
			$post = $this->request->post;
			$ids = $post['ids'];
			$this->Admin->delete($ids);
			$this->response->redirect('index');
		}
	}
	
}