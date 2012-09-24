<?php

class ApplyController extends AppController {
	
	public $models = array('Apply');
	
	public function before(){
		$this->set('home', APPLY_HOME);
		parent::before();
		$need_login = array('show', 'add', 'edit');	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$type = $get['type'];
		$fromday = $get['fromday'];
		$cond = array();
		if($fromday == '3days'){
			$from_ts = TIMESTAMP - 3600 * 24 * 3;
			$cond['time >='] = date('Y-m-d H:i:s', $from_ts);
		}
		else if($fromday == 'week'){
			$from_ts = TIMESTAMP - 3600 * 24 * 7;
			$cond['time >='] = date('Y-m-d H:i:s', $from_ts);
		}
		$limit = 10;
		$order = array('time'=>'DESC');
		$all = $this->Apply->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Apply->get_page($cond, $order, $pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function show(){
		$get = $this->request->get;
		$id = get_id($get);
		$has_error = true;
		if($id){
			$apply = $this->Apply->get($id);
			if($apply){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$apply->do_available();
		$this->set('$apply', $apply);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$User = $this->get('User');
			$post['belong'] = $User->id;
			$post['type'] = $User->get_type();
			$post['username'] = $User->username;
			$post['author'] = $User->name;
			$apply = $this->set_model($post);
			$errors = $this->Apply->check($post);
			if(count($errors) == 0){
				$post['status'] = 1;
				$post['time'] = DATETIME;
				$this->Apply->escape($post);
				$id = $this->Apply->save($post);
				$this->redirect('show?id='.$id);
			}
			$this->set('$apply', $apply);
			$this->set('$errors', $errors);
		}
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = get_id($data);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$apply = $this->Apply->get($id);
			if($apply){
				if($User->id == $apply->belong 
						&& $User->get_type() == $apply->type){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$apply = $this->set_model($post, $apply);
			$errors = $this->Apply->check($apply);
			if(count($errors) == 0){
//				$old_tag = $post['old_tag'];
//				$new_tag = $post['new_tag'];
//				unset($post['old_tag'], $post['new_tag']);
				$this->Apply->escape($post);
				$this->Apply->save($post);
//				$this->do_tag($id, BelongType::RECRUIT, $old_tag, $new_tag);
				$this->redirect('edit?succ&id='.$id);
			}
			$this->set('errors', $errors);
		}
		$apply->do_available();
		$this->set('$apply', $apply);
	}
	
	
}