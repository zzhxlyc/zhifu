<?php

class ProblemController extends AdminBaseController {
	
	public $models = array('Problem', 'Category', 'Log', 'Tag', 'TagItem', 'Comment');
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
				$this->do_tags($Problem, $post['old_tag'], $post['new_tag']);
				if(!empty($post['deadline']) && strtotime($post['deadline']) > DATETIME){
					if($Problem->closed == 1){
						$post['closed'] = 0;
					}
				}
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
				$this->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('problem', $Problem);
		$this->set_data($Problem);
	}
	
	public function verify(){
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
			$d = array('id'=>$id, 'verify'=>1, 'status'=>1);
			$this->Problem->save($d);
			$this->redirect('edit?succ&id='.$id);
		}
		$this->set('problem', $Problem);
		$this->set_data($Problem);
	}
	
	public function comment(){
		$get = $this->request->get;
		$page = $get['page'];
		$pid = intval($get['pid']);
		$limit = 10;
		$cond = array('type'=>BelongType::PROBLEM, 'object'=>$pid);
		$all = $this->Comment->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Comment->get_page($cond, array('time'=>'DESC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links($this->get('home').'/comment?pid='.$pid.'&');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
		$this->set('pid', $pid);
	}
	
	public function deletecomm(){
		$data = $this->get_data();
		$id = $data['id'];
		$pid = $data['pid'];
		$cond = array('type'=>BelongType::PROBLEM, 'object'=>$pid, 'id in'=>$id);
		$this->Comment->delete_all($cond);
		$this->redirect('comment?pid='.$pid);
	}
	
}