<?php

class ExpertController extends AdminController {
	
	public $models = array('Expert', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_EXPERT_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$condition = array();
		$all = $this->Expert->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Expert->get_page($condition, array('id'=>'DESC'), 
											$pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_EXPERT_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function verify(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$expert = $this->Expert->get($id);
			}
			if($expert){
				$expert = $this->set_model($post, $expert);
				$errors = $this->Expert->check($expert);
				if(count($errors) == 0){
					$post['verified'] = 1;
					$this->Expert->escape($post);
					$this->Expert->save($post);
					$this->Log->action_expert_pass($admin, $expert->name);
					$this->response->redirect('verify');
				}
				else{
					$this->set('errors', $errors);
					$this->set('expert', $expert);
				}
			}
			else{
				$this->set('error', '不存在');
			}
		}
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$condition = array('verified'=>0);
		$all = $this->Expert->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Expert->get_page($condition, array('id'=>'DESC'), 
											$pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_COMPANY_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function show(){
		$get = $this->request->get;
		$id = get_id($get);
		if($id > 0){
			$expert = $this->Expert->get($id);
		}
		if($expert){
			$this->set('expert', $expert);
		}
		else{
			$this->set('error', '不存在');
		}
	}

	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$expert = $this->Expert->get($id);
			}
			if($expert){
				$expert = $this->set_model($post, $expert);
				$errors = $this->Expert->check($expert);
				if(count($errors) == 0){
					$this->Expert->escape($post);
					$this->Expert->save($post);
					$this->Log->action_expert_edit($admin, $expert->name);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('expert', $expert);
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
				$expert = $this->Expert->get($id);
			}
			if($expert){
				$this->set('expert', $expert);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
	public function delete(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			if(isset($post['ids'])){
				$ids = $post['ids'];
				$this->Expert->delete($ids);
				$this->Log->action_expert_delete($admin, '多个公司');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$expert = $this->Expert->get($id);
				$this->Expert->delete($id);
				$this->Log->action_expert_delete($admin, $expert->name);
			}
			$this->response->redirect('index');
		}
	}
	
}