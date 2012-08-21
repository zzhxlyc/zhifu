<?php

class ExpertController extends AdminBaseController {
	
	public $models = array('Expert', 'Patent', 'Log', 'Tag', 'TagItem');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_EXPERT_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$condition = array();
		$all = $this->Expert->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Expert->get_page($condition, array('id'=>'DESC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_EXPERT_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data(&$expert){
		$list = $this->Patent->get_list(array('expert'=>$expert->id));
		$expert->patent_num = count($list);
		$sum = 0;
		foreach($list as $o){
			$sum += $o->budget;
		}
		$expert->patent_budget = $sum;
	}
	
	public function verify(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$expert = $this->Expert->get($id);
			}
			if($expert){
				$expert = $this->set_model($post, $expert);
				$errors = $this->Expert->check($expert);
				if(count($errors) == 0){
					$post['verified'] = 1;
					$this->Expert->escape($post);
					$this->Expert->save($post);
					$this->Log->action_expert_pass($admin, $expert->name);
					$this->response->redirect('show?id='.$expert->id);
				}
			}
			$this->redirect('show?id='.$id);
		}
	}
	
	public function show(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$expert = $this->Expert->get($id);
			if($expert){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		$this->add_tag_data($id, BelongType::EXPERT);
		$this->add_data($expert);
		$this->set('expert', $expert);
	}

	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$expert = $this->Expert->get($id);
			if($expert){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$expert = $this->set_model($post, $expert);
			$errors = $this->Expert->check($expert);
			if(count($errors) == 0){
				$this->do_tag($id, BelongType::EXPERT, 
									$post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				$this->Expert->escape($post);
				$this->Expert->save($post);
				$admin = get_admin_session($this->session);
				$this->Log->action_expert_edit($admin, $expert->name);
				$this->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->add_tag_data($id, BelongType::EXPERT);
		$this->add_common_tags();
		$this->set('expert', $expert);
	}
	
}