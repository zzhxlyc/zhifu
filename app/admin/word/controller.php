<?php

class WordController extends AdminBaseController {
	
	public $models = array('Word');
	public $no_session = array('build', 'check');
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_WORD_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Word->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Word->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_WORD_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$errors = $this->Word->check($post);
			if(empty($errors['name'])){
				$count = $this->Word->count(array('name'=>$post['name']));
				if($count > 0){
					$errors['name'] = '此敏感词已存在';
				}
			}
			if(count($errors) == 0){
				$this->Word->escape($post);
				$this->Word->save($post);
				$this->response->redirect('index');
			}
			else{
				$word = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('word', $word);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_id($post);
			if($id > 0){
				$word = $this->Word->get($id);
			}
			if($word){
				$word = $this->set_model($post, $word);
				$errors = $this->Word->check($word);
				if(count($errors) == 0){
					$this->Word->escape($post);
					$this->Word->save($post);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('word', $word);
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
				$word = $this->Word->get($id);
			}
			if($word){
				$this->set('word', $word);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
	public function delete(){
		if($this->request->post){
			$post = $this->request->post;
			if(isset($post['ids'])){
				$ids = $post['ids'];
				$this->Word->delete($ids);
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$this->Word->delete($id);
			}
			$this->response->redirect('index');
		}
	}
	
	public function build(){
		$words = $this->Word->build();
	}
	
}