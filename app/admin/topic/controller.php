<?php

class TopicController extends AdminController {
	
	public $models = array('Topic', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_TOPIC_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Topic->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Topic->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_TOPIC_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$post['belong'] = $admin;
			$post['type'] = BelongType::ADMIN;
			$post['parent'] = 0;
			$errors = $this->Topic->check($post);
			if(count($errors) == 0){
				$post['comments'] = 0;
				$post['time'] = DATETIME;
				$this->Topic->escape($post);
				$this->Topic->save($post);
				$this->Log->action_topic_add($admin, $post['title']);
				$this->response->redirect('index');
			}
			else{
				$topic = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('topic', $topic);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$topic = $this->Topic->get($id);
			}
			if($topic){
				$topic = $this->set_model($post, $topic);
				$errors = $this->Topic->check($topic);
				if(count($errors) == 0){
					$this->do_file($post, $errors, $this->request->file);
				}
				if(count($errors) == 0){
					$post['lastmodify'] = DATETIME;
					$this->Topic->escape($post);
					$this->Topic->save($post);
					$this->Log->action_topic_edit($admin, $post['title']);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('topic', $topic);
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
				$topic = $this->Topic->get($id);
			}
			if($topic){
				$this->set('topic', $topic);
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
				$this->Topic->delete($ids);
				$this->Log->action_topic_delete($admin, '多篇文章');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$topic = $this->Topic->get($id);
				$this->Topic->delete($id);
				$this->Log->action_topic_delete($admin, $topic->title);
			}
			$this->response->redirect('index');
		}
	}
	
}