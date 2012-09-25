<?php

class PatentController extends AppController {
	
	public $models = array('Patent', 'Tag', 'TagItem', 'Category', 'Deal', 'Comment');
	
	public function before(){
		$this->set('home', PATENT_HOME);
		parent::before();
		$need_login = array('detail', 'submit');	// either
		$need_company = array();
		$need_expert = array('add', 'edit');
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$ord = $get['order'];
		$limit = 10;
		$condition = array();
		$order = array();
		if($ord == 'time'){
			$order['time'] = 'DESC';
		}
		else if($ord == 'deadline'){
			$order['deadline'] = 'DESC';
		}
		else if($ord == 'budget'){
			$order['budget'] = 'DESC';
		}
		else{
			$order['id'] = 'DESC';
		}
		$all = $this->Patent->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Patent->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$User = $this->get('User');
			$post['expert'] = $User->id;
			$post['author'] = $User->name;
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
				$old_tag = $post['old_tag'];
				$new_tag = $post['new_tag'];
				unset($post['old_tag'], $post['new_tag']);
				$post['time'] = DATETIME;
				$post['lastmodify'] = DATETIME;
				$this->Patent->escape($post);
				$id = $this->Patent->save($post);
				$this->do_tag($id, BelongType::PATENT, $old_tag, $new_tag);
				$this->redirect('detail?id='.$id);
			}
			$patent = $this->set_model($post, new Patent());
			$this->set('$patent', $patent);
			$this->set('errors', $errors);
		}
		$this->set_data();
	}
	

	private function set_data($Patent = ''){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
		if($Patent){
			$this->add_tag_data($Patent->id, BelongType::PATENT);
		}
		$this->add_common_tags();
	}
	
	public function detail(){
		$get = $this->request->get;
		$id = get_id($get);
		$has_error = true;
		if($id){
			$Patent = $this->Patent->get($id);
			if($Patent){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$Patent', $Patent);
		
		$tag_list = $this->add_tags($Patent, false);
		$tag_list = $this->TagItem->get_most($tag_list);
		$this->set('$tags', $tag_list);
		
		$cond = array('patent'=>$id);
		$deals = $this->Deal->get_list($cond, array('time'=>'DESC'));
		if(count($deals) > 0){
			$expert_ids = $company_ids = array();
			foreach($deals as $deal){
				if($deal->type == BelongType::EXPERT){
					$expert_ids[] = $deal->belong;
				}
				else if($deal->type == BelongType::COMPANY){
					$company_ids[] = $deal->belong;
				}
			}
			if(count($expert_ids) > 0){
				$cond = array('id in'=>$expert_ids);
				$experts = $this->Expert->get_list($cond);
			}
			if(count($company_ids) > 0){
				$cond = array('id in'=>$company_ids);
				$companys = $this->Company->get_list($cond);
			}
			$experts = get_map_by_id($experts);
			$companys = get_map_by_id($companys);
			$buyers = array();
			foreach($deals as $deal){
				if($deal->type == BelongType::EXPERT){
					$buyers[$deal->id] = $experts[$deal->belong];
				}
				else if($deal->type == BelongType::COMPANY){
					$buyers[$deal->id] = $companys[$deal->belong];
				}
			}
		}
		else{
			$buyers = array();
		}
		$this->set('$buyers', $buyers);
		$this->set('$deals', $deals);
		
		$this->show_categorys($Patent);
		$page = get_page($get);
		$this->add_comments($Patent, $page);
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Patent = $this->Patent->get($id);
//			if($Patent && $User->is_expert() && $Patent->expert == $User->id){
			if($Patent){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
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
				if($post['image'] && $Patent->image){
					FileSystem::remove($Patent->image);
				}
				if($post['file'] && $Patent->file){
					FileSystem::remove($Patent->file);
				}
				$this->Patent->escape($post);
				$this->Patent->save($post);
				$this->redirect('edit?succ&id='.$id);
			}
			$this->set('errors', $errors);
		}
		$this->set_data($Patent);
		$this->set('patent', $Patent);
	}
	
	public function submit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Patent = $this->Patent->get($id);
			if($Patent){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$cond = array('patent'=>$id, 'belong'=>$User->id, 'type'=>$User->get_type());
			$count = $this->Deal->count($cond);
			if($count == 0){
				if($User->get_type() == BelongType::EXPERT){
					if($Patent->expert == $User->id){
						$this->redirect('detail?id='.$id);
					}
				}
				$data = array();
				$data['patent'] = $id;
				$data['pname'] = $Patent->title;
				$data['belong'] = $User->id;
				$data['type'] = $User->get_type();
				$data['username'] = $User->username;
				$data['author'] = $User->name;
				$data['time'] = DATETIME;
				$this->Deal->save($data);
			}
			$this->redirect('detail?id='.$id);
		}
		$this->set('$Patent', $Patent);
		$this->show_tags($Patent);
//		$this->show_categorys($Patent);
	}
	
	
}