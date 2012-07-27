<?php

class LinkController extends AdminBaseController {
	
	public $models = array('Link', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_LINK_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Link->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Link->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_LINK_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}

	private function do_file(&$data, &$errors, &$files){
		$field = 'img';
		$file = $files[$field];
		if($file && is_uploaded_file($file['tmp_name'])){
			$error = $this->Link->check_file($file);
			if(empty($error)){
				$path = $this->upload_file($file);
				$data[$field] = $path;
			}
			else{
				$errors[$field] = $error;
			}
		}
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$errors = $this->Link->check($post);
			if(count($errors) == 0){
				$this->do_file($post, $errors, $this->request->file);
			}
			if(count($errors) == 0){
				$post['time'] = DATETIME;
				$post['order'] = 0;
				$this->Link->escape($post);
				$this->Link->save($post);
				$this->Log->action_link_add($admin, $post['title']);
				$this->redirect('index');
			}
			else{
				$link = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('link', $link);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$link = $this->Link->get($id);
			}
			if($link){
				$link = $this->set_model($post, $link);
				$errors = $this->Link->check($link);
				if(count($errors) == 0){
					$this->do_file($post, $errors, $this->request->file);
					$this->Link->escape($post);
					$this->Link->save($post);
					$this->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('link', $link);
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
				$link = $this->Link->get($id);
			}
			if($link){
				$this->set('link', $link);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
}