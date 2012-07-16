<?php

class PatentController extends AdminBaseController {
	
	public $models = array('Patent', 'Category', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_PATENT_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Patent->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Patent->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_PATENT_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	private function do_file(&$data, &$errors, &$files){
		$file = $files['file'];
		if($file && is_uploaded_file($file['tmp_name'])){
			$error = $this->Patent->check_file($file);
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
			$post['expert'] = 1;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$patent = $this->Patent->get($id);
			}
			if($patent){
				$patent = $this->set_model($post, $patent);
				$errors = $this->Patent->check($patent);
				if(count($errors) == 0){
					$this->do_file($post, $errors, $this->request->file);
				}
				if(count($errors) == 0){
					$post['lastmodify'] = DATETIME;
					$this->Patent->escape($post);
					$this->Patent->save($post);
					$this->Log->action_patent_edit($admin, $post['title']);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					list($cat_list, $subcat_list) = $this->Category->get_category();
					$this->set('cat_list', $cat_list);
					$this->set('subcat_list', $subcat_list);
					$this->set('errors', $errors);
					$this->set('patent', $patent);
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
				$patent = $this->Patent->get($id);
			}
			if($patent){
				$this->set('patent', $patent);
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
				$this->Patent->delete($ids);
				$this->Log->action_patent_delete($admin, '多个专利');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$patent = $this->Patent->get($id);
				$this->Patent->delete($id);
				$this->Log->action_patent_delete($admin, $patent->title);
			}
			$this->response->redirect('index');
		}
	}
	
}