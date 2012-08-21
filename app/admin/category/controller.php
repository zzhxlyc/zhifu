<?php

class CategoryController extends AdminBaseController {
	
	public $models = array('Category', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_CATEGORY_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$condition = array('parent'=>0);
		$all = $this->Category->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Category->get_page($condition, array('id'=>'DESC'), 
											$pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_CATEGORY_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function sub(){
		$get = $this->request->get;
		$page = $get['page'];
		$parent = $get['id'];
		$limit = 10;
		if($parent){
			$condition = array('parent'=>$parent);
			$all = $this->Category->count($condition);
			$pager = new Pager($all, $page, $limit);
			$list = $this->Category->get_page($condition, array('id'=>'DESC'), 
												$pager->now(), $limit);
			$page_list = $pager->get_page_links(ADMIN_CATEGORY_HOME.'/sub?p='.$parent.'&');
			$this->set('list', $list);
			$this->set('$page_list', $page_list);
		}
		else{
			$this->set('error', '无此一级行业');
		}
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$post['parent'] = 0;
			$errors = $this->Category->check($post);
			if(count($errors) == 0){
				$this->Category->escape($post);
				$this->Category->save($post);
				$this->Log->action_category_add($admin, $post['name']);
				$this->response->redirect('index');
			}
			else{
				$category = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('category', $category);
			}
		}
	}
	
	public function addsub(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$errors = $this->Category->check($post);
			if(count($errors) == 0){
				$this->Category->escape($post);
				$this->Category->save($post);
				$this->Log->action_category_add($admin, $post['name']);
				$this->response->redirect('index');
			}
			else{
				$category = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('category', $category);
			}
		}
		$list = $this->Category->get_list(array('parent'=>0), array('id'=>'ASC'));
		$this->set('list', $list);
	}

	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$condition = array('id'=>$id, 'parent'=>0);
				$category = $this->Category->get_row($condition);
			}
			if($category){
				$category = $this->set_model($post, $category);
				$errors = $this->Category->check($category);
				if(count($errors) == 0){
					$this->Category->escape($post);
					$this->Category->save($post);
					$this->response->redirect('edit?succ&id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('category', $category);
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
				$condition = array('id'=>$id, 'parent'=>0);
				$category = $this->Category->get_row($condition);
			}
			if($category){
				$this->set('category', $category);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
	public function editsub(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$condition = array('id'=>$id, 'parent >'=>0);
				$category = $this->Category->get_row($condition);
			}
			if($category){
				$category = $this->set_model($post, $category);
				$errors = $this->Category->check($category);
				if(count($errors) == 0){
					$this->Category->escape($post);
					$this->Category->save($post);
					$this->response->redirect('editsub?succ&id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('category', $category);
				}
			}
			else{
				$this->set('error', '不存在');
			}
		}
		$list = $this->Category->get_list(array('parent'=>0), array('id'=>'ASC'));
		$this->set('list', $list);
		$get = $this->request->get;
		$id = get_id($get);
		if($id > 0){
			$condition = array('id'=>$id, 'parent >'=>0);
			$category = $this->Category->get_row($condition);
		}
		if($category){
			$this->set('category', $category);
		}
		else{
			$this->set('error', '不存在');
		}
	}
	
	public function delete(){
		$has_children = false;
		$id_array = array();
		$admin = get_admin_session($this->session);
		if($this->request->post){
			$data = $this->request->post;
			$id_array = $data['id'];
		}
		else{
			$data = $this->request->get;
			$id_array[] = $data['id'];
		}
		if(isset($data['c']) && $data['c'] == '1'){
			$has_children = true;
		}
		if($has_children){
			$this->Topic->delete_all(array('parent in'=>$id_array));
		}
		parent::delete();
	}
	
}