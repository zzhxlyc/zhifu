<?php

class ExpertController extends AppController {
	
	public $models = array('Expert');
	
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
	
	private function do_file(&$data, &$errors, &$files){
		$file = $files['image'];
		if($file && is_uploaded_file($file['tmp_name'])){
			$ext_array = array('jpg', 'png', 'gif');
			$error = $this->Expert->check_file($file, $ext_array);
			if(empty($error)){
				$path = $this->upload_file($file);
				$data['image'] = $path;
			}
			else{
				$errors['image'] = $error;
			}
		}
	}
	
	public function register(){
		if($this->request->post){
			$post = $this->request->post;
			$post['verified'] = 0;
			$errors = $this->Expert->check($post);
			if(count($errors) == 0){
				$this->do_file($post, $errors, $this->request->file);
			}
			if(count($errors) == 0){
				$post['rate_total'] = 0;
				$post['rate_num'] = 0;
				$post['time'] = DATETIME;
				$this->Expert->escape($post);
				$this->Expert->save($post);
				$this->response->redirect('index');
			}
			else{
				$expert = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('expert', $expert);
			}
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
	
}