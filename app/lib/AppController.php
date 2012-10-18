<?php

include(LIB_UTIL_DIR.'/ImageUtil.php');

class AppController extends Controller{
	
	public function load_model(){
		$t = array('Company', 'Expert', 'Admin');
		if(!isset($this->models)){
			$this->models = array();
		}
		$this->models = array_merge($this->models, $t);
		parent::load_model();
	}
	
	public function daemon(){
		$cron = Option::find_array('CRON');
		$updated = false;
		if(!$cron){
			$updated = true;
			$cron = array(TIMESTAMP => array('action'=>'build_common_tag'));
		}
		foreach($cron as $time => $array){
			if($time <= TIMESTAMP){
				$action = $array['action'];
				if($action == 'build_common_tag'){
					$url = ADMIN_HOME.'/word/build';
					async_http_get($url);
				}
				unset($cron[$time]);
				$cron[TIMESTAMP + 24 * 2600] = array('action'=>'build_common_tag');
				$updated = true;
			}
		}
		if($updated){
			Option::persist_array('CRON', $cron);
		}
	}
	
	public function before(){
		$this->load_session();
		$this->daemon();
		$cookies = $this->request->cookie;
		if(isset($cookies[COOKIE_U])){
			$cookie = $cookies[COOKIE_U];
			if(strpos($cookie, ';') !== false){
				$r = explode(';', $cookie);
				if(count($r) == 3){
					list($type, $user, $pswd) = $r;
					if($type && $user && $pswd){
						$cond = array('username'=>$user, 'password'=>$pswd);
						if($type == md5('Company')){
							$Company = $this->Company->get_row($cond);
							if($Company){
								$this->set('User', $Company);
							}
						}
						else if($type == md5('Expert')){
							$Expert = $this->Expert->get_row($cond);
							if($Expert){
								$this->set('User', $Expert);
							}
						}
					}
				}
			}
		}
		$session = $this->session;
		if($session->exist('admin')){
			$admin_id = intval($session->get('admin'));
			if($admin_id){
				$Admin = $this->Admin->get($admin_id);
				if($Admin){
					$this->set('User', $Admin);
				}
			}
		}
		$this->set_global_param();
	}
	
	protected function set_global_param(){
		if($this->is_set('home')){
			$this->set('index_page', $this->get('home').'/index');
		}
		$base = unserialize(Option::find('ADMIN_MANAGE_BASE'));
		if($base['logo']){
			$this->set('LOGO', UPLOAD_HOME.'/'.$base['logo']);
		}
		else{
			$this->set('LOGO', IMAGE_HOME.'/logo.jpg');
		}
		if(!empty($base['title'])){
			$this->view->title = $base['title'];
		}
		if(!empty($base['slogan'])){
			$this->set('SLOGAN', $base['slogan']);
		}
	}
	
	public function login_check($need_login, $need_company, $need_expert){
		$method = $this->request->get_method();
		$User = $this->get('User');
		$redirect = false;
		if(in_array($method, $need_login)){
			$redirect = true;
			if($User){
				$redirect = false;
			}
		}
		if(in_array($method, $need_company)){
			$redirect = true;
			if($User && $User->is_company()){
				$redirect = false;
			}
		}
		if(in_array($method, $need_expert)){
			$redirect = true;
			if($User && $User->is_expert()){
				$redirect = false;
			}
		}
		if($User && $User->is_admin()){
			$redirect = false;
		}
		if($redirect){
			$this->response->redirect(LOGIN_HOME);
		}
	}
	
	public function get_data(){
		if($this->request->post){
			return $this->request->post;
		}
		else{
			return $this->request->get;
		}
	}
	
	protected function check_pswd($pswd){
		$chars = "/^(.){6,16}\$/i";
		if(preg_match($chars, $pswd)){
			return true;
		}
		return false;
	}
	
	protected function redirect_error($message){
		$this->set('error_message', $message);
		$this->response->redirect_message($message);
	}
	
	protected function find_user_by_email($email, $not_eq_id = Null){
		$cond = array('email'=>esc_text($email));
		if($not_eq_id){
			$cond['id !='] = $not_eq_id;
		}
		$Company = $this->Company->get_row($cond);
		if($Company){
			return $Company;
		}
		$Expert = $this->Expert->get_row($cond);
		if($Expert){
			return $Expert;
		}
		return false;
	}
	
	protected function find_user($user, $not_eq_id = Null){
		$cond = array('username'=>esc_text($user));
		if($not_eq_id){
			$cond['id !='] = $not_eq_id;
		}
		$Company = $this->Company->get_row($cond);
		if($Company){
			return $Company;
		}
		$Expert = $this->Expert->get_row($cond);
		if($Expert){
			return $Expert;
		}
		return false;
	}
	
	protected function find_user_by_name($name, $not_eq_id = Null){
		$cond = array('name'=>esc_text($name));
		if($not_eq_id){
			$cond['id !='] = $not_eq_id;
		}
		$Company = $this->Company->get_row($cond);
		if($Company){
			return $Company;
		}
		$Expert = $this->Expert->get_row($cond);
		if($Expert){
			return $Expert;
		}
		return false;
	}
	
	protected function get_user($id, $type){
		$cond = array('id'=>intval($id));
		if($type == BelongType::COMPANY){
			return $this->Company->get_row($cond);
		}
		else if($type == BelongType::EXPERT){
			return $this->Expert->get_row($cond);
		}
	}
	
	protected function add_categorys(){
		$cat_array = $this->Category->get_category();
		$this->set('cat_array', $cat_array);
	}
	
	protected function show_categorys($o){
		$model = ucfirst(get_class($o));
		$cat = intval($o->cat);
		$subcat = intval($o->subcat);
		if($cat > 0){
			$C1 = $this->Category->get($cat);
			if($C1){
				$o->cat_name = $C1->name;
			}
		}
		if($subcat > 0){
			$C2 = $this->Category->get($subcat);
			if($C2){
				$o->subcat_name = $C2->name;
			}
		}
	}
	
	protected function show_tags($o){
		$type = BelongType::get_type($o);
		$tag_list = $this->add_tag_data($o->id, $type, false);
		$tags = $this->TagItem->get_most($tag_list);
		$this->set('$tags', $tags);
	}
	
	protected function add_tags($o, $set = true){
		$type = BelongType::get_type($o);
		return $this->add_tag_data($o->id, $type, $set);
	}
	
	protected function add_tag_data($id, $type, $set = true){
		$tags = $this->TagItem->get_list(array('belong'=>$id, 'type'=>$type));
		$tag_id_array = get_attrs($tags, 'tag');
		if($tag_id_array){
			$tag_list = $this->Tag->get_list(array('id in'=>$tag_id_array));
			if($set){
				$this->set('tag_list', $tag_list);
			}
			else{
				return $tag_list;
			}
		}
		else{
			return array();
		}
	}
	
	protected function add_common_tags(){
		$most_common_tags = unserialize(Option::find('MOST_COMMON_TAGS'));
		if($most_common_tags){
			$this->set('$most_common_tags', $most_common_tags);
		}
	}
	
	protected function add_comments($o, $page = 1, $set = true){
		$type = BelongType::get_type($o);
		$cond = array('object'=>$o->id, 'type'=>$type);
		$order = array('time'=>'DESC');
		$limit = 10;
		$all = $this->Comment->count($cond);
		$pager = new Pager($all, $page, $limit);
		$comments = $this->Comment->get_page($cond, $order, $pager->now(), $limit);
		$array = array(
			BelongType::COMPANY => COMPANY_HOME."/profile?id=$id&",
			BelongType::EXPERT => EXPERT_HOME."/profile?id=$id&",
			BelongType::PROBLEM => PROBLEM_HOME."/detail?id=$id&",
			BelongType::PATENT => PATENT_HOME."/detail?id=$id&",
			BelongType::IDEA => IDEA_HOME."/detail?id=$id&",
			BelongType::VIDEO => VIDEO_HOME."/show?id=$id&",
		);
		$links = $pager->get_page_links($array[$type]);
		if($set){
			$this->set('comments', $comments);
			$this->set('links', $links);
		}
		else{
			return $comments;
		}
	}
	
	protected function do_file($name, &$errors, &$files, $model = ''){
		if($model == ''){
			$model = ucfirst($this->request->get_module());
		}
		$file = $files[$name];
		$max_size = 20 * 1024 * 1024;
		if($file && is_uploaded_file($file['tmp_name']) && $file['size'] < $max_size){
			if(isset($this->{$model})){
				$error = $this->{$model}->check_file($file);
			}
			if(empty($error)){
				$path = $this->upload_file($file);
				return $path;
			}
			else{
				$errors[$name] = $error;
			}
		}
		return '';
	}
	
	protected function upload_file($array){
		$path = FileSystem::gen_upload_path($array['name']);
		$save_path = FileSystem::get_save_path($path);
		move_uploaded_file($array['tmp_name'], $save_path);
		return $path;
	}
	
	protected function do_tags($o, $old_tag, $new_tag){
		$type = BelongType::get_type($o);
		return $this->do_tag($o->id, $type, $old_tag, $new_tag);
	}
	
	protected function do_tag($object_id, $type, $old_tag, $new_tag){
		$tag_array = array();	// the now exist tag ids
		if(strlen($old_tag) > 0){
			$tag_array = split_ids($old_tag);
		}
		$tag_items = $this->TagItem->get_list(array('belong'=>$object_id, 'type'=>$type));
		$tag_old_array = get_attrs($tag_items, 'tag');	// the old exist tag ids
		$remove_tag_array = array_diff($tag_old_array, $tag_array);
		if(count($remove_tag_array) > 0){
			$tag_item_ids = array();
			foreach($tag_items as $old_tag){
				if(in_array($old_tag->tag, $remove_tag_array)){
					$tag_item_ids[] = $old_tag->id;
				}
			}
			$this->TagItem->delete($tag_item_ids);
		}
		$this->Tag->minus($remove_tag_array);
		
		$new_tag_array = array();
		$new_tag = trim($new_tag);
		if(strlen($new_tag) > 0){
			$new_tag_array = split_words($new_tag);
		}
		if($new_tag_array){
			if(is_array($new_tag_array) && count($new_tag_array) > 0){
				$tags = $this->Tag->get_list(array('name str_in'=>$new_tag_array));
				//数据库中已经存在的新加的这些tag, 是$new_tag_array的子集
			}
			else{
				$tags = array();
			}
			$named_tags = array_to_map($tags, 'name');
			$plus_tag_array = array();
			foreach($new_tag_array as $tag_name){
				$tag_id = 0;
				if(!array_key_exists($tag_name, $named_tags)){	//新的tag
					$tag_data = array('name'=>$tag_name, 'count'=>1);
					$errors = $this->Tag->check($tag_data); 
					if(count($errors) == 0){
						$tag_id = $this->Tag->save($tag_data);
					}
				}
				else{	//旧的tag
					$tag_id = $named_tags[$tag_name]->id;
					$plus_tag_array[] = $tag_id;
				}
				if($tag_id > 0 && !in_array($tag_id, $tag_array)){	// 处理tag_item
					$data = array('tag'=>$tag_id, 'belong'=>$object_id, 'type'=>$type);
					$count = $this->TagItem->count($data);
					if($count == 0){
						$this->TagItem->save($data);
					}
				}
			}
			$this->Tag->plus($plus_tag_array);
		}
	}
	
	protected function set_belong(&$post, &$User){
		$post['belong'] = $User->id;
		$post['username'] = $User->username;
		$post['type'] = $User->get_type();
		$post['author'] = $User->name;
	}
	
	protected function resize_upload_image($path, $width = 200, $height = 150){
		$file = UPLOAD_DIR.'/'.$path;
		$new_file = $file;
//		$new_file = dirname($file).'/200_'.basename($file);
		$Image = new ImageUtil();
		$Image->param($file)->thumb($new_file, $width, $height, 1);
	}
	
}