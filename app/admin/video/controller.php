<?php

class VideoController extends AdminBaseController {
	
	public $models = array('Video', 'Log', 'Tag', 'TagItem');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_VIDEO_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$cond = array();
		$all = $this->Video->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Video->get_page($cond, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_VIDEO_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
	public function add(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			$post['belong'] = $admin;
			$post['type'] = BelongType::ADMIN;
			$post['username'] = 'admin';
			$post['author'] = '管理员';
			$errors = $this->Video->check($post);
			if(count($errors) == 0){
				$files = $this->request->file;
				$path = $this->do_file('image2', $errors, $files);
				$this->resize_upload_image($path);
				if($path){$post['image'] = $path;}
			}
			if(count($errors) == 0){
				$post['time'] = DATETIME;
				$post['click'] = 0;
				if(strpos($post['url'], 'youku.com') !== false){
					$data = VideoUrlParser::parse($post['url']);
					if($data){
						$img = FileSystem::gen_upload_path();
						FileSystem::save_url_file($data['img'], $img);
						$post['image'] = $img;
						$post['url'] = $data['swf'];
					}
				}
				$old_tag = $post['old_tag'];
				$new_tag = $post['new_tag'];
				unset($post['old_tag'], $post['new_tag']);
				$this->Video->escape($post);
				$id = $this->Video->save($post);
				$this->do_tag($id, BelongType::VIDEO, $old_tag, $new_tag);
				$this->Log->action_video_add($admin, $post['title']);
				$this->response->redirect('index');
			}
			else{
				$video = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('video', $video);
			}
		}
		$this->add_common_tags();
	}
	
	public function edit(){
		if($this->request->post){
			$post = $this->request->post;
			$id = get_id($post);
			if($id > 0){
				$video = $this->Video->get($id);
			}
			if($video){
				$old_url = $video->url;
				$video = $this->set_model($post, $video);
				$errors = $this->Video->check($video);
				if(count($errors) == 0){
					$files = $this->request->file;
					$path = $this->do_file('image2', $errors, $files);
					$this->resize_upload_image($path);
					if($path){$post['image'] = $path;}
				}
				if(count($errors) == 0){
					if($post['url'] != $old_url){
						if(strpos($post['url'], 'youku.com') !== false){
							$data = VideoUrlParser::parse($post['url']);
							if($data){
								$img = FileSystem::gen_upload_path();
								FileSystem::save_url_file($data['img'], $img);
								$post['image'] = $img;
								$post['url'] = $data['swf'];
							}
						}
					}
					$old_tag = $post['old_tag'];
					$new_tag = $post['new_tag'];
					unset($post['old_tag'], $post['new_tag']);
					if($post['image'] && $video->image){
						FileSystem::remove($video->image);
					}
					$this->Video->escape($post);
					$this->Video->save($post);
					$this->do_tag($id, BelongType::VIDEO, $old_tag, $new_tag);
					$this->redirect('edit?succ&id='.$id);
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
				$this->add_tags($video);
				$this->add_common_tags();
			}
			else{
				$this->set('error', '不存在');
			}
		}
	}
	
}