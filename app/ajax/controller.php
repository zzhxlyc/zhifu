<?php

class AjaxController extends AppController {
	
	public $models = array('Word', 'Comment');
	
	public function before(){
		parent::before();
		$this->layout('ajax');
//		$not_need_login = array();
//		$User = $this->get('User');
//		$method = $this->request->get_method();
//		if(!in_array($method, $not_need_login)){
//			if(!$User){
//				echo -1;
//				exit;
//			}
//		}
	}
	
	public function checkword(){
		$word = '';
		if(!empty($this->request->post['word'])){
			$word = $this->request->post['word'];
		}
		if(!empty($this->request->get['word'])){
			$word = $this->request->get['word'];
		}
		if($this->Word->check_word($word)){
			echo 0;	//ok
		}
		else{
			echo 1;	// sensitive
		}
	}
	
	public function comment(){
		$User = $this->get('User');
		$ret = array();
		if($User){
			if($this->request->post){
				$post = $this->request->post;
				$User = $this->get('User');
				$post['user'] = $User->id;
				$post['author'] = $User->name;
				$post['username'] = $User->username;
				$post['user_type'] = $User->get_type();
				$errors = $this->Comment->check($post);
				if(count($errors) == 0){
					$post['time'] = DATETIME;
					$id = $this->Comment->save($post);
					$ret['succ'] = 1;
					$ret['id'] = $id;
					$ret['name'] = $User->name;
					$ret['time'] = DATETIME;
				}
				else{
					$ret['succ'] = 0;
					$ret['error'] = implode(';', $errors);
				}
			}
		}
		else{
			$ret['succ'] = -1;
			$ret['error'] = '请先登录';
		}
		echo json_encode($ret);
	}
	
}