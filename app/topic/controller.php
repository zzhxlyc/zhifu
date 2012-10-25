<?php

class TopicController extends AppController {
	
	public $models = array('Topic');
	
	public function before(){
		$this->set('home', TOPIC_HOME);
		parent::before();
		$need_login = array('add', 'edit', 'reply', 'detail');	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function detail(){
		$get = $this->request->get;
		$id = get_id($get);
		$has_error = true;
		if($id){
			$topic = $this->Topic->get($id);
			if($topic){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$topic', $topic);
		$cond = array('parent'=>$id);
		$all = $this->Topic->count($cond);
		$limit = 10;
		$page = $get['page'];
		$pager = new Pager($all, $page, $limit);
		$list = $this->Topic->get_page($cond, array('time'=>'ASC'), 
										$pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home')."/detail?id=$id&");
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$User = $this->get('User');
			$post['parent'] = 0;
			$this->set_belong($post, $User);
			$errors = $this->Topic->check($post);
			if(trim($post['title']) == ''){
				$errors['title'] = '不能为空';
			}
			if(count($errors) == 0){
				$post['comments'] = 0;
				$post['time'] = DATETIME;
				$this->Topic->escape($post);
				$id = $this->Topic->save($post);
				$this->redirect('detail?id='.$id);
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
		$id = get_id($data);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$topic = $this->Topic->get($id);
			if($topic && $topic->belong == $User->id && $topic->type == $User->get_type()){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($topic->parent == 0){
			$back_id = $topic->id;
		}
		else{
			$back_id = $topic->parent;
		}
		if($this->request->post){
			$post = $this->request->post;
			$topic = $this->set_model($post, $topic);
			$errors = $this->Topic->check($topic);
			if(count($errors) == 0){
				$this->Topic->escape($post);
				$id = $this->Topic->save($post);
				$this->redirect('detail?id='.$back_id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		
		$this->set('$topic', $topic);
		$back_url = $this->get('home').'/detail?id='.$back_id;
		$this->set('$back_url', $back_url);
	}
	
	public function reply(){
		$post = $this->request->post;
		$parent = $post['parent'];
		$has_error = true;
		if($parent){
			$topic = $this->Topic->get($parent);
			if($topic && $topic->parent == 0){
				$has_error = false;
			}
		}
		if($has_error){
			$this->redirect('index');
		}
		$this->layout('ajax');
		
		$User = $this->get('User');
		$post['title'] = '';
		$post['belong'] = $User->id;
		$post['type'] = $User->get_type();
		$post['username'] = $User->username;
		$post['author'] = $User->name;
		$errors = $this->Topic->check($post);
		if(count($errors) == 0){
			$post['comments'] = 0;
			$post['time'] = DATETIME;
			$this->Topic->escape($post);
			$id = $this->Topic->save($post);
			$this->Topic->comment_plus($parent);
			$array = array('id'=>$id, 'uid'=>$post['belong'], 'username'=>$post['username'], 
						'type'=>strtolower($post['type']),'name'=>$post['author'], 
						'time'=>$post['time']);
			echo json_encode($array);
		}
		else{
			echo 0;
		}
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$ord = $get['order'];
		$limit = 10;
		$condition = array('parent'=>0);
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
		$all = $this->Topic->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Topic->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
		$hot_list = $this->Topic->get_list($condition, array('comments'=>'DESC'), 10);
		$this->set('hot_list', $hot_list);
	}
	
	
}