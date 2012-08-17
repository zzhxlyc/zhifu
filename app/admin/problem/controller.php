<?php

class ProblemController extends AdminBaseController {
	
	public $models = array('Problem', 'Company', 'Category', 'Log', 'Tag', 'TagItem');
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
		$list = Model::get_joins(array('P.*', 'C.name as name'), 
										array('Problem as P', 'Company as C'), 
										array('P.company eq'=>'C.id'), 
										array('P.time'=>'DESC'),
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
			}
			if($problem){
				$problem->format();
				$this->set('problem', $problem);
				$this->set_data($problem->id);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
}