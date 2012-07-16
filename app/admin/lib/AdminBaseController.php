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
	}
	
}