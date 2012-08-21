<?php

class ProblemController extends AdminBaseController {
	
	public $models = array('Problem', 'Category', 'Log', 'Tag', 'TagItem');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_PROBLEM_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Problem->count();
		$pager = new Pager($all, $page, $limit);
		$cond = array();
		$list = $this->Problem->get_page($cond, array('time'=>'DESC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_PROBLEM_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function set_data($problem){
		$this->add_categorys();
		$this->add_tag_data($problem->id, BelongType::PROBLEM);
		$this->add_common_tags();
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem){
				$has_error = false;
			}
		}
		if($has_error){
			$this->set('error', '不存在');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
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
				$post['lastmodify'] = DATETIME;
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Problem->image){
					FileSystem::remove($Problem->image);
				}
				if($post['file'] && $Problem->file){
					FileSystem::remove($Problem->file);
				}
				$this->Problem->escape($post);
				$this->Problem->save($post);
				$this->Log->action_problem_edit($admin, $post['title']);
				$this->response->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('problem', $Problem);
		$this->set_data($Problem);
	}
	
}