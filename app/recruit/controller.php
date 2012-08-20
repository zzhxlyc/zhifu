<?php

class RecruitController extends AppController {
	
	public $models = array('Recruit');
	
	public function before(){
		$this->set('home', RECRUIT_HOME);
		parent::before();
		$need_login = array();	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$type = $get['type'];
		$cond = array();
		if($type == 'zhaopin'){
			$cond['type'] = BelongType::COMPANY;
		}
		else if($type == 'qiuzhi'){
			$cond['type'] = BelongType::EXPERT;
		}
		$limit = 10;
		$order = array('time'=>'DESC');
		$all = $this->Recruit->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Recruit->get_page($cond, $order, $pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function show(){
		$get = $this->request->get;
		$id = get_id($get);
		$has_error = true;
		if($id){
			$recruit = $this->Recruit->get($id);
			if($recruit){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$recruit->do_available();
		$this->set('$recruit', $recruit);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$User = $this->get('User');
			$post['belong'] = $User->id;
			$post['type'] = $User->get_type();
			$post['author'] = $User->name;
			$errors = $this->Recruit->check($post);
			if(count($errors) == 0){
				$post['status'] = 1;
				$post['time'] = DATETIME;
				$this->Recruit->escape($post);
				$id = $this->Recruit->save($post);
				$this->redirect('show?id='.$id);
			}
		}
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = get_id($data);
		$has_error = true;
		if($id){
			$recruit = $this->Recruit->get($id);
			if($recruit){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$User = $this->get('User');
			$recruit = $this->set_model($post, $recruit);
			$errors = $this->Recruit->check($recruit);
			if(count($errors) == 0){
				$this->Recruit->escape($post);
				$this->Recruit->save($post);
				$this->redirect('show?id='.$id);
			}
		}
		$recruit->do_available();
		$this->set('$recruit', $recruit);
	}
	
	
}