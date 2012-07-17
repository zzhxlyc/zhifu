<?php

class ProblemController extends AdminBaseController {
	
	public $models = array('Problem', 'Category', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_PROBLEM_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Problem->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Problem->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_PROBLEM_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	private function do_file(&$data, &$errors, &$files){
		$file = $files['file'];
		if($file && is_uploaded_file($file['tmp_name'])){
			$error = $this->Problem->check_file($file);
			if(empty($error)){
				$path = $this->upload_file($file);
				$data['file'] = $path;
			}
			else{
				$errors['file'] = $error;
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$post['company'] = 1;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$problem = $this->Problem->get($id);
			}
			if($problem){
				$problem = $this->set_model($post, $problem);
				$errors = $this->Problem->check($problem);
				if(count($errors) == 0){
					$this->do_file($post, $errors, $this->request->file);
				}
				if(count($errors) == 0){
					$post['lastmodify'] = DATETIME;
					$this->Problem->escape($post);
					$this->Problem->save($post);
					$this->Log->action_problem_edit($admin, $post['title']);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					list($cat_list, $subcat_list) = $this->Category->get_category();
					$this->set('cat_list', $cat_list);
					$this->set('subcat_list', $subcat_list);
					$this->set('errors', $errors);
					$this->set('problem', $problem);
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
				$problem = $this->Problem->get($id);
				$problem->format();
			}
			if($problem){
				$this->set('problem', $problem);
				list($cat_list, $subcat_list) = $this->Category->get_category();
				$this->set('cat_list', $cat_list);
				$this->set('subcat_list', $subcat_list);
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
				$this->Problem->delete($ids);
				$this->Log->action_problem_delete($admin, '多个难题');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$problem = $this->Problem->get($id);
				$this->Problem->delete($id);
				$this->Log->action_problem_delete($admin, $problem->title);
			}
			$this->response->redirect('index');
		}
	}
	
}