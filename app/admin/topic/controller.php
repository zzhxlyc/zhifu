<?php

class TopicController extends AdminBaseController {
	
	public $models = array('Topic', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_TOPIC_HOME);
		$this->set('index_page', ADMIN_TOPIC_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Topic->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Topic->get_page(array('parent'=>0), array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_TOPIC_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function comment(){
		$get = $this->request->get;
		$id = $get['id'];
		$page = $get['page'];
		$limit = 10;
		if($id){
			$all = $this->Topic->count();
			$pager = new Pager($all, $page, $limit);
			$list = $this->Topic->get_page(array('parent'=>$id), array('id'=>'DESC'), $pager->now(), $limit);
			$page_list = $pager->get_page_links(ADMIN_TOPIC_HOME.'/comment?id='.$id.'&');
			$this->set('list', $list);
			$this->set('$page_list', $page_list);
		}
		else{
			$this->set('error', '无此话题');
		}
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
//					$post['lastmodify'] = DATETIME;
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
		$has_comment = false;
		$array = array();
		$parent = 0;
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			if(isset($post['c']) && $post['c'] == '1'){
				$has_comment = true;
			}
			if(isset($post['p'])){
				$parent = intval($post['p']);
			}
			if(isset($post['id'])){
				$array = $post['id'];
			}
		}
		else{
			$get = $this->request->get;
			if(isset($get['c']) && $get['c'] == '1'){
				$has_comment = true;
			}
			if(isset($get['p'])){
				$parent = intval($get['p']);
			}
			if(isset($get['id'])){
				$array[] = get_id($get['id']);
			}
		}
		if($has_comment){
			$list = $this->Topic->get_list(array('id in'=>$array, 'parent'=>0));
			$id_array = get_ids($list);
			$this->Topic->delete_all(array('parent in'=>$id_array));
		}
		else if($parent > 0){
			$count = $this->Topic->count(array('parent'=>$parent, 'id in'=>$array));
			$this->Topic->update(array('comments eq'=>"comments - $count"), array('id'=>$parent));
		}
		parent::delete();
	}
	
}