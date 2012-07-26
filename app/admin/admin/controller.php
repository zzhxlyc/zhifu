<?php

class AdminController extends AdminBaseController {
	
	public $models = array('Admin', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_ADMIN_HOME);
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
		$page_list = $pager->get_page_links(ADMIN_ADMIN_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
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
				if(strlen($post['password']) == 0){
					$errors['password'] = '原密码不能为空';
				}
				else if(md5($post['password']) != $admin->password){
					$errors['password'] = '原密码不正确';
				}
				if(strlen($post['password1']) == 0){
					$errors['password1'] = '新密码不能为空';
				}
				if($post['password1'] != $post['password2']){
					$errors['password2'] = '新密码不一致';
				}
				if(count($errors) == 0){
					$post['id'] = $id;
					$post['password'] = md5($post['password1']);
					unset($post['password1']);
					unset($post['password2']);
					$this->Admin->save($post);
					$this->redirect('pswd_succ');
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
	
	public function pswd_succ(){}
	
}