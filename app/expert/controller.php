<?php

class ExpertController extends AppController {
	
	public $models = array('Expert', 'Tag', 'TagItem', 'Patent', 'Solution', 
								'Expert', 'Problem');
	
	public function before(){
		$this->set('home', EXPERT_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$ord = $get['order'];
		$limit = 10;
		$condition = array();
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
		$all = $this->Expert->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Expert->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
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
			return;
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
	
	private function add_profile_data(&$Expert){
		$this->add_tag_data($Expert->id, BelongType::EXPERT);
		
		$list = $this->Problem->get_list(array('company'=>$Expert->id));
		$Expert->problem_num = count($list);
		$sum = 0;
		foreach($list as $o){
			$sum += $o->budget;
		}
		$Expert->problem_budget = $sum;
		
		$Expert->patent_num = 0;
		$Expert->patent_budget = 0;
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Expert = $this->Expert->get($id);
//			if($Expert && $Expert->is_expert() && $Expert->id == $User->id){
			if($Expert){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Expert = $this->set_model($post, $Expert);
			$errors = $this->Expert->check($Expert);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				if($path){$post['image'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tag($id, BelongType::EXPERT, 
									$post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Expert->image){
					FileSystem::remove($Expert->image);
				}
				$this->Expert->escape($post);
				$this->Expert->save($post);
				$this->redirect('succ&edit?id='.$id);
			}
			$this->set('errors', $errors);
		}
		$this->add_tag_data($Expert->id, BelongType::EXPERT);
		$this->set('expert', $Expert);
	}
	
}