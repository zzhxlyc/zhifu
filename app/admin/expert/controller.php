<?php

class ExpertController extends AdminBaseController {
	
	public $models = array('Expert', 'Patent', 'Log', 'Tag', 'TagItem');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_EXPERT_HOME);
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
	
	private function set_data($id){
		$tags = $this->TagItem->get_list(array('belong'=>$id, 
										'type'=>BelongType::EXPERT));
		$tag_id_array = get_attrs($tags, 'tag');
		if($tag_id_array){
			$tag_list = $this->Tag->get_list(array('id in'=>$tag_id_array));
			$this->set('tag_list', $tag_list);
		}
	}
	
	private function add_data(&$expert){
		$list = $this->Patent->get_list(array('expert'=>$expert->id));
		$expert->patent_num = count($list);
		$sum = 0;
		foreach($list as $o){
			$sum += $o->budget;
		}
		$expert->patent_budget = $sum;
		
		$expert->problem_num = 0;
		$expert->problem_budget = 0;
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
				else{
					$this->set('errors', $errors);
					$this->set('expert', $expert);
					$this->set_data($expert->id);
					$this->add_data($expert);
				}
			}
			else{
				$this->response->redirect('show?id='.$id);
			}
		}
	}
	
	public function show(){
		$get = $this->request->get;
		$id = get_id($get);
		if($id > 0){
			$expert = $this->Expert->get($id);
		}
		if($expert){
			$this->set('expert', $expert);
			$this->set_data($expert->id);
			$this->add_data($expert);
		}
		else{
			$this->set('error', '不存在');
		}
	}

	public function edit(){
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
					$this->do_tag($id, BelongType::EXPERT, 
										$post['old_tag'], $post['new_tag']);
					unset($post['old_tag'], $post['new_tag']);
					$this->Expert->escape($post);
					$this->Expert->save($post);
					$this->Log->action_expert_edit($admin, $expert->name);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('expert', $expert);
					$this->set_data($expert->id);
					$this->add_data($expert);
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
				$expert = $this->Expert->get($id);
			}
			if($expert){
				$this->set('expert', $expert);
				$this->set_data($expert->id);
				$this->add_data($expert);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
}