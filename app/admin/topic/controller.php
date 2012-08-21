<?php

class TopicController extends AdminBaseController {
	
	public $models = array('Topic', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_TOPIC_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$cond = array('parent'=>0);
		$all = $this->Topic->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Topic->get_page($cond, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_TOPIC_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function comment(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$topic = $this->Topic->get($id);
			if($topic){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		$page = $get['page'];
		$limit = 10;
		$cond = array('parent'=>$topic->id);
		$all = $this->Topic->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Topic->get_page($cond, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_TOPIC_HOME.'/comment?id='.$id.'&');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$Admin = $this->get('User');
			$post['belong'] = $Admin->id;
			$post['type'] = BelongType::ADMIN;
			$post['author'] = $Admin->get_name();
			$post['parent'] = 0;
			$errors = $this->Topic->check($post);
			if(strlen($post['title']) == 0){
				$errors['title'] = '标题为空';
			}
			if(count($errors) == 0){
				$post['comments'] = 0;
				$post['time'] = DATETIME;
				$this->Topic->escape($post);
				$this->Topic->save($post);
				$this->Log->action_topic_add($Admin->id, $post['title']);
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
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$topic = $this->Topic->get($id);
			if($topic){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$topic = $this->set_model($post, $topic);
			$errors = $this->Topic->check($topic);
			if(count($errors) == 0){
				$this->Topic->escape($post);
				$this->Topic->save($post);
				$admin = get_admin_session($this->session);
				$this->Log->action_topic_edit($admin, $post['title']);
				$this->response->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
				$this->set('topic', $topic);
			}
		}
		$this->set('topic', $topic);
	}
	
	public function delete(){
		$has_comment = false;
		$array = array();
		$parent = 0;
		if($this->request->post){
			$post = $this->request->post;
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
				$array[] = get_id($get);
			}
		}
		if($has_comment){
			$list = $this->Topic->get_list(array('id in'=>$array, 'parent'=>0));
			$id_array = get_ids($list);
			$this->Topic->delete_all(array('parent in'=>$id_array));
		}
		else if($parent > 0){
			$count = $this->Topic->count(array('parent'=>$parent, 'id in'=>$array));
			$this->Topic->update(array('comments eq'=>"comments - $count"), 
										array('id'=>$parent));
		}
		parent::delete();
	}
	
}