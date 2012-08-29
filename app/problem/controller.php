<?php

class ProblemController extends AppController {
	
	public $models = array('Problem', 'Tag', 'TagItem', 'Solution', 
								'Category', 'Comment');
	
	public function before(){
		$this->set('home', PROBLEM_HOME);
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
		$all = $this->Problem->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Problem->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links(PROBLEM_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function detail(){
		$get = $this->request->get;
		$id = get_id($get);
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$Problem', $Problem);
		
		$Company = $this->Company->get($Problem->company);
		$this->set('$Company', $Company);
		
		$tag_list = $this->add_tag_data($id, BelongType::PROBLEM, false);
		$tag_list = $this->TagItem->get_most($tag_list);
		$this->set('$tags', $tag_list);
		
		$cond = array('problem'=>$id);
		$solutions = $this->Solution->get_list($cond);
		if(count($solutions) > 0){
			$expert_ids = get_attrs($solutions, 'expert');
			$cond = array('id in'=>$expert_ids);
			$experts = $this->Expert->get_list($cond);
		}
		else{
			$experts = array();
		}
		$this->set('$experts', get_map_by_id($experts));
		$this->set('$solutions', $solutions);
		
		$page = get_page($get);
		$this->add_comments($Problem, $page);
		
		if(is_expire($Problem->deadline)){
			$data = array('id'=>$Problem->id);
			if($Problem->status == 0){
				$data['status'] = 4;
			}
			else if($Problem->status == 1){
				if(count($solutions) == 0){
					$data['status'] = 4;
				}
				else{
					
				}
			}
			if(isset($data['status'])){
				$this->Problem->save($data);
			}
		}
	}
	
	private function add_data($Problem = null){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
		if($Problem){
			$this->add_tag_data($Problem->id, BelongType::PROBLEM);
		}
		$this->add_common_tags();
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			if($post['type'] == '1'){
				$data = array('title'=>$post['t'], 'description'=>$post['desc']);
				$post = $data;
				$this->set('type', 1);
			}
			if(isset($post['deadline']) && empty($post['deadline'])){
				unset($post['deadline']);
			}
			if(isset($post['type'])){
				unset($post['type'], $post['t'], $post['desc']);
			}
			$User = $this->get('User');
			$post['company'] = $User->id;
			$post['author'] = $User->name;
			$Problem = $this->set_model($post, $Problem);
			$errors = $this->Problem->check($Problem);
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
				$this->Problem->escape($post);
				$id = $this->Problem->save($post);
				$this->do_tag($id, BelongType::PROBLEM, $old_tag, $new_tag);
				$this->redirect('detail?id='.$id);
			}
			$problem = $this->set_model($post, new Problem());
			$this->set('$problem', $problem);
			$this->set('errors', $errors);
		}
		else{
			$this->set('type', 0);
		}
		$this->add_data();
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if(is_company_object($User, $Problem)){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$Problem = $this->set_model($post, $Problem);
			$errors = $this->Problem->check($Problem);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$this->do_tags($Problem, $post['old_tag'], $post['new_tag']);
				unset($post['old_tag'], $post['new_tag']);
				if($post['image'] && $Problem->image){
					FileSystem::remove($Problem->image);
				}
				if($post['file'] && $Problem->file){
					FileSystem::remove($Problem->file);
				}
				$post['lastmodify'] = DATETIME;
				$this->Problem->escape($post);
				$this->Problem->save($post);
				$this->redirect('edit?succ&id='.$id);
			}
			$this->set('errors', $errors);
		}
		$this->add_data($Problem);
		$this->set('problem', $Problem);
	}
	
	public function submit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem && $User->is_expert()){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$post['expert'] = $User->id;
			$post['author'] = $User->name;
			$post['problem'] = $Problem->id;
			$post['pname'] = $Problem->title;
			$Solution = $this->set_model($post, new Solution());
			$errors = $this->Solution->check($Solution);
			if(count($errors) == 0){
				$post['status'] = 0;
				$post['time'] = DATETIME;
				unset($post['id']);
				$this->Solution->escape($post);
				$item = $this->Solution->save($post);
				$this->redirect("item?problem=$Problem->id&item=$item");
			}
			$this->set('$solution', $Solution);
			$this->set('errors', $errors);
		}
		$this->set('$Problem', $Problem);
		$this->show_tags($Problem);
		$this->show_categorys($Problem);
		
		if($Problem->status > 1 || is_expire($Problem->deadline)){
			$this->set('closed', true);
		}
		$cond = array('problem'=>$id);
		$solutions = $this->Solution->get_list($cond);
		$this->set('$solutions', $solutions);
	}
	
	public function item(){
		$data = $this->get_data();
		$problem = $data['problem'];
		$item = $data['item'];
		$User = $this->get('User');
		$has_error = true;
		if($problem && $item){
			$Problem = $this->Problem->get($problem);
			if($Problem){
				$Item = $this->Solution->get($item);
				if($Item){
					if(is_company_object($User, $Problem) ||
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
		
		$this->set('$Problem', $Problem);
		$this->show_tags($Problem);
		$this->set('$Item', $Item);
		
		$cond = array('problem'=>$Problem->id, 'status'=>1);
		$count = $this->Solution->count($cond);
		$this->set('choosed', $count > 0);
	}
	
	public function itemedit(){
		$data = $this->get_data();
		$problem = $data['problem'];
		$item = $data['item'];
		$User = $this->get('User');
		$has_error = true;
		if($problem && $item){
			$Problem = $this->Problem->get($problem);
			if($Problem){
				$Item = $this->Solution->get($item);
				if($Item && is_expert_object($User, $Item)){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post && $Problem->status <= 1){
			$post = $this->request->post;
			$post['id'] = $item;
			unset($post['problem'], $post['item']);
			$Item = $this->set_model($post, $Item);
			$errors = $this->Solution->check($Item);
			if(count($errors) == 0){
				$this->Solution->escape($post);
				$this->Solution->save($post);
				$this->redirect('item?problem='.$problem.'&item='.$item);
			}
			$this->set('errors', $errors);
		}
		if($Problem->status > 1 || is_expire($Problem->deadline)){
			$this->set('closed', true);
		}
		$this->set('$Item', $Item);
		$this->set('$Problem', $Problem);
		$this->show_tags($Problem);
	}
	
	public function choose(){
		$data = $this->get_data();
		$problem = $data['problem'];
		$item = $data['item'];
		$User = $this->get('User');
		$has_error = true;
		if($problem && $item){
			$Problem = $this->Problem->get($problem);
			if($Problem){
				$Item = $this->Solution->get($item);
				if($Item && is_company_object($User, $Problem)){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post && $Problem->status <= 2){
			$type = $data['type'];
			if($type == 0){
				$cond = array('problem'=>$Problem->id, 'status'=>1);
				$count = $this->Solution->count($cond);
				if($count == 0){
					$data = array('id'=>$item, 'status'=>1);
					$this->Solution->save($data);
					$this->redirect('detail?id='.$problem);
				}
			}
			else if($type == 1){
				$data = array('id'=>$item, 'status'=>0);
				$this->Solution->save($data);
				$this->redirect('detail?id='.$problem);
			}
		}
		$this->redirect('item?problem='.$problem.'&item='.$item);
	}
	
	public function start(){
		$data = $this->get_data();
		$id = intval($data['problem']);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem && is_company_object($User, $Problem)){
				if($Problem->status == 0){
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
			$data = array('id'=>$id, 'status'=>1);
			$this->Problem->save($data);
			echo 0;
		}
	}
	
	public function finish(){
		$data = $this->get_data();
		$id = intval($data['problem']);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem && is_company_object($User, $Problem)){
				if($Problem->status == 1){
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
			$cond = array('problem'=>$Problem->id, 'status'=>1);
			$count = $this->Solution->count($cond);
			if($count == 1){
				$data = array('id'=>$id, 'status'=>2);
				$this->Problem->save($data);
				echo 0;
			}
			else{
				echo '还没有选择竞标';
			}
		}
	}
	
	public function score(){
		$data = $this->get_data();
		$id = intval($data['id']);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem){
				$cond = array('problem'=>$id, 'status'=>1);
				$Item = $this->Solution->get_row($cond);
				if($Item){
					if(is_company_object($User, $Problem) ||
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
		
		if($this->request->post){
			$post = $this->request->post;
			$score = intval($post['score']);
		}
		$this->set('$Problem', $Problem);
		$this->show_tags($Problem);
		$this->set('$Item', $Item);
		
		if($User->is_company()){
			$Expert = $this->Expert->get($Item->expert);
			$this->set('$Expert', $Expert);
			$this->set('score', $item->c_score);
		}
		else{
			$Company = $this->Company->get($Problem->company);
			$this->set('$Company', $Company);
			$this->set('score', $item->e_score);
		}
	}
	
}