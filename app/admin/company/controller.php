<?php

class CompanyController extends AdminBaseController {
	
	public $models = array('Company', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_COMPANY_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$condition = array();
		$all = $this->Company->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Company->get_page($condition, array('id'=>'DESC'), 
											$pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_COMPANY_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function verify(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$company = $this->Company->get($id);
			}
			if($company){
				$company = $this->set_model($post, $company);
				$errors = $this->Company->check($company);
				if(count($errors) == 0){
					$post['verified'] = 1;
					$this->Company->escape($post);
					$this->Company->save($post);
					$this->Log->action_company_pass($admin, $company->name);
					$this->response->redirect('verify');
				}
				else{
					$this->set('errors', $errors);
					$this->set('company', $company);
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
		$all = $this->Company->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Company->get_page($condition, array('id'=>'DESC'), 
											$pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_COMPANY_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function show(){
		$get = $this->request->get;
		$id = get_id($get);
		if($id > 0){
			$company = $this->Company->get($id);
		}
		if($company){
			$this->set('company', $company);
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
				$company = $this->Company->get($id);
			}
			if($company){
				$company = $this->set_model($post, $company);
				$errors = $this->Company->check($company);
				if(count($errors) == 0){
					$this->Company->escape($post);
					$this->Company->save($post);
					$this->Log->action_company_edit($admin, $company->name);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('company', $company);
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
				$company = $this->Company->get($id);
			}
			if($company){
				$this->set('company', $company);
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
				$this->Company->delete($ids);
				$this->Log->action_company_delete($admin, '多个公司');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$company = $this->Company->get($id);
				$this->Company->delete($id);
				$this->Log->action_company_delete($admin, $company->name);
			}
			$this->response->redirect('index');
		}
	}
	
}