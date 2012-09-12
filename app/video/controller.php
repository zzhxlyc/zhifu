<?php

include(LIB_UTIL_DIR.'/DateCrossUtil.php');

class VideoController extends AppController {
	
	public $models = array('Video');
	
	public function before(){
		$this->set('home', VIDEO_HOME);
		parent::before();
		$need_login = array('add', 'add_succ');	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$ord = $get['order'];
		$limit = 10;
		$cond = array();
		$all = $this->Video->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Video->get_page($cond, array('time'=>'DESC'), 
										$pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
		
		list($from, $to) = DateCrossUtil::this_month();
		$cond = array('time >='=>$from);
		$hot_list = $this->Video->get_list($cond, array('click'=>'DESC'), $limit);
		$this->set('hot_list', $hot_list);
	}
	
	public function url(){
		$get = $this->request->get;
		$id = get_id($get);
		$has_error = true;
		if($id){
			$video = $this->Video->get($id);
			if($video){
				$has_error = false;
			}
		}
		if($has_error){
			$this->response->redirect_404();
			return;
		}
		
		$video->click_up();
		$this->response->redirect($video->url);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$User = $this->get('User');
			$post['belong'] = $User->id;
			$post['type'] = $User->get_type();
			$post['author'] = $User->name;
			$errors = $this->Video->check($post);
			if(count($errors) == 0){
				$post['time'] = DATETIME;
				$post['click'] = 0;
				$image = Video::get_image($post['url']);
				if($image){
					$post['image'] = $image;
				}
				$this->Video->escape($post);
				$this->Video->save($post);
				$this->redirect('add_succ');
			}
			else{
				$video = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('video', $video);
			}
		}
	}
	
	public function add_succ(){}
	
}