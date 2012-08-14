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
		$list = Model::get_joins(array('patents.*', 'experts.name as name'), 
										array('patents', 'experts'), 
										array('patents.expert eq'=>'experts.id'), 
										array('patents.time'=>'DESC'),
										$pager->get_limit_str());
		$links = $pager->get_page_links(ADMIN_PROBLEM_HOME.'/index?');
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
	
	private function set_data($id){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
		$tags = $this->TagItem->get_list(array('belong'=>$id, 
										'type'=>BelongType::PATENT));
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
					$this->do_tag($id, BelongType::PATENT, 
										$post['old_tag'], $post['new_tag']);
					$post['lastmodify'] = DATETIME;
					unset($post['old_tag'], $post['new_tag']);
					$this->Patent->escape($post);
					$this->Patent->save($post);
					$this->Log->action_patent_edit($admin, $post['title']);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('patent', $patent);
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
				$patent = $this->Patent->get($id);
			}
			if($patent){
				$patent->format();
				$this->set('$patent', $patent);
				$this->set_data($patent->id);
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
}