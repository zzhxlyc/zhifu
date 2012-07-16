<?php

class CompanyController extends AppController {
	
	public $models = array('Company');
	
	public function before(){
		$need_no_session = array();
		$method = $this->request->get_method();
		if(!in_array($method, $need_no_session)){
			$this->load_session();
			$admin = get_admin_session($this->session);
			if(!$admin){
				$this->response->redirect('login');
			}
		}
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
	
	private function do_file(&$data, &$errors, &$files){
		$file = $files['license'];
		if($file && is_uploaded_file($file['tmp_name'])){
			$error = $this->Company->check_file($file);
			if(empty($error)){
				$path = $this->upload_file($file);
				$data['license'] = $path;
			}
			else{
				$errors['license'] = $error;
			}
		}
	}
	
	public function register(){
		if($this->request->post){
			$post = $this->request->post;
			$post['verified'] = 0;
			$errors = $this->Company->check($post);
			if(count($errors) == 0){
				$this->do_file($post, $errors, $this->request->file);
			}
			if(count($errors) == 0){
				$post['rate_total'] = 0;
				$post['rate_num'] = 0;
				$post['time'] = DATETIME;
				$this->Company->escape($post);
				$this->Company->save($post);
				$this->response->redirect('index');
			}
			else{
				$company = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('company', $company);
			}
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
	
}