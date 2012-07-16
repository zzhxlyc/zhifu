<?php

class ArticleController extends AdminController {
	
	public $models = array('Article', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_ARTILCE_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Article->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Article->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_ARTILCE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	private function do_file(&$data, &$errors, &$files){
		$file = $files['file'];
		if($file && is_uploaded_file($file['tmp_name'])){
			$error = $this->Article->check_file($file);
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
			$errors = $this->Article->check($post);
			if(count($errors) == 0){
				$this->do_file($post, $errors, $this->request->file);
			}
			if(count($errors) == 0){
				$post['time'] = DATETIME;
				$this->Article->escape($post);
				$this->Article->save($post);
				$this->Log->action_article_add($admin, $post['title']);
				$this->response->redirect('index');
			}
			else{
				$article = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('article', $article);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$article = $this->Article->get($id);
			}
			if($article){
				$article = $this->set_model($post, $article);
				$errors = $this->Article->check($article);
				if(count($errors) == 0){
					$this->do_file($post, $errors, $this->request->file);
				}
				if(count($errors) == 0){
					$post['lastmodify'] = DATETIME;
					$this->Article->escape($post);
					$this->Article->save($post);
					$this->Log->action_article_edit($admin, $post['title']);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('article', $article);
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
				$article = $this->Article->get($id);
			}
			if($article){
				$this->set('article', $article);
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
				$this->Article->delete($ids);
				$this->Log->action_article_delete($admin, '多篇文章');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$article = $this->Article->get($id);
				$this->Article->delete($id);
				$this->Log->action_article_delete($admin, $article->title);
			}
			$this->response->redirect('index');
		}
	}
	
}