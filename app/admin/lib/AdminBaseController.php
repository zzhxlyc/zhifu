<?php

class AdminBaseController extends AppController {
	
	public function before(){
		$need_no_session = $this->no_session;
		$method = $this->request->get_method();
		if(!in_array($method, $need_no_session)){
			$this->load_session();
			$admin = get_admin_session($this->session);
			if(!$admin){
				$this->response->redirect('login', 'admin');
			}
		}
		$this->view->layout = 'admin';
		if(isset($this->vars['home'])){
			$this->set('index_page', $this->vars['home'].'/index');
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