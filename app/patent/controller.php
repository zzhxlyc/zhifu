<?php

include(LIB_UTIL_DIR.'/IPLocation.php');

class PatentController extends AppController {
	
	public $models = array('Patent', 'Tag', 'TagItem', 
					'Category', 'Deal', 'DealItem');
	
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
		$User = $this->get('User');
		if($User){
			$cond = array('belong' => $User->id, 'type' => $User->get_type());
			$deals = $this->Deal->get_list($cond);
			$this->set('buyed_patents', get_attrs($deals, 'patent'));
		}
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	private function get_transfer_value(&$post){
		$t = 0;
		if(is_array($post['transfer'])){
			foreach($post['transfer'] as $v){
				$v = intval($v);
				if($v >= 1 && $v <= 4){
					$t = $t | (1 << $v);
				}
			}
		}
		return $t;
	}
	
	public function add(){
		$User = $this->get('User');
		if($this->request->post){
			$post = $this->request->post;
			$post['expert'] = $User->id;
			$post['username'] = $User->username;
			$post['author'] = $User->name;
			$post['transfer'] = $this->get_transfer_value($post);
			$Patent = $this->set_model($post, $Patent);
			$errors = $this->Patent->check($Patent);
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
				$post['time'] = DATETIME;
				$post['lastmodify'] = DATETIME;
				$this->Patent->escape($post);
				$id = $this->Patent->save($post);
				$this->do_tag($id, BelongType::PATENT, $old_tag, $new_tag);
				$this->update_count_info($User, BelongType::PATENT);
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
			$ids = get_ids($deals);
			$cond = array('deal in'=>$ids);
			$comments = $this->DealItem->get_list($cond);
			$comments_map = array();
			foreach($comments as $comment){
				if(!array_key_exists($comment->deal, $comments_map)){
					$comments_map[$comment->deal] = array();
				}
				$comments_map[$comment->deal][] = $comment;
			}
		}
		else{
			$buyers = array();
		}
		if($User->is_company() && !empty($companys) && array_key_exists($User->id, $companys)
			|| ($User->is_expert() && $User->id != $Patent->expert 
					&& !empty($experts) && array_key_exists($User->id, $experts))){
			$this->set('buyed', true);
		}
		$this->set('$buyers', $buyers);
		$this->set('$deals', $deals);
		$this->set('$comments_map', $comments_map);
		
		$this->show_categorys($Patent);
		$page = get_page($get);
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = $data['id'];
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$Patent = $this->Patent->get($id);
			if(is_expert_object($User, $Patent)){
				$has_error = false;
			}
		}
		if($has_error){
			$this->redirect_error('您无权修改');
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$post['transfer'] = $this->get_transfer_value($post);
			$Patent = $this->set_model($post, $Patent);
			$errors = $this->Patent->check($Patent);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image', $errors, $files);
				$this->resize_upload_image($path);
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
	
	public function deal(){
		$this->layout('ajax');
		$User = $this->get('User');
		$ret = array();
		if($User){
			if($this->request->post){
				$post = $this->request->post;
				$User = $this->get('User');
				$this->set_belong($post, $User);
				$errors = $this->Deal->check($post);
				if(count($errors) == 0){
					$post['time'] = DATETIME;
					$post['ip'] = IP;
					$ipinfo = IPLocation::get_district(IP);
					$post['dis1'] = $ipinfo[0];
					$post['dis2'] = $ipinfo[1];
					$id = $this->Deal->save($post);
					$ret['succ'] = 1;
				}
				else{
					$ret['succ'] = 0;
					if($errors['name']){
						$ret['error'] = $errors['name'];
					}
					else if($errors['phone']){
						$ret['error'] = $errors['phone'];
					}
					else if($errors['price']){
						$ret['error'] = $errors['price'];
					}
					else if($errors['note']){
						$ret['error'] = $errors['note'];
					}
				}
			}
		}
		else{
			$ret['succ'] = -1;
			$ret['error'] = '请先登录';
		}
		echo json_encode($ret);
	}
	
	public function dealitem(){
		$this->layout('ajax');
		$User = $this->get('User');
		$ret = array();
		if($User){
			if($this->request->post){
				$post = $this->request->post;
				$User = $this->get('User');
				$this->set_belong($post, $User);
				$errors = $this->DealItem->check($post);
				if(count($errors) == 0){
					$post['time'] = DATETIME;
					$post['ip'] = IP;
					$ipinfo = IPLocation::get_district(IP);
					$post['dis1'] = $ipinfo[0];
					$post['dis2'] = $ipinfo[1];
					$id = $this->DealItem->save($post);
					$ret['succ'] = 1;
					$ret['uid'] = $User->id;
					$ret['type'] = strtolower($User->get_type());
					$ret['username'] = $User->username;
					$ret['dis1'] = $post['dis1'];
					$ret['dis2'] = $post['dis2'];
					$ret['time'] = DATETIME;
				}
				else{
					$ret['succ'] = 0;
					if($errors['phone']){
						$ret['error'] = $errors['phone'];
					}
					else if($errors['comment']){
						$ret['error'] = $errors['comment'];
					}
				}
			}
		}
		else{
			$ret['succ'] = -1;
			$ret['error'] = '请先登录';
		}
		echo json_encode($ret);
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
		
		$cond = array('patent'=>$id, 'belong'=>$User->id, 'type'=>$User->get_type());
		$count = $this->Deal->count($cond);
		if($this->request->post){
			$post = $this->request->post;
			if($count > 0){
				$this->redirect('detail?id='.$id);
			}
			else{
				if($User->get_type() == BelongType::EXPERT){
					if($Patent->expert == $User->id){
						$this->redirect('detail?id='.$id);
					}
				}
				$errors = $this->Deal->check($post);
				if(count($errors) == 0){
					$data = array();
					$data['name'] = $post['name'];
					$data['phone'] = $post['phone'];
					$data['price'] = $post['price'];
					$data['note'] = $post['note'];
					$data['patent'] = $id;
					$data['pname'] = $Patent->title;
					$this->set_belong($data, $User);
					$data['time'] = DATETIME;
					$this->Deal->save($data);
					$this->redirect('detail?id='.$id);
				}
				$this->set('errors', $errors);
				$this->set('deal', $this->set_model($post, new Deal()));
			}
		}
		$this->set('buyed', $count == 1);
		$this->set('$Patent', $Patent);
		$this->show_tags($Patent);
	}
	
	
}