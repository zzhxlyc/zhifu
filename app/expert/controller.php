<?php

class ExpertController extends AppController {
	
	public $models = array('Expert', 'Tag', 'TagItem', 'Patent', 'Solution', 
								'Problem');
	
	public function before(){
		$this->set('home', ADMIN_EXPERT_HOME);
		parent::before();
	}
	
	public function index(){
		
	}
	
	public function profile(){
		$get = $this->request->get;
		$id = $get['id'];
		$has_error = true;
		if($id){
			$Expert = $this->Expert->get($id);
			if($Expert){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
		}
		
		$this->set('$Expert', $Expert);
		
		$cond = array('type'=>'Expert', 'belong'=>$id);
		$tag_list = $this->TagItem->get_list($cond);
		$tag_list = $this->TagItem->get_most($tag_list);
		if(count($tag_list) > 0){
			$tags = $this->Tag->get_list(array('id in'=>$tag_list));
		}
		else{
			$tags = array();
		}
		$this->set('$tags', $tags);
		
		$cond = array('expert'=>$id);
		$patents = $this->Patent->get_list($cond, array('lastmodify'=>'DESC'));
		$this->set('$patents', $patents);
		
		$cond = array('expert'=>$id);
		$solutions = $this->Solution->get_list($cond);
		if(count($solutions) > 0){
			$problem_ids = get_attrs($solutions, 'problem');
			$cond = array('id in'=>$problem_ids);
			$problems = $this->Problem->get_list($cond, array('lastmodify'=>'DESC'));
		}
		else{
			$problems = array();
		}
		$this->set('$problems', $problems);
	}
	
}