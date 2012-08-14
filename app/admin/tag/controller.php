<?php

class TagController extends AdminBaseController {
	
	public $models = array('Tag', 'TagItem');
	public $no_session = array('build');
	
	public function before(){
		$this->set('home', ADMIN_TAG_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$cond = array();
		$all = $this->Tag->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Tag->get_page($cond, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_TAG_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$post['count'] = 0;
			$admin = get_admin_session($this->session);
			$errors = $this->Tag->check($post);
			if(empty($errors['name'])){
				$count = $this->Tag->count(array('name'=>$post['name']));
				if($count > 0){
					$errors['name'] = '此标签已存在';
				}
			}
			if(count($errors) == 0){
				$this->Tag->escape($post);
				$this->Tag->save($post);
				$this->response->redirect('index');
			}
			else{
				$tag = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('tag', $tag);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_id($post);
			if($id > 0){
				$tag = $this->Tag->get($id);
			}
			if($tag){
				$tag = $this->set_model($post, $tag);
				$errors = $this->Tag->check($tag);
				if(count($errors) == 0){
					$this->Tag->escape($post);
					$this->Tag->save($post);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('tag', $tag);
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
				$tag = $this->Tag->get($id);
			}
			if($tag){
				$this->set('tag', $tag);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
	public function delete(){
		$r = $this->request;
		$tag_id_array = $this->get_delete_ids($r->get, $r->post);
		if($tag_id_array){
			$this->TagItem->delete_all(array('tag in'=>$tag_id_array));
		}
		parent::delete();
	}
	
	public function build(){
		if($this->request->post){
			$tag_list = $this->Tag->get_list(array(), array('count'=>'DESC'), 5);
			$array = array();
			foreach($tag_list as $tag){
				$array[] = array('id'=>$tag->id, 'name'=>$tag->name, 'count'=>$tag->count);
			}
			Option::persist('MOST_COMMON_TAGS', serialize($array));
		}
	}
	
}