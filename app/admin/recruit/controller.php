<?php

class RecruitController extends AdminBaseController {
	
	public $models = array('Recruit', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_RECRUIT_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Recruit->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Recruit->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_RECRUIT_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data(&$recruit){
		$recruit->user_name = BelongType::get_user($recruit->belong, $recruit->type);
		$available = $recruit->available;
		$recruit->days = array();
		$days = explode(' ', $available);
		foreach($days as $day){
			$day = trim($day);
			$recruit->days[] = explode('-', $day);
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$recruit = $this->Recruit->get($id);
			}
			if($recruit){
				$recruit = $this->set_model($post, $recruit);
				$errors = $this->Recruit->check($recruit);
				if(count($errors) == 0){
					$this->Recruit->escape($post);
					$this->Recruit->save($post);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->add_data($recruit);
					$this->set('recruit', $recruit);
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
				$recruit = $this->Recruit->get($id);
				$this->add_data($recruit);
			}
			if($recruit){
				$this->set('recruit', $recruit);
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
				$this->Recruit->delete($ids);
				$this->Log->action_recruit_delete($admin, '多个难题');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$recruit = $this->Recruit->get($id);
				$this->Recruit->delete($id);
				$this->Log->action_recruit_delete($admin, $recruit->title);
			}
			$this->response->redirect('index');
		}
	}
	
}