<?php

include(LIB_UTIL_DIR.'/captcha/Captcha.php');

class ZhifuController extends AppController {
	
	public $models = array();
	
	public function before(){
		parent::before();
	}
	
	public function captcha(){
		$captcha = new SimpleCaptcha();
		$this->set('$captcha', $captcha);
		$this->layout('empty');
	}
	
	public function register(){
		if($this->request->post){
			$post = $this->request->post;
			$type = $post['type'];
			$user = trim($post['user']);
			$pswd = trim($post['pswd']);
			$pswd2 = trim($post['pswd2']);
			$email = trim($post['email']);
			$captcha = trim($post['captcha']);
			$errors = array();
			if(strlen($user) == 0){
				$errors['user'] = '登录名为空';
			}
			else{
				$this->set('username', $user);
			}
			if(strlen($pswd) == 0){
				$errors['pswd'] = '密码为空';
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
			if(strlen($email) == 0){
				$errors['email'] = '邮件为空';
			}
			else if(!StringUtils::check_email($email)){
				$errors['email'] = '邮件不符合规范';
			}
			if(empty($captcha)){
				$errors['captcha'] = '验证码为空';
			}
			else if($captcha != $this->session->get('captcha')){
				$errors['captcha'] = '验证码错误';
			}
			if(count($errors) == 0){
				$data = array();
				$data['username'] = $user;
				$data['password'] = md5($pswd);
				$data['email'] = $email;
				$data['time'] = DATETIME;
				$data['rate_total'] = 0;
				$data['rate_num'] = 0;
				$data['budget'] = 0;
				$data['verified'] = 0;
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
			$this->set('$email', $email);
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
				$this->redirect('edit', 'company');
			}
			else if($User->is_expert()){
				$this->redirect('edit', 'expert');
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