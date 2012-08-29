<?php

class IdeaController extends AppController {
	
	public $models = array('Idea', 'Tag', 'TagItem', 'IdeaItem', 
								'Category', 'Comment');
	
	public function before(){
		$this->set('home', IDEA_HOME);
		parent::before();
		$need_login = array('detail', 'item');	// either
		$need_company = array('add', 'edit', 'choose', 'finish');
		$need_expert = array('submit', 'itemedit');
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
		$all = $this->Idea->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Idea->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links(IDEA_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function detail(){
		$get = $this->request->get;
		$id = get_id($get);
		$has_error = true;
		if($id){
			$Idea = $this->Idea->get($id);
			if($Idea){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$Idea', $Idea);
		
		$Company = $this->Company->get($Idea->company);
		$this->set('$Company', $Company);
		
		$tag_list = $this->add_tag_data($id, BelongType::IDEA, false);
		$tag_list = $this->TagItem->get_most($tag_list);
		$this->set('$tags', $tag_list);
		
		$cond = array('idea'=>$id);
		$items = $this->IdeaItem->get_list($cond);
		if(count($items) > 0){
			$expert_ids = get_attrs($items, 'expert');
			$cond = array('id in'=>$expert_ids);
			$experts = $this->Expert->get_list($cond);
		}
		else{
			$experts = array();
		}
		$this->set('$experts', get_map_by_id($experts));
		$this->set('$items', $items);
		
		$page = get_page($get);
		$this->add_comments($Idea, $page);
	}
	
	private function add_data($Idea = null){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
		if($Idea){
			$this->add_tag_data($Idea->id, BelongType::IDEA);
		}
		$this->add_common_tags();
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$User = $this->get('User');
			$post['company'] = $User->id;
			$post['author'] = $User->name;
			$Idea = $this->set_model($post, $Idea);
			$errors = $this->Idea->check($Idea);
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
				$post['status'] = 0;
				$this->Idea->escape($post);
				$id = $this->Idea->save($post);
				$this->do_tag($id, BelongType::IDEA, $old_tag, $new_tag);
				$this->redirect('detail?id='.$id);
			}
			$idea = $this->set_model($post);
			$this->set('$idea', $idea);
			$this->set('errors', $errors);
		}
		$this->add_data();
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Idea = $this->Idea->get($id);
			if(is_company_object($User, $Idea)){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->render_403();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Idea = $this->set_model($post, $Idea);
			$errors = $this->Idea->check($Idea);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tag($id, BelongType::IDEA, 
									$post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Idea->image){
					FileSystem::remove($Idea->image);
				}
				if($post['file'] && $Idea->file){
					FileSystem::remove($Idea->file);
				}
				$post['lastmodify'] = DATETIME;
				$this->Idea->escape($post);
				$this->Idea->save($post);
				$this->redirect('edit?succ&id='.$id);
			}
			$this->set('errors', $errors);
		}
		$this->add_data($Idea);
		$this->set('idea', $Idea);
	}
	
	public function submit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Idea = $this->Idea->get($id);
			if($Idea && $User->is_expert()){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post && $Idea->status == 0){
			$post = $this->request->post;
			$post['expert'] = $User->id;
			$post['author'] = $User->name;
			$post['idea'] = $Idea->id;
			$post['pname'] = $Idea->title;
			$IdeaItem = $this->set_model($post, new IdeaItem());
			$errors = $this->IdeaItem->check($IdeaItem);
			if(count($errors) == 0){
				$post['status'] = 0;
				$post['time'] = DATETIME;
				unset($post['id']);
				$this->IdeaItem->escape($post);
				$this->IdeaItem->save($post);
				$this->redirect('detail?id='.$Idea->id);
			}
			$this->set('Item', $IdeaItem);
			$this->set('errors', $errors);
		}
		if($Idea->status > 0 || is_expire($Idea->deadline)){
			$this->set('closed', true);
		}
		$this->set('$Idea', $Idea);
		$this->show_tags($Idea);
	}
	
	public function item(){
		$data = $this->get_data();
		$idea = $data['idea'];
		$item = $data['item'];
		$User = $this->get('User');
		$has_error = true;
		if($idea && $item){
			$Idea = $this->Idea->get($idea);
			if($Idea){
				$Item = $this->IdeaItem->get($item);
				if($Item){
					if(is_company_object($User, $Idea) ||
						is_expert_object($User, $Item)){
						$has_error = false;
					}
				}
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$Idea', $Idea);
		$this->show_tags($Idea);
		$this->set('$Item', $Item);
	}
	
	public function itemedit(){
		$data = $this->get_data();
		$idea = $data['idea'];
		$item = $data['item'];
		$User = $this->get('User');
		$has_error = true;
		if($idea && $item){
			$Idea = $this->Idea->get($idea);
			if($Idea){
				$Item = $this->IdeaItem->get($item);
				if($Item && is_expert_object($User, $Item)){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post && $Idea->status == 0){
			$post = $this->request->post;
			$post['id'] = $item;
			unset($post['idea'], $post['item']);
			$Item = $this->set_model($post, $Item);
			$errors = $this->IdeaItem->check($Item);
			if(count($errors) == 0){
				$this->IdeaItem->escape($post);
				$this->IdeaItem->save($post);
				$this->redirect('item?idea='.$idea.'&item='.$item);
			}
			$this->set('errors', $errors);
		}
		if($Idea->status > 0 || is_expire($Idea->deadline)){
			$this->set('closed', true);
		}
		$this->set('$Item', $Item);
		$this->set('$Idea', $Idea);
		$this->show_tags($Idea);
	}
	
	public function choose(){
		$data = $this->get_data();
		$idea = intval($data['idea']);
		$item = intval($data['item']);
		$User = $this->get('User');
		$has_error = true;
		if($idea && $item){
			$Idea = $this->Idea->get($idea);
			if($Idea){
				$Item = $this->IdeaItem->get($item);
				if($Item && is_company_object($User, $Idea)){
					$has_error = false;
				}
			}
		}
		if($has_error){
			echo 'error';
			return;
		}
		
		$this->layout('ajax');
		if($this->request->post){
			$post = $this->request->post;
			$prize = intval($post['prize']);
			$error = '';
			if($prize != 1 && $prize != 2 && $prize != 3){
				$error = '奖项有误';	
			}
			else if($Idea->status == 2){
				$error = '已停止评奖';	
			}
			else{
				$cond = array('status'=>$prize, 'idea'=>$idea);
				$count = $this->IdeaItem->count($cond);
				if($prize == 1 && $count >= $Idea->one ||
					($prize == 2 && $count >= $Idea->two)||
					($prize == 3 && $count >= $Idea->three)){
					$error = '奖项已设置完';
				}
			}
			if(empty($error)){
				$data = array('id'=>$item, 'status'=>$prize);
				$this->IdeaItem->save($data);
				$data = array('id'=>$idea, 'status'=>1);
				$this->Idea->save($data);
				echo 0;
			}
			else{
				echo $error;
			}
		}
	}
	
	public function finish(){
		$data = $this->get_data();
		$id = intval($data['idea']);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Idea = $this->Idea->get($id);
			if($Idea && is_company_object($User, $Idea)){
				if($Idea->status < 2){
					$has_error = false;
				}
			}
		}
		if($has_error){
			echo 'error';
			return;
		}
		
		$this->layout('ajax');
		if($this->request->post){
			$data = array('id'=>$id, 'status'=>2);
			$this->Idea->save($data);
			echo 0;
		}
	}
	
}