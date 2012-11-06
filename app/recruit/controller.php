<?php

class RecruitController extends AppController {
	
	public $models = array('Recruit', 'RecruitItem', 'Tag', 'TagItem');
	
	public function before(){
		$this->set('home', RECRUIT_HOME);
		parent::before();
		$need_login = array('show', 'add', 'edit', 'apply', 'itemedit', 'result', 'resume');	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$type = $get['type'];
		$fromday = $get['fromday'];
		$cond = array();
		if($type == 'zhaopin'){
			$cond['type'] = BelongType::COMPANY;
		}
		else if($type == 'qiuzhi'){
			$cond['type'] = BelongType::EXPERT;
		}
		if($fromday == '3days'){
			$from_ts = TIMESTAMP - 3600 * 24 * 3;
			$cond['time >='] = date('Y-m-d H:i:s', $from_ts);
		}
		else if($fromday == 'week'){
			$from_ts = TIMESTAMP - 3600 * 24 * 7;
			$cond['time >='] = date('Y-m-d H:i:s', $from_ts);
		}
		$limit = 10;
		$order = array('time'=>'DESC');
		$all = $this->Recruit->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Recruit->get_page($cond, $order, $pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function show(){
		$get = $this->request->get;
		$id = get_id($get);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$recruit = $this->Recruit->get($id);
			if($recruit){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$this->set('$recruit', $recruit);
		if(!is_company_object($User, $recruit)){
			$cond = array('recruit'=>$recruit->id, 
						'belong'=>$User->id, 'type'=>$User->get_type());
			$item = $this->RecruitItem->get_row($cond);
			$this->set('$item', $item);
		}
	}
	
	public function add(){
		$User = $this->get('User');
		if($this->request->post){
			$post = $this->request->post;
			$post['belong'] = $User->id;
			$post['type'] = $User->get_type();
			$post['username'] = $User->username;
			$post['author'] = $User->name;
			$recruit = $this->set_model($post);
			$errors = $this->Recruit->check($post);
			if(count($errors) == 0){
				$post['status'] = 1;
				$post['time'] = DATETIME;
				$this->Recruit->escape($post);
				$id = $this->Recruit->save($post);
				$this->redirect('show?id='.$id);
			}
			$this->set('$errors', $errors);
		}
		else{
			$recruit = new Recruit();
			$recruit->company = $User->name;
			$recruit->companydesc = $User->description;
		}
		$this->set('$recruit', $recruit);
	}
	
	public function edit(){
		$data = $this->get_data();
		$id = get_id($data);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$recruit = $this->Recruit->get($id);
			if($recruit){
				if($User->id == $recruit->belong 
						&& $User->get_type() == $recruit->type){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$recruit = $this->set_model($post, $recruit);
			$errors = $this->Recruit->check($recruit);
			if(count($errors) == 0){
//				$old_tag = $post['old_tag'];
//				$new_tag = $post['new_tag'];
//				unset($post['old_tag'], $post['new_tag']);
				$this->Recruit->escape($post);
				$this->Recruit->save($post);
//				$this->do_tag($id, BelongType::RECRUIT, $old_tag, $new_tag);
				$this->redirect('edit?succ&id='.$id);
			}
			$this->set('errors', $errors);
		}
//		$recruit->do_available();
//		$this->add_tag_data($recruit->id, BelongType::RECRUIT);
		$this->set('$recruit', $recruit);
	}
	
	public function item(){
		$data = $this->get_data();
		$id = get_id($data);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$item = $this->RecruitItem->get($id);
			if($item){
				if($item->belong == $User->id 
						&& $item->type == $User->get_type()){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		$recruit = $this->Recruit->get($item->recruit);
		$U = $this->get_user($recruit->belong, $recruit->type);
		$this->set('$publisher', $U);
		$this->set('$item', $item);
		$this->set('$recruit', $recruit);
	}
	
	public function apply(){
		$data = $this->get_data();
		$id = get_id($data);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$recruit = $this->Recruit->get($id);
			if($recruit){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			unset($post['id']);
			$files = $this->request->file;
			$path = $this->do_file('resume', $errors, $files);
			if($path){$post['resume'] = $path;}
			$errors = $this->RecruitItem->check($post);
			if(count($errors) == 0){
				$this->set_belong($post, $User);
				$post['recruit'] = $recruit->id;
				$post['time'] = DATETIME;
				$id = $this->RecruitItem->save($post);
				
				$this->update_user_info($User, $post);
				
				$this->redirect('item?succ&id='.$id);
			}
			$item = $this->set_model($post, new RecruitItem());
			$this->set('$item', $item);
			$this->set('errors', $errors);
		}
		else{
			$item = new RecruitItem();
			$this->set_user_info($User, $item);
			$this->set('$item', $item);
		}
		$U = $this->get_user($recruit->belong, $recruit->type);
		$this->set('$publisher', $U);
		$this->set('$recruit', $recruit);
	}
	
	public function itemedit(){
		$data = $this->get_data();
		$id = get_id($data);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$item = $this->RecruitItem->get($id);
			if($item){
				if($item->belong == $User->id 
						&& $item->type == $User->get_type()){
					$has_error = false;
				}
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		if($this->request->post){
			$post = $this->request->post;
			$item = $this->set_model($post, $item);
			$errors = $this->RecruitItem->check($item);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('resume', $errors, $files);
				if($path){$post['resume'] = $path;}
			}
			if(count($errors) == 0){
				if($post['resume'] && $item->resume){
					FileSystem::remove($item->resume);
				}
				$this->RecruitItem->save($post);
				$this->redirect('itemedit?succ&id='.$id);
			}
		}
		$recruit = $this->Recruit->get($item->recruit);
		$U = $this->get_user($recruit->belong, $recruit->type);
		$this->set('$publisher', $U);
		$this->set('$item', $item);
		$this->set('$recruit', $recruit);
	}
	
	public function result(){
		$data = $this->get_data();
		$id = get_id($data);
		$User = $this->get('User');
		$has_error = true;
		if($id){
			$recruit = $this->Recruit->get($id);
			if($recruit && is_company_object($User, $recruit)){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$cond = array('recruit'=>$id);
		$order = array('time'=>'DESC');
		$all = $this->RecruitItem->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->RecruitItem->get_page($cond, $order, $pager->now(), $limit);
		$this->set('$recruit', $recruit);
		$this->set('$list', $list);
		$links = $pager->get_page_links($this->get('home')."/result?id=$id&");
		$this->set('links', $links);
	}
	
	public function resume(){
		$get = $this->request->get;
		$item_id = $get['item'];
		$User = $this->get('User');
		$has_error = true;
		if($item_id){
			$item = $this->RecruitItem->get($item_id);
			if($item){
				if(is_his_object($User, $item)){
					$has_error = false;
				}
				else{
					$recruit = $this->Recruit->get($item->recruit);
					if($recruit && is_company_object($User, $recruit)){
						$has_error = false;
					}
				}
			}
		}
		if($has_error){
			$message = '无权下载';
			$this->redirect_error($message);
			return;
		}
		
		$path = UPLOAD_HOME.'/'.$item->resume;
		header("Location: $path");
		exit;
	}
	
}