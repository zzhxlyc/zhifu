<?php

class ProblemController extends AdminBaseController {
	
	public $models = array('Problem', 'Category', 'Log', 'Tag', 'TagItem');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_PROBLEM_HOME);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Problem->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Problem->get_joins(array('problems.*', 'companys.name as name'), 
										array('problems', 'companys'), 
										array('problems.company'=>'companys.id'), 
										array('problems.time'=>'DESC'),
										$pager->get_limit_str());
		$page_list = $pager->get_page_links(ADMIN_PROBLEM_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
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
	
	private function do_tag($object_id, $type, $old_tag, $new_tag){
		$tag_array = array();	// the now exist tag ids
		if(strlen($old_tag) > 0){
			$tag_array = split_ids($old_tag);
		}
		$tag_items = $this->TagItem->get_list(array('belong'=>$object_id, 'type'=>$type));
		$tag_old_array = get_attrs($tag_items, 'tag');	// the old exist tag ids
		$remove_tag_array = array_diff($tag_old_array, $tag_array);
		if(count($remove_tag_array) > 0){
			$tag_item_ids = array();
			foreach($tag_items as $old_tag){
				if(in_array($old_tag->tag, $remove_tag_array)){
					$tag_item_ids[] = $old_tag->id;
				}
			}
			$this->TagItem->delete($tag_item_ids);
		}
		$this->Tag->minus($remove_tag_array);
		
		$new_tag_array = array();
		$new_tag = trim($new_tag);
		if(strlen($new_tag) > 0){
			$new_tag_array = split_words($new_tag);
		}
		if($new_tag_array){
			$tags = $this->Tag->get_list(array('name in'=>$new_tag_array));
			$named_tags = array_to_map($tags, 'name');
			$plus_tag_array = array();
			foreach($new_tag_array as $tag_name){
				$tag_id = 0;
				if(!array_key_exists($tag_name, $named_tags)){
					$tag_data = array('name'=>$tag_name, 'count'=>1);
					$errors = $this->Tag->check($tag_data); 
					if(count($errors) == 0){
						$tag_id = $this->Tag->save($tag_data);
					}
				}
				else{
					$tag_id = $named_tags[$tag_name]->id;
				}
				if($tag_id > 0 && !in_array($tag_id, $tag_array)){
					$data = array('tag'=>$tag_id, 'belong'=>$object_id, 'type'=>$type);
					$count = $this->TagItem->count($data);
					if($count == 0){
						$this->TagItem->save($data);
						$plus_tag_array[] = $tag_id;
					}
				}
			}
			$this->Tag->plus($plus_tag_array);
		}
	}
	
	private function set_data($id){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
		$tags = $this->TagItem->get_list(array('belong'=>$id, 
										'type'=>BelongType::PROBLEM));
		$tag_id_array = get_attrs($tags, 'tag');
		if($tag_id_array){
			$tag_list = $this->Tag->get_list(array('id in'=>$tag_id_array));
			$this->set('tag_list', $tag_list);
		}
		$most_common_tags = unserialize(Option::find('MOST_COMMON_TAGS'));
		if($most_common_tags){
			$this->set('$most_common_tags', $most_common_tags);
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
					$this->do_tag($id, BelongType::PROBLEM, 
										$post['old_tag'], $post['new_tag']);
					$post['lastmodify'] = DATETIME;
					unset($post['old_tag'], $post['new_tag']);
					$this->Problem->escape($post);
					$this->Problem->save($post);
					$this->Log->action_problem_edit($admin, $post['title']);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('problem', $problem);
					$this->set_data($problem->id);
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
				$this->set_data($problem->id);
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
				$num = $this->Problem->delete($ids);
				if($num > 0){
					$this->Log->action_problem_delete($admin, $num.'个难题');
				}
			}
		}
		else{
			$get = $this->request->get;
			if(isset($get['id'])){
				$id = $get['id'];
				$problem = $this->Problem->get($id);
				if($problem){
					$this->Problem->delete($id);
					$this->Log->action_problem_delete($admin, $problem->title);
				}
			}
		}
		$this->response->redirect('index');
	}
	
}