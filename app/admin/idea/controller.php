<?php

class IdeaController extends AdminController {
	
	public $models = array('Idea', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_IDEA_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Idea->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Idea->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_IDEA_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	private function do_file(&$data, &$errors, &$files){
		$file = $files['file'];
		if($file && is_uploaded_file($file['tmp_name'])){
			$error = $this->Idea->check_file($file);
			if(empty($error)){
				$path = $this->upload_file($file);
				$data['file'] = $path;
			}
			else{
				$errors['file'] = $error;
			}
		}
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$post['admin'] = $admin;
			$errors = $this->Idea->check($post);
			if(count($errors) == 0){
				$this->do_file($post, $errors, $this->request->file);
			}
			if(count($errors) == 0){
				$post['time'] = DATETIME;
				$this->Idea->escape($post);
				$this->Idea->save($post);
				$this->Log->action_idea_add($admin, $post['title']);
				$this->response->redirect('index');
			}
			else{
				$idea = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('idea', $idea);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$idea = $this->Idea->get($id);
			}
			if($idea){
				$idea = $this->set_model($post, $idea);
				$errors = $this->Idea->check($idea);
				if(count($errors) == 0){
					$this->do_file($post, $errors, $this->request->file);
				}
				if(count($errors) == 0){
					$post['lastmodify'] = DATETIME;
					$this->Idea->escape($post);
					$this->Idea->save($post);
					$this->Log->action_idea_edit($admin, $post['title']);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('idea', $idea);
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
				$idea = $this->Idea->get($id);
			}
			if($idea){
				$this->set('idea', $idea);
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
				$this->Idea->delete($ids);
				$this->Log->action_idea_delete($admin, '多篇文章');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$idea = $this->Idea->get($id);
				$this->Idea->delete($id);
				$this->Log->action_idea_delete($admin, $idea->title);
			}
			$this->response->redirect('index');
		}
	}
	
}