<?php

class IdeaController extends AdminBaseController {
	
	public $models = array('Idea', 'Category', 'Log', 'Tag', 'TagItem', 'Comment');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_IDEA_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Idea->count();
		$pager = new Pager($all, $page, $limit);
		$cond = array();
		$list = $this->Idea->get_page($cond, array('time'=>'DESC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_IDEA_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	private function set_data($idea){
		$this->add_categorys();
		$this->add_tag_data($idea->id, BelongType::IDEA);
		$this->add_common_tags();
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$Idea = $this->Idea->get($id);
			if($Idea){
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
			$Idea = $this->set_model($post, $Idea);
			$errors = $this->Idea->check($Idea);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				$this->resize_upload_image($path);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tag($id, BelongType::IDEA, 
									$post['old_tag'], $post['new_tag']);
				if(!empty($post['deadline']) && strtotime($post['deadline']) > DATETIME){
					if($Problem->closed == 1){
						$post['closed'] = 0;
					}
				}
				$post['lastmodify'] = DATETIME;
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Idea->image){
					FileSystem::remove($Idea->image);
				}
				if($post['file'] && $Idea->file){
					FileSystem::remove($Idea->file);
				}
				$this->Idea->escape($post);
				$this->Idea->save($post);
				$this->Log->action_idea_edit($admin, $post['title']);
				$this->response->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('idea', $Idea);
		$this->set_data($Idea);
	}
	
	public function comment(){
		$get = $this->request->get;
		$page = $get['page'];
		$pid = intval($get['pid']);
		$limit = 10;
		$cond = array('type'=>BelongType::IDEA, 'object'=>$pid);
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
		$cond = array('type'=>BelongType::IDEA, 'object'=>$pid, 'id in'=>$id);
		$this->Comment->delete_all($cond);
		$this->redirect('comment?pid='.$pid);
	}
	
}