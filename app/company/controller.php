<?php

class CompanyController extends AppController {
	
	public $models = array('TagItem', 'Tag', 'Problem', 'Patent', 'Deal', 
							'Solution', 'Comment');
	
	public function before(){
		$this->set('home', COMPANY_HOME);
		parent::before();
		$need_login = array('profile');	// either
		$need_company = array('edit');
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
		else{
			$Company = $this->get('User');
			$id = $Company->id;
			$has_error = false;
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$Company', $Company);
		
		$tag_list = $this->show_tags($Company);
		
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
	
	public function myself(){
		$User = $this->get('User');
		$Company = $User;
		$this->set('company', $Company);
		
		$this->add_tags($Company);
		$this->add_common_tags();
	}
	
	public function edit(){
		$User = $this->get('User');
		$Company = $User;
		$this->set('company', $Company);
		
		if($this->request->post){
			$post = $this->request->post;
			$new_Company = $this->set_model($post, $Company);
			$errors = $this->Company->check($new_Company);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('license', $errors, $files);
				if($path){$post['license'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tags($User, $post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Company->image){
					FileSystem::remove($Company->image);
				}
				if($post['license'] && $Company->license){
					FileSystem::remove($Company->license);
				}
				$post['id'] = $User->id;
				$this->Company->escape($post);
				$this->Company->save($post);
				$this->redirect('edit?succ');
			}
			$this->set('errors', $errors);
			$this->set('company', $new_Company);
		}
		$this->add_tags($Company);
		$this->add_common_tags();
	}
	
	public function pswd(){
		$User = $this->get('User');
		$Company = $User;
		
		if($this->request->post){
			$post = $this->request->post;
			$password = $post['password'];
			$password1 = $post['password1'];
			$password2 = $post['password2'];
			$errors = array();
			if(strlen($password) == 0){
				$errors['password'] = '不能为空';
			}
			else if(md5($password) != $User->password){
				$errors['password'] = '密码错误';
			}
			if(strlen($password1) == 0){
				$errors['password1'] = '不能为空';
			}
			if(strlen($password2) == 0){
				$errors['password2'] = '不能为空';
			}
			else if($password1 != $password2){
				$errors['password2'] = '密码不一致';
			}
			if(count($errors) == 0){
				$new_pswd = md5($password1);
				$data = array('id'=>$User->id, 'password'=>$new_pswd);
				$this->Company->save($data);
				$this->redirect('pswd?succ');
			}
			$this->set('errors', $errors);
			$this->set('company', $new_Company);
		}
	}
	
	
}