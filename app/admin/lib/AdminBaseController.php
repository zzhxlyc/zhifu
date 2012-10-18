<?php

class AdminBaseController extends AppController {
	
	public function before(){
		$this->load_session();
		$need_no_session = $this->no_session;
		$method = $this->request->get_method();
		if(!in_array($method, $need_no_session)){
			$admin = get_admin_session($this->session);
			$Admin = $this->Admin->get($admin);
			if(!$Admin){
				$this->redirect('login', '');
			}
			$this->set('User', $Admin);
		}
		$this->view->layout = 'admin';
		$this->set_global_param();
	}
	
	protected function get_delete_ids($get, $post){
		if(isset($get['id'])){
			$r = array($get['id']);
		}
		if(isset($post['id'])){
			$r = $post['id'];
		}
		if(isset($r) && count($r) > 0){
			$r = array_map('intval', $r);
			return $r;
		}
		else{
			return array();
		}
	}
	
	public function delete($model = '', $redirect = true){
		if($model == ''){
			$model = $this->request->module;
		}
		$Model = ucfirst($model);
		$model = strtolower($model);
		$action_method = "action_{$model}_delete";
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			if(isset($post['id'])){
				$ids = $post['id'];
				$num = $this->{$Model}->delete($ids);
				if($num > 0){
					if(method_exists($this->Log, $action_method)){
						$this->Log->$action_method($admin, $num.'个');
					}
				}
			}
		}
		else{
			$get = $this->request->get;
			if(isset($get['id'])){
				$id = $get['id'];
				$problem = $this->{$Model}->get($id);
				if($problem){
					$this->{$Model}->delete($id);
					if(method_exists($this->Log, $action_method)){
						$this->Log->$action_method($admin, $problem->title);
					}
				}
			}
		}
		if($redirect){
			$this->response->redirect('index');
		}
	}
	
}