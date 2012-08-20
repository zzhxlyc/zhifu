<?php

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
			$type = $post['type'];
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
			if(empty($type)){
				$errors['type'] = '类型为空';
			}
			if(empty($captcha)){
				$errors['captcha'] = '验证码为空';
			}
			else if($captcha != $this->session->get('captcha')){
				$errors['captcha'] = '验证码错误';
			}
			if(count($errors) == 0){
				$pswd = md5($pswd);
				$cond = array('username'=>$user, 'password'=>$pswd);
				$cond = array('id'=>1);
				if($type == BelongType::COMPANY){
					$Company = $this->Company->get_row($cond);
					if($Company){
						$cookie = $this->get_cookie(BelongType::COMPANY, $Company);
						$this->response->set_cookie(COOKIE_U, $cookie);
//						$this->redirect('index', 'company');
						$this->redirect('/');
					}
				}
				else if($type == BelongType::EXPERT){
					$Expert = $this->Expert->get_row($cond);
					if($Expert){
						$cookie = $this->get_cookie(BelongType::EXPERT, $Expert);
						$this->response->set_cookie(COOKIE_U, $cookie);
						$this->redirect('/');
					}
				}
				else{
					$errors['type'] = '类型错误';
				}
				$errors['pswd'] = '用户名或密码错误';
			}
			$this->set('username', $user);
			$this->set('type', $type);
			$this->set('errors', $errors);
		}
	}
	
	public function forget(){
		if($this->request->post){
			$post = $this->request->post;
			$type = $post['type'];
			$email = trim($post['email']);
			$captcha = trim($post['captcha']);
			if(empty($type)){
				$errors['type'] = '类型为空';
			}
			if(empty($email)){
				$errors['email'] = '邮件为空';
			}
			if(empty($captcha)){
				$errors['captcha'] = '验证码为空';
			}
			else if($captcha != $this->session->get('captcha')){
				$errors['captcha'] = '验证码错误';
			}
			if(count($errors) == 0){
				$cond = array('email'=>$email);
				$data = array();
				$data['code'] = $this->ResetCode->get_reset_code();
				$data['time'] = TIMESTAMP;
				if($type == BelongType::COMPANY){
					$Company = $this->Company->get_row($cond);
					if($Company){
						$data['type'] = BelongType::COMPANY;
						$data['user'] = $Company->id;
						$this->ResetCode->save($data);
						$this->redirect('succ');
					}
				}
				else if($type == BelongType::EXPERT){
					$Expert = $this->Expert->get_row($cond);
					if($Expert){
						$data['type'] = BelongType::EXPERT;
						$data['user'] = $Expert->id;
						$this->ResetCode->save($data);
						$this->redirect('succ');
					}
				}
				else{
					$errors['type'] = '类型错误';
				}
				$errors['email'] = '无此注册邮箱';
			}
			$this->set('$errors', $errors);
			$this->set('$email', $email);
			$this->set('$type', $type);
		}
	}
	
	public function succ(){}
	
	public function reset(){
		if($this->request->post){
			$post = $this->request->post;
			$code = $post['code'];
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