<?php

class CompanyController extends AdminBaseController {
	
	public $models = array('Company', 'Problem', 'Log', 'Tag', 'TagItem');
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
	
	private function set_data($id){
		$tags = $this->TagItem->get_list(array('belong'=>$id, 
										'type'=>BelongType::COMPANY));
		$tag_id_array = get_attrs($tags, 'tag');
		if($tag_id_array){
			$tag_list = $this->Tag->get_list(array('id in'=>$tag_id_array));
			$this->set('tag_list', $tag_list);
		}
	}
	
	private function add_data(&$company){
		$list = $this->Problem->get_list(array('company'=>$company->id));
		$company->problem_num = count($list);
		$sum = 0;
		foreach($list as $o){
			$sum += $o->budget;
		}
		$company->problem_budget = $sum;
		
		$company->patent_num = 0;
		$company->patent_budget = 0;
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
					$this->response->redirect('show?id='.$company->id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('company', $company);
					$this->set_data($company->id);
					$this->add_data($company);
				}
			}
			else{
				$this->response->redirect('show?id='.$id);
			}
		}
	}
	
	public function show(){
		$get = $this->request->get;
		$id = get_id($get);
		if($id > 0){
			$company = $this->Company->get($id);
		}
		if($company){
			$this->set('company', $company);
			$this->set_data($company->id);
			$this->add_data($company);
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
					$this->do_tag($id, BelongType::COMPANY, 
										$post['old_tag'], $post['new_tag']);
					unset($post['old_tag'], $post['new_tag']);
					$this->Company->escape($post);
					$this->Company->save($post);
					$this->Log->action_company_edit($admin, $company->name);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set_data($company->id);
					$this->add_data($company);
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
				$this->set_data($company->id);
				$this->add_data($company);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
}