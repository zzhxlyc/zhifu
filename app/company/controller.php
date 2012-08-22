<?php

class CompanyController extends AppController {
	
	public $models = array('TagItem', 'Tag', 'Problem', 'Patent', 'Deal', 
							'Solution', 'Comment');
	
	public function before(){
		$this->set('home', COMPANY_HOME);
		parent::before();
		$need_login = array();	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	private function add_profile_data(&$company){
		$this->add_tag_data($company->id, BelongType::COMPANY);
		
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
	
	public function profile(){
		$get = $this->request->get;
		$id = $get['id'];
		$has_error = true;
		if($id){
			$Company = $this->Company->get($id);
			if($Company){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$Company', $Company);
		
		$tag_list = $this->add_tag_data($id, BelongType::COMPANY, false);
		$tag_list = $this->TagItem->get_most($tag_list);
		$this->set('$tags', $tag_list);
		
		$cond = array('company'=>$id);
		$problems = $this->Problem->get_list($cond, array('lastmodify'=>'DESC'));
		$this->set('$problems', $problems);
		
		$cond = array('company'=>$id);
		$deals = $this->Deal->get_list($cond);
		if(count($deals) > 0){
			$patent_ids = get_attrs($deals, 'patent');
			$cond = array('id in'=>$patent_ids);
			$patents = $this->Patent->get_list($cond, array('lastmodify'=>'DESC'));
		}
		else{
			$patents = array();
		}
		$this->set('$patents', $patents);
		
		$page = get_page($get);
		$this->add_comments($Company, $page);
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Company = $this->Company->get($id);
//			if($Company && $User->is_company() && $Company->id == $User->id){
			if($Company){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Company = $this->set_model($post, $Company);
			$errors = $this->Company->check($Company);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
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
				$this->redirect('succ&edit?id='.$id);
			}
		}
		$this->add_tag_data($Company->id, BelongType::COMPANY);
		$this->add_common_tags();
		$this->set('company', $Company);
	}
	
	
}