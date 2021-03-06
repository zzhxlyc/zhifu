<?php

class ExpertController extends AppController {
	
	public $models = array('Expert', 'Tag', 'TagItem', 'Patent', 'Solution', 
								'Expert', 'Problem', 'Comment');
	
	public function before(){
		$this->set('home', EXPERT_HOME);
		parent::before();
		$need_login = array('profile');	// either
		$need_company = array();
		$need_expert = array('edit', 'myself', 'pswd');
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$ord = $get['order'];
		$limit = 10;
		$condition = array();
		$order = array();
		if($ord == 'time'){
			$order['time'] = 'DESC';
		}
		else if($ord == 'deadline'){
			$order['deadline'] = 'DESC';
		}
		else if($ord == 'budget'){
			$order['budget'] = 'DESC';
		}
		else{
			$order['id'] = 'DESC';
		}
		$all = $this->Expert->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Expert->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function profile(){
		$get = $this->request->get;
		$id = $get['id'];
		$has_error = true;
		if($id){
			$Expert = $this->Expert->get($id);
			if($Expert){
				$has_error = false;
			}
		}
		else{
			$Expert = $this->get('User');
			$id = $Expert->id;
			$has_error = false;
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$Expert', $Expert);
		
		$tag_list = $this->show_tags($Expert);
		
		$cond = array('expert'=>$id);
		$patents = $this->Patent->get_list($cond, array('lastmodify'=>'DESC'));
		$this->set('$patents', $patents);
		
		$cond = array('expert'=>$id);
		$solutions = $this->Solution->get_list($cond);
		if(count($solutions) > 0){
			$problem_ids = get_attrs($solutions, 'problem');
			$cond = array('id in'=>$problem_ids);
			$problems = $this->Problem->get_list($cond, array('lastmodify'=>'DESC'));
		}
		else{
			$problems = array();
		}
		$this->set('$problems', $problems);
		
		$page = get_page($get);
		$this->add_comments($Expert, $page);
	}
	
	private function add_profile_data(&$Expert){
		$this->add_tags($Expert);
		
		$list = $this->Problem->get_list(array('company'=>$Expert->id));
		$Expert->problem_num = count($list);
		$sum = 0;
		foreach($list as $o){
			$sum += $o->budget;
		}
		$Expert->problem_budget = $sum;
		
		$Expert->patent_num = 0;
		$Expert->patent_budget = 0;
	}
	
	public function myself(){
		$User = $this->get('User');
		$Expert = $User;
		$this->set('expert', $Expert);
		
		$this->add_tags($Expert);
		$this->add_common_tags();
	}
	
	public function edit(){
		$User = $this->get('User');
		$Expert = $User;
		$this->set('expert', $Expert);
		
		if($this->request->post){
			$post = $this->request->post;
			$new_Expert = $this->set_model($post, $Expert);
			$errors = $this->Expert->check($new_Expert);
			if(empty($errors['email']) 
					&& $this->find_user_by_email($post['email'], $User->id)){
				$errors['email'] = '已被使用';
			}
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				$this->resize_upload_image($path, 100, 100);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('license', $errors, $files);
				if($path){$post['license'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tags($User, $post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Expert->image){
					FileSystem::remove($Expert->image);
				}
				if($post['license'] && $Expert->license){
					FileSystem::remove($Expert->license);
				}
				$post['id'] = $User->id;
				$this->Expert->escape($post);
				$this->Expert->save($post);
				$this->redirect('edit?succ');
			}
			$this->set('errors', $errors);
			$this->set('expert', $new_Expert);
		}
		$this->add_tags($Expert);
		$this->add_common_tags();
	}
	
	public function pswd(){
		$User = $this->get('User');
		$Expert = $User;
		
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
			else if(!$this->check_pswd($password1)){
				$errors['password1'] = '密码不符合规范 ';
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
				$this->Expert->save($data);
				$this->redirect('pswd?succ');
			}
			$this->set('errors', $errors);
			$this->set('company', $new_Company);
		}
	}
	
}