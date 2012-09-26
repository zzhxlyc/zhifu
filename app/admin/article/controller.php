<?php

class ArticleController extends AdminBaseController {
	
	public $models = array('Article', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_ARTICLE_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$cond = array();
		$all = $this->Article->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Article->get_page($cond, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_ARTICLE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$Admin = $this->get('User');
			$post['admin'] = get_admin_session($this->session);
			$post['author'] = $Admin->name;
			$errors = $this->Article->check($post);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$post['time'] = DATETIME;
				$post['lastmodify'] = DATETIME;
				$post['click'] = 0;
				$image = preg_image($post['content']);
				if($image){
					$post['image'] = $image;
				}
				$this->Article->escape($post);
				$this->Article->save($post);
				$this->Log->action_article_add($Admin->id, $post['title']);
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
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$Article = $this->Article->get($id);
			if($Article){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Article = $this->set_model($post, $Article);
			$errors = $this->Article->check($Article);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$post['lastmodify'] = DATETIME;
				if($post['file'] && $Article->file){
					FileSystem::remove($Article->file);
				}
				$this->Article->escape($post);
				$this->Article->save($post);
				$admin = get_admin_session($this->session);
				$this->Log->action_article_edit($admin, $post['title']);
				$this->response->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('article', $Article);
	}
	
}