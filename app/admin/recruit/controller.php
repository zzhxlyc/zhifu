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
		$cond = array();
		$all = $this->Recruit->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Recruit->get_page($cond, array('id'=>'DESC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_RECRUIT_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function add_data(&$recruit){
		$available = $recruit->available;
		$recruit->days = array();
		$days = explode(' ', $available);
		foreach($days as $day){
			$day = trim($day);
			$recruit->days[] = explode('-', $day);
		}
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$Recruit = $this->Recruit->get($id);
			if($Recruit){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Recruit = $this->set_model($post, $Recruit);
			$errors = $this->Recruit->check($Recruit);
			if(count($errors) == 0){
				$this->Recruit->escape($post);
				$this->Recruit->save($post);
				$this->response->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('recruit', $Recruit);
		$this->add_data($Recruit);
	}
	
}