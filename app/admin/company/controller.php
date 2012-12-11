<?php

class CompanyController extends AdminBaseController {
	
	public $models = array('Company', 'Problem', 'Log', 'Tag', 
								'TagItem', 'Patent', 'Deal');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_COMPANY_HOME);
		parent::before();
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
		$page_list = $pager->get_page_links(ADMIN_COMPANY_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data(&$company){
		$list = $this->Problem->get_list(array('company'=>$company->id));
		$company->problem_num = count($list);
		$sum = 0;
		foreach($list as $o){
			$sum += $o->budget;
		}
		$company->problem_budget = $sum;
	}
	
	public function verify(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$Company = $this->Company->get($id);
			if($Company){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Company = $this->set_model($post, $Company);
			$errors = $this->Company->check($Company);
			if(count($errors) == 0){
				$post['verified'] = 1;
				$this->Company->escape($post);
				$this->Company->save($post);
				$admin = get_admin_session($this->session);
				$this->Log->action_company_pass($admin, $Company->name);
				$this->redirect('show?id='.$Company->id);
			}
			$this->redirect('show?id='.$Company->id);
		}
	}
	
	public function show(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$Company = $this->Company->get($id);
			if($Company){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		$this->set('company', $Company);
		$this->add_tag_data($Company->id, BelongType::COMPANY);
		$this->add_common_tags();
		$this->add_data($Company);
	}

	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$Company = $this->Company->get($id);
			if($Company){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Company = $this->set_model($post, $Company);
			$errors = $this->Company->check($Company);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				$this->resize_upload_image($path);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('license', $errors, $files);
				if($path){$post['license'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tag($id, BelongType::COMPANY, 
									$post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Company->image){
					FileSystem::remove($Company->image);
				}
				if($post['license'] && $Company->license){
					FileSystem::remove($Company->license);
				}
				$this->Company->escape($post);
				$this->Company->save($post);
				$admin = get_admin_session($this->session);
				$this->Log->action_company_edit($admin, $Company->name);
				$this->response->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('company', $Company);
		$this->add_tag_data($Company->id, BelongType::COMPANY);
		$this->add_common_tags();
	}
	
}