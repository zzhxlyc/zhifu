<?php

class ProblemController extends AppController {
	
	public $models = array('Problem', 'Tag', 'TagItem', 'Solution', 'SolutionItem',
								'Category', 'Comment');
	
	public function before(){
		$this->set('home', PROBLEM_HOME);
		parent::before();
		$need_login = array('detail', 'item', 'score');	// either
		$need_company = array('add', 'edit', 'choose', 'finish', 'done');
		$need_expert = array('submit', 'itemedit');
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$ord = $get['order'];
		$limit = 10;
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
		$condition = array('verify'=>1);
		if($get['title']){
			$condition['title like'] = esc_text($get['title']);
		}
		$all = $this->Problem->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Problem->get_page($condition, $order, $pager->now(), $limit);
		$base = PROBLEM_HOME.'/index?';
		if($condition['title like']){
			$base .= 'title='.$condition['title like'].'&';
		}
		$links = $pager->get_page_links($base);
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function detail(){
		$get = $this->request->get;
		$id = get_id($get);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem && $Problem->verify == 1){
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
			$id_array = get_ids($solutions);
			$cond = array('company'=>$User->id, 'solution in'=>$id_array);
			$so_items = $this->SolutionItem->get_list($cond);
			$so_items = array_to_map($so_items, 'solution');
		}
		if(count($solutions) > 0){
			$expert_ids = get_attrs($solutions, 'expert');
			$cond = array('id in'=>$expert_ids);
			$experts = $this->Expert->get_list($cond);
			
			foreach($solutions as $solution){
				if($Problem->status > 1){
					if($solution->status == 1){
						$this->set('Solver', $solution);
					}
				}
				if(array_key_exists($solution->id, $so_items)){
					$solution->opend = true;
				}
				else{
					$solution->opend = false;
				}
			}
		}
		else{
			$experts = array();
		}
		$this->show_categorys($Problem);
		$this->set('$experts', get_map_by_id($experts));
		$this->set('$solutions', $solutions);
		
		$page = get_page($get);
		$this->add_comments($Problem, $page);
		
		if($Problem->deadline && is_expire($Problem->deadline)){
			$data = array('id'=>$Problem->id, 'closed'=>1);
			$this->Problem->save($data);
		}
		
		$cond = array('problem'=>$id, 'expert'=>$User->id);
		$solution = $this->Solution->get_row($cond);
		$this->set('$solution', $solution);
		
		$User = $this->get('User');
		if(is_expert($User)){
			foreach($solutions as $solution){
				if($solution->status == 1 && $solution->expert == $User->id){
					$this->set('solver', true);
					break;
				}
			}
		}
	}
	
	private function set_category($Problem){
		$cat_array = $this->get('cat_array');
		if(!$cat_array){
			$cat_array = $this->Category->get_category();
		}
		$Problem->cat_name = $cat_array[$Problem->cat]['name'];
		$Problem->subcat_name = $cat_array[$Problem->cat]['c'][$Problem->subcat]['name'];
	}
	
	private function add_data($Problem = null){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
		if($Problem){
			$this->add_tags($Problem);
			$this->set_category($Problem);
		}
		$this->add_common_tags();
	}
	
	public function add(){
		$User = $this->get('User');
		if($this->request->post){
			$post = $this->request->post;
			$post['verify'] = 1;
			$post['status'] = 1;
			if($post['type'] == '1'){
				$post['description'] = $post['desc'];
				$post['verify'] = 0;
				$post['status'] = 0;
				$this->set('type', 1);
			}
			if(isset($post['deadline']) && empty($post['deadline'])){
				unset($post['deadline']);
			}
			if(isset($post['type'])){
				unset($post['type'], $post['desc']);
			}
			$post['company'] = $User->id;
			$post['author'] = $User->name;
			$post['username'] = $User->username;
			$Problem = $this->set_model($post, $Problem);
			$errors = $this->Problem->check($Problem);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				$this->resize_upload_image($path);
				if($path){$post['image'] = $path;}
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$old_tag = $post['old_tag'];
				$new_tag = $post['new_tag'];
				unset($post['old_tag'], $post['new_tag']);
				$post['closed'] = 0;
				$post['time'] = DATETIME;
				$post['lastmodify'] = DATETIME;
				$this->Problem->escape($post);
				$id = $this->Problem->save($post);
				$this->do_tag($id, BelongType::PROBLEM, $old_tag, $new_tag);
				$this->update_count_info($User, BelongType::PROBLEM);
				if($post['verify'] == 1){
					$this->redirect('detail?id='.$id);
				}
				else{
					$this->redirect('simple');
				}
			}
			$problem = $this->set_model($post, new Problem());
			$this->set('errors', $errors);
		}
		else{
			$this->set('type', 0);
			$problem = new Problem();
			$problem->name = $User->name;
			$problem->phone = $User->phone;
			if($problem->phone == '') $problem->phone = $User->mobile;
		}
		$this->set('$problem', $problem);
		$this->add_data();
	}
	
	public function simple(){}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem && is_company_object($User, $Problem)){
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
				$this->resize_upload_image($path);
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
			if($Problem && $Problem->verify == 1 && $User->is_expert()){
				$cond = array('problem'=>$id, 'expert'=>$User->id);
				$solution = $this->Solution->get_row($cond);
				if($solution){
					$this->redirect("itemedit?problem=$id&item=$solution->id");
				}
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
			$post['username'] = $User->username;
			$post['author'] = $User->name;
			$post['problem'] = $Problem->id;
			$post['pname'] = $Problem->title;
			$Solution = $this->set_model($post, new Solution());
			$errors = $this->Solution->check($Solution);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				$post['status'] = 0;
				$post['time'] = DATETIME;
				unset($post['id']);
				$this->Solution->escape($post);
				$item = $this->Solution->save($post);
				$this->update_count_info($User, BelongType::PROBLEM);
				$this->redirect("item?problem=$Problem->id&item=$item");
			}
			$this->set('$solution', $Solution);
			$this->set('errors', $errors);
		}
		$this->set('$Problem', $Problem);
		$this->set_category($Problem);
		$this->show_tags($Problem);
		$this->show_categorys($Problem);
		
		if($Problem->status > 1 || ($Problem->deadline && is_expire($Problem->deadline))){
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
			if($Problem && $Problem->verify == 1){
				$Item = $this->Solution->get($item);
				if($Item){
					if(is_company_object($User, $Problem) ||
							is_expert_object($User, $Item, false)){
						$has_error = false;
					}
				}
			}
		}
		if($has_error){
			$this->redirect_error(UserError::NOT_ALLOWED);
			return;
		}
		$cond = array('company'=>$User->id, 'solution'=>$Item->id);
		if($User->is_company()){
			$count = $this->SolutionItem->count($cond);
			if($count == 0){
				$need = Credit::solutionCredit();
				if($User->credit < $need){
					$this->redirect_credit();
					return;
				}
				else{
					$cond['time'] = DATETIME;
					$this->SolutionItem->save($cond);
					$d = array('id'=>$User->id, 'credit eq'=>"credit - $need");
					$this->Company->save($d);
				}
			}
		}
		
		$this->set('$Problem', $Problem);
		$this->set_category($Problem);
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
			if($Problem && $Problem->verify == 1){
				$Item = $this->Solution->get($item);
				if($Item && is_expert_object($User, $Item)){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->redirect_error(UserError::NOT_ALLOWED);
			return;
		}
		
		if($this->request->post && $Problem->status <= 1){
			$post = $this->request->post;
			$post['id'] = $item;
			unset($post['problem'], $post['item']);
			$Item = $this->set_model($post, $Item);
			$errors = $this->Solution->check($Item);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('file', $errors, $files);
				if($path){$post['file'] = $path;}
			}
			if(count($errors) == 0){
				if($post['file'] && $Item->file){
					FileSystem::remove($Item->file);
				}
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
		$this->set_category($Problem);
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
			if($Problem && $Problem->verify == 1){
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
	
	//完成 选定合作专家 状态, 进入 交付互评 阶段
	public function done(){
		$data = $this->get_data();
		$id = intval($data['problem']);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem && $Problem->verify == 1 && is_company_object($User, $Problem)){
				if($Problem->status == 2){
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
				$data = array('id'=>$id, 'status'=>3);
				$this->Problem->save($data);
				echo 0;
			}
			else{
				echo '还没有选择中标方案';
			}
		}
	}
	
	//停止提交, 进入 选定合作专家 状态
	public function finish(){
		$data = $this->get_data();
		$id = intval($data['problem']);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Problem = $this->Problem->get($id);
			if($Problem && $Problem->verify == 1 && is_company_object($User, $Problem)){
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
			$cond = array('problem'=>$Problem->id);
			$count = $this->Solution->count($cond);
			if($count > 0){
				$data = array('id'=>$id, 'status'=>2);
				$this->Problem->save($data);
				echo 0;
			}
			else{
				echo '还没有方案提交';
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
			if($Problem && $Problem->verify == 1){
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
			$comment = $post['comment'];
			if(strlen($comment) <= 250){
				if($User->is_company() && intval($Item->c_score) == 0){
						$d = array('id'=>$Item->id, 'c_score'=>$score, 'c_comment'=>$comment);
						$this->Solution->save($d);
						$d = array('id'=>$Item->expert, 
									'rate_total eq'=>"`rate_total` + $score", 
									'rate_num eq'=>'`rate_num` + 1');
						$this->Expert->save($d);
						$this->redirect('score?id='.$Problem->id);
				}
				else if($User->is_expert() && intval($Item->e_score) == 0){
					$d = array('id'=>$Item->id, 'e_score'=>$score, 'e_comment'=>$comment);
					$this->Solution->save($d);
					$d = array('id'=>$Problem->company, 
								'rate_total eq'=>"`rate_total` + $score", 
								'rate_num eq'=>'`rate_num` + 1');
					$this->Company->save($d);
					$this->redirect('score?id='.$Problem->id);
				}
			}
		}
		$this->set('$Problem', $Problem);
		$this->show_tags($Problem);
		$this->show_categorys($Problem);
		$this->set('$Item', $Item);
		
		if($User->is_company()){
			$Expert = $this->Expert->get($Item->expert);
			$this->set('$Expert', $Expert);
			$this->set('score', $Item->c_score);
			$this->set('comment', $Item->c_comment);
		}
		else{
			$Company = $this->Company->get($Problem->company);
			$this->set('$Company', $Company);
			$this->set('score', $Item->e_score);
			$this->set('comment', $Item->e_comment);
		}
	}
	
}