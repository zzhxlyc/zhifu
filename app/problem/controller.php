<?php

class ProblemController extends AppController {
	
	public $models = array('Problem', 'Company', 'Expert', 'Tag', 'TagItem', 
						'Solution', 'Category');
	
	public function before(){
		$this->set('home', PROBLEM_HOME);
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
		$all = $this->Problem->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Problem->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links(PROBLEM_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function detail(){
		$get = $this->request->get;
		$id = $get['id'];
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$Problem', $Problem);
		
		$Company = $this->Company->get($Problem->company);
		$this->set('$Company', $Company);
		
		$cond = array('type'=>'Problem', 'belong'=>$id);
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
		$solutions = $this->Solution->get_list($cond);
		if(count($solutions) > 0){
			$expert_ids = get_attrs($solutions, 'expert');
			$cond = array('id in'=>$expert_ids);
			$experts = $this->Expert->get_list($cond);
		}
		else{
			$experts = array();
		}
		$this->set('$experts', $experts);
	}
	
	private function add_data($id = Null){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
		if($id){
			$tags = $this->TagItem->get_list(array('belong'=>$id, 
											'type'=>BelongType::PROBLEM));
			$tag_id_array = get_attrs($tags, 'tag');
			if($tag_id_array){
				$tag_list = $this->Tag->get_list(array('id in'=>$tag_id_array));
				$this->set('tag_list', $tag_list);
			}
		}
		$most_common_tags = unserialize(Option::find('MOST_COMMON_TAGS'));
		if($most_common_tags){
			$this->set('$most_common_tags', $most_common_tags);
		}
	}
	
	public function add(){
		$this->add_data();
	}
	
	public function solution(){
		
	}
	
	
}