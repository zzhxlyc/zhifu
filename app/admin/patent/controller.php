<?php

class PatentController extends AdminBaseController {
	
	public $models = array('Patent', 'Category', 'Log', 'Tag', 'TagItem');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_PATENT_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Patent->count();
		$pager = new Pager($all, $page, $limit);
		$cond = array();
		$list = $this->Patent->get_page($cond, array('time'=>'DESC'), 
											$pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_PATENT_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	private function set_data($Patent){
		$this->add_categorys();
		$this->add_tag_data($Patent->id, BelongType::PATENT);
		$this->add_common_tags();
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$has_error = true;
		if($id){
			$Patent = $this->Patent->get($id);
			if($Patent){
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
			$Patent = $this->set_model($post, $Patent);
			$errors = $this->Patent->check($Patent);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tag($id, BelongType::PATENT, 
								$post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				$post['lastmodify'] = DATETIME;
				if($post['image'] && $Patent->image){
					FileSystem::remove($Patent->image);
				}
				if($post['file'] && $Patent->file){
					FileSystem::remove($Patent->file);
				}
				$this->Patent->escape($post);
				$this->Patent->save($post);
				$this->Log->action_patent_edit($admin, $post['title']);
				$this->redirect('edit?succ&id='.$id);
			}
			else{
				$this->set('errors', $errors);
			}
		}
		$this->set('patent', $Patent);
		$this->set_data($Patent);
	}
	
}