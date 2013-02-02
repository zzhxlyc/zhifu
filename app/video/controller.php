<?php

include(LIB_UTIL_DIR.'/DateCrossUtil.php');

class VideoController extends AppController {
	
	public $models = array('Video', 'Comment', 'Tag', 'TagItem', 'VideoCategory');
	
	public function before(){
		$this->set('home', VIDEO_HOME);
		parent::before();
		$need_login = array('add', 'add_succ');	// either
		$need_company = array();
		$need_expert = array();
		$this->login_check($need_login, $need_company, $need_expert);
	}
	
	public function index(){
		$cat_list = $this->VideoCategory->get_list();
		list($root, $children) = get_root_children_cat($cat_list);
		$level1_list = array();
		$cat_video_list = array();
		$get = $this->request->get;
		$cat_id = intval($get['cat']);
		if($cat_id == 0){
			foreach($cat_list as $cat){
				if($cat->parent == 0){
					$level1_list[] = $cat;
					$cat_video_list[$cat->id] = array();
				}
			}
		}
		else{
			$wapper_list = get_wrapped_cat_list($cat_list);
			$the_cat = $wapper_list[$cat_id];
			$level1_list[] = $the_cat;
			$cat_video_list[$cat_id] = array();
		}
		$this->set('level1_list', $level1_list);
		$this->set('cat_list', get_wrapped_cat_list($cat_list));
		$this->set('children', $children);
		$this->set('root', $root);
		
		$from = date('Y-m-d H:i:s', time() - 24 * 3600 * 100);
		if($the_cat){
			if($the_cat->parent == 0){
				$cond['category in'] = get_belong_to_cat($the_cat->id, $children, 1);
			}
			else{
				$cond['category'] = $the_cat->id;
			}
		}
		else{
			$cond = array('time >='=>$from);
		}
		if($the_cat){
			$page = $get['page'];
			$limit = 12;
			$all = $this->Video->count($cond);
			$pager = new Pager($all, $page, $limit);
			$base = VIDEO_HOME.'/index?cat='.$the_cat->id.'&';
			$links = $pager->get_page_links($base);
			$order = array('time'=>'DESC');
			$temp_video_list = $this->Video->get_page($cond, $order, $pager->now(), $limit);
			$cat_video_list[$the_cat->id] = $temp_video_list;
			$this->set('$links', $links);
		}
		else{
			$temp_video_list = $this->Video->get_list($cond, array('time'=>'DESC'));
			foreach($temp_video_list as $video){
				$top_id = get_top_cat($cat_list, $video->category);
				if(array_key_exists($top_id, $cat_video_list)){
					$cat_video_list[$top_id][] = $video;
				}
			}
		}
		$this->set('$cat_video_list', $cat_video_list);
		
		$limit = 6;
		list($from, $to) = DateCrossUtil::this_month();
		$cond = array('time >='=>$from);
		$hot_list = $this->Video->get_list($cond, array('click'=>'DESC'), $limit);
		$this->set('hot_list', $hot_list);
		
		$newly_list = $this->Video->get_list($cond, array('time'=>'DESC'), $limit);
		$this->set('newly_list', $newly_list);
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
			$post['username'] = $User->username;
			$post['author'] = $User->name;
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
				$this->redirect('add_succ');
			}
			else{
				$video = $this->set_model($post);
				$this->set('errors', $errors);
				$this->set('video', $video);
			}
		}
		$this->add_common_tags();
		$video_cats = $this->VideoCategory->get_list();
		$this->set('cat_list', get_wrapped_cat_list($video_cats));
	}
	
	public function add_succ(){}
	
	public function show(){
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
		$video->click = $video->click + 1; 
		$page = get_page($get);
		$this->add_comments($video, $page);
		$this->set('video', $video);
		$this->add_tags($video);
	}
	
}