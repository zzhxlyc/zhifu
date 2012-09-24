<?php

include(LIB_DIR.'/mail/email.php');

class LoginController extends AppController {
	
	public $models = array('ResetCode');
	
	public function before(){
		$this->set('home', LOGIN_HOME);
		parent::before();
	}
	
	private function get_cookie($type, $user){
		$type = md5($type);
		return "$type;$user->username;$user->password";
	}
	
	public function login(){
		if($this->request->post){
			$post = $this->request->post;
			$user = trim($post['user']);
			$pswd = trim($post['pswd']);
			$captcha = trim($post['captcha']);
			$errors = array();
			if(strlen($user) == 0){
				$errors['user'] = '登录名为空';
			}
			if(strlen($pswd) == 0){
				$errors['pswd'] = '密码为空';
			}
//			if(empty($captcha)){
//				$errors['captcha'] = '验证码为空';
//			}
//			else if($captcha != $this->session->get('captcha')){
//				$errors['captcha'] = '验证码错误';
//			}
			if(count($errors) == 0){
				$pswd = md5($pswd);
				$User = $this->find_user($user);
				if($User){
					if($User->password == $pswd){
						if($User->is_company()){
							$cookie = $this->get_cookie(BelongType::COMPANY, $User);
						}
						if($User->is_expert()){
							$cookie = $this->get_cookie(BelongType::EXPERT, $User);
						}
						$this->response->set_cookie(COOKIE_U, $cookie);
						$this->redirect('/');
					}
				}
				$errors['pswd'] = '用户名或密码错误';
			}
			$this->set('username', $user);
			$this->set('errors', $errors);
		}
	}
	
	public function loginout(){
		$this->response->set_cookie(COOKIE_U, '');
		$this->redirect('/', null);
	}
	
	public function forget(){
		if($this->request->post){
			$post = $this->request->post;
			$user = trim($post['user']);
			$captcha = trim($post['captcha']);
			if(empty($user)){
				$errors['user'] = '用户名为空';
			}
			if(empty($captcha)){
				$errors['captcha'] = '验证码为空';
			}
			else if($captcha != $this->session->get('captcha')){
				$errors['captcha'] = '验证码错误';
			}
			if(count($errors) == 0){
				$U = $this->find_user_by_name($user);
				if($U){
					$code = $this->ResetCode->get_reset_code();
					$email = $U->email;
					if(send_pswd_reset_email($email, $U->name, $code)){
						$data = array();
						$data['code'] = $code;
						$data['time'] = TIMESTAMP;
						$data['type'] = $U->get_type();
						$data['user'] = $U->id;
						$this->ResetCode->save($data);
						$this->redirect('succ');
					}
				}
				else{
					$errors['user'] = '无此用户';
				}
			}
			$this->set('$errors', $errors);
			$this->set('$user', $user);
		}
	}
	
	public function succ(){}
	
	public function reset(){
		if($this->request->post){
			$post = $this->request->post;
			$code = $post['code'];
			$this->set('$code', $code);
			$pswd = $post['pswd'];
			$pswd2 = $post['pswd2'];
			$errors = array();
			if(empty($pswd)){
				$errors['pswd'] = '密码为空';
			}
			if(empty($pswd2)){
				$errors['pswd2'] = '确认密码为空';
			}
			else if($pswd2 != $pswd){
				$errors['pswd2'] = '密码不一致';
			}
			if(count($errors) == 0){
				if($code && strlen($code) == 32){
					$this->set('$code', $code);
					$reset = $this->ResetCode->get_row(array('code'=>$code));
					$reset_data = array('id'=>$reset->id, 'time'=>0);
					if($reset->is_expire()){
						$this->set('code', '已过期');
					}
					else if($reset->type == BelongType::COMPANY){
						$Company = $this->Company->get($reset->user);
						if(!$Company){
							$this->set('error', 'code有误');
						}
						else{
							$data = array('id'=>$reset->user, 'password'=>md5($pswd));
							$this->Company->save($data);
							$this->ResetCode->save($reset_data);
							$this->redirect('login', '');
						}
					}
					else if($reset->type == BelongType::EXPERT){
						$Expert = $this->Expert->get($reset->user);
						if(!$Expert){
							$this->set('error', 'code有误');
						}
						else{
							$data = array('id'=>$reset->user, 'password'=>md5($pswd));
							$this->Expert->save($data);
							$this->ResetCode->save($reset_data);
							$this->redirect('login', '');
						}
					}
				}
				else{
					$errors['code'] = 'code error';				
				}
			}
			$this->set('$errors', $errors);
		}
		else{
			$get = $this->request->get;
			$code = $get['code'];
			if($code && strlen($code) == 32){
				$this->set('$code', $code);
				$reset = $this->ResetCode->get_row(array('code'=>$code));
				if($reset->is_expire()){
					$this->set('error', 'URL已过期');
				}
				else if($reset->type == BelongType::COMPANY){
					$Company = $this->Company->get($reset->user);
					if(!$Company){
						$this->set('error', 'URL有误');
					}
				}
				else if($reset->type == BelongType::EXPERT){
					$Expert = $this->Expert->get($reset->user);
					if(!$Expert){
						$this->set('error', 'URL有误');
					}
				}
			}
			else{
				$this->set('error', 'URL有误');
			}
		}
	}
	
}