<?php

include(LIB_UTIL_DIR.'/captcha/Captcha.php');

class ZhifuController extends AppController {
	
	public $models = array('Problem', 'Idea', 'IdeaItem', 'Article', 
							'Video', 'Patent', 'Recruit', 'Apply', 
							'Tag', 'TagItem', 'Category', 'Topic');
	
	public function before(){
		parent::before();
	}
	
	public function index(){
		$order = array('id'=>'DESC');
		$order_hot = array('click'=>'DESC');
		$limit = 4;
		$cond = array();
		$problems = $this->Problem->get_list(array('verify'=>1), $order, 4);

		$ideas = $this->Idea->get_list($cond, $order, 3);
		if(count($ideas) > 0){
			foreach($ideas as $idea){
				$idea->item_count = 0;
			}
			$indexs = id_to_index($ideas);
			$i_ids = get_ids($ideas);
			$i_items = $this->IdeaItem->get_list(array('idea in'=>$i_ids));
			foreach($i_items as $item){
				$idea = $ideas[$indexs[$item->idea]];
				$idea->item_count = $idea->item_count + 1;
			}
		}
		
		$videos = $this->Video->get_list($cond, $order_hot, 6);
		$recruits = $this->Recruit->get_list($cond, $order, $limit);
		$patents = $this->Patent->get_list($cond, $order, 6);
		$articles = $this->Article->get_list(array('type'=>0), $order_hot, 1);
		$experts = $this->Expert->get_list($cond, $order, 3);
		$topics = $this->Topic->get_list($cond, $order, 10);
		
		$this->set('$problems', $problems);
		$this->set('$ideas', $ideas);
		$this->set('$videos', $videos);
		$this->set('$recruits', $recruits);
		$this->set('$patents', $patents);
		$this->set('$articles', $articles);
		$this->set('$experts', $experts);
		$this->set('$topics', $topics);
		
		$this->add_categorys();
	}
	
	public function captcha(){
		$captcha = new SimpleCaptcha();
		$this->set('$captcha', $captcha);
		$this->layout('empty');
	}
	
	private function check_username($username){
		$chars = "/^([a-zA-Z0-9]){3,20}\$/i";
		if(preg_match($chars, $username)){
			return true;
		}
		return false;
	}
	
	public function register(){
		if($this->request->post){
			$post = $this->request->post;
			$type = $post['type'];
			$user = trim(esc_text($post['user']));
			$pswd = trim($post['pswd']);
			$pswd2 = trim($post['pswd2']);
			$email = trim(esc_text($post['email']));
			$mobile = trim(esc_text($post['mobile']));
			$captcha = trim($post['captcha']);
			$agree = trim($post['agree']);
			
			$errors = array();
			if(strlen($user) == 0){
				$errors['user'] = '用户名为空';
			}
			else if(!$this->check_username($user)){
				$errors['user'] = '用户名不符合规范 ';
			}
			if(strlen($pswd) == 0){
				$errors['pswd'] = '密码为空';
			}
			else if(!$this->check_pswd($pswd)){
				$errors['pswd'] = '密码不符合规范 ';
			}
			if(strlen($pswd2) == 0){
				$errors['pswd2'] = '密码为空';
			}
			else if($pswd2 != $pswd){
				$errors['pswd2'] = '密码不一致';
			}
			if(empty($type)){
				$errors['type'] = '类型为空';
			}
			if(!empty($mobile) && CheckUtils::check_mobile($mobile) == false){
				 $errors['mobile'] = '手机格式有误';
			}
			if(strlen($email) == 0){
				$errors['email'] = '邮箱为空';
			}
			else if(!CheckUtils::check_email($email)){
				$errors['email'] = '邮箱不符合规范';
			}
			else if($this->find_user_by_email($email) !== false){
				$errors['email'] = '此邮箱已被使用';
			}
			if(empty($captcha)){
				$errors['captcha'] = '验证码为空';
			}
			else if($captcha != $this->session->get('captcha')){
				$errors['captcha'] = '验证码错误';
			}
			if(empty($agree)){
				$errors['agree'] = '没有同意注册条款';
			}
			if(count($errors) == 0){
				$data = array();
				$data['username'] = $user;
				$data['password'] = md5($pswd);
				$data['email'] = $email;
				$data['mobile'] = $mobile;
				$this->user_init($data);
				$cond = array('username'=>$user);
				if($type == BelongType::COMPANY){
					$Company = $this->Company->get_row($cond);
					if($Company){
						$errors['user'] = '此用户已被使用';
					}
					else{
						$id = $this->Company->save($data);
						$this->redirect('reg_succ');
					}
				}
				else if($type == BelongType::EXPERT){
					$data['patents'] = 0;
					$Expert = $this->Company->get_row($cond);
					if($Expert){
						$errors['user'] = '此用户已被使用';
					}
					else{
						$id = $this->Expert->save($data);
						$this->redirect('reg_succ');
					}
				}
				else{
					$errors['type'] = '类型错误';
				}
			}
			$this->set('username', $user);
			$this->set('type', $type);
			$this->set('mobile', $mobile);
			$this->set('email', $email);
			$this->set('errors', $errors);
		}
	}
	
	public function reg_succ(){}
	
	public function home(){
		$User = $this->get('User');
		if($User){
			if($User->is_company()){
				$this->redirect('profile', 'company');
			}
			else if($User->is_expert()){
				$this->redirect('profile', 'expert');
			}
			else{
				$this->redirect('login', '');
			}
		}
		else{
			$this->redirect('login', '');
		}
	}
	
	public function setting(){
		$User = $this->get('User');
		if($User){
			if($User->is_company()){
				$this->redirect('myself', 'company');
			}
			else if($User->is_expert()){
				$this->redirect('myself', 'expert');
			}
			else{
				$this->redirect('login', '');
			}
		}
		else{
			$this->redirect('login', '');
		}
	}
	
	public function pswd(){
		$User = $this->get('User');
		if($User){
			if($User->is_company()){
				$this->redirect('pswd', 'company');
			}
			else if($User->is_expert()){
				$this->redirect('pswd', 'expert');
			}
			else{
				$this->redirect('login', '');
			}
		}
		else{
			$this->redirect('login', '');
		}
	}
	
}