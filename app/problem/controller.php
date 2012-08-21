<?php

class ProblemController extends AppController {
	
	public $models = array('Problem', 'Tag', 'TagItem', 'Solution', 
								'Category', 'Comment');
	
	public function before(){
		$this->set('home', PROBLEM_HOME);
		parent::before();
		$need_login = array();	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
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
		$id = get_id($get);
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
		
		$tag_list = $this->add_tag_data($id, BelongType::PROBLEM, false);
		$tag_list = $this->TagItem->get_most($tag_list);
		$this->set('$tags', $tag_list);
		
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
		
		$page = get_page($get);
		$this->add_comments($id, BelongType::PROBLEM, $page);
	}
	
	private function add_data($Problem = null){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
		if($Problem){
			$this->add_tag_data($Problem->id, BelongType::PROBLEM);
		}
		$this->add_common_tags();
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			if($post['type'] == '1'){
				$data = array('title'=>$post['t'], 'description'=>$post['desc']);
				$post = $data;
			}
			if(isset($post['deadline']) && empty($post['deadline'])){
				unset($post['deadline']);
			}
			if(isset($post['type'])){
				unset($post['type'], $post['t'], $post['desc']);
			}
			$User = $this->get('User');
			$post['company'] = $User->id;
			$post['author'] = $User->name;
			$Problem = $this->set_model($post, $Problem);
			$errors = $this->Problem->check($Problem);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$old_tag = $post['old_tag'];
				$new_tag = $post['new_tag'];
				unset($post['old_tag'], $post['new_tag']);
				$post['time'] = DATETIME;
				$post['status'] = 0;
				$this->Problem->escape($post);
				$id = $this->Problem->save($post);
				$this->do_tag($id, BelongType::PROBLEM, $old_tag, $new_tag);
				$this->redirect('detail?id='.$id);
			}
			$problem = $this->set_model($post, new Problem());
			$this->set('$problem', $problem);
			$this->set('errors', $errors);
		}
		$this->add_data();
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
//			if($Problem && $User->is_company() && $Problem->company == $User->id){
			if($Problem){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Problem = $this->set_model($post, $Problem);
			$errors = $this->Problem->check($Problem);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tag($id, BelongType::PROBLEM, 
									$post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Problem->image){
					FileSystem::remove($Problem->image);
				}
				if($post['file'] && $Problem->file){
					FileSystem::remove($Problem->file);
				}
				$this->Problem->escape($post);
				$this->Problem->save($post);
				$this->redirect('edit?succ&id='.$id);
			}
			$this->set('errors', $errors);
		}
		$this->add_data($Problem);
		$this->set('problem', $Problem);
	}
	
	public function solution(){
		
	}
	
	
}