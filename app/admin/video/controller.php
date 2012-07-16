<?php

class VideoController extends AdminBaseController {
	
	public $models = array('Video', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_VIDEO_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Video->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Video->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_VIDEO_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$post['belong'] = $admin;
			$post['type'] = BelongType::ADMIN;
			$errors = $this->Video->check($post);
			if(count($errors) == 0){
				$post['time'] = DATETIME;
				$image = Video::get_image($post['url']);
				if($image){
					$post['image'] = $image;
				}
				$this->Video->escape($post);
				$this->Video->save($post);
				$this->Log->action_video_add($admin, $post['title']);
				$this->response->redirect('index');
			}
			else{
				$video = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('video', $video);
			}
		}
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$id = get_id($post);
			if($id > 0){
				$video = $this->Video->get($id);
			}
			if($video){
				$video = $this->set_model($post, $video);
				$errors = $this->Video->check($video);
				if(count($errors) == 0){
					$this->Video->escape($post);
					$this->Video->save($post);
					$this->Log->action_video_edit($admin, $post['title']);
					$this->response->redirect('edit?id='.$id);
				}
				else{
					$this->set('errors', $errors);
					$this->set('video', $video);
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
				$video = $this->Video->get($id);
			}
			if($video){
				$this->set('video', $video);
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
				$this->Video->delete($ids);
				$this->Log->action_video_edit($admin, '多个视频');
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$video = $this->Video->get($id);
				$this->Video->delete($id);
				$this->Log->action_video_edit($admin, $video->title);
			}
			$this->response->redirect('index');
		}
	}
	
}