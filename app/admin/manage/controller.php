<?php

class ManageController extends AdminBaseController {
	
	public $models = array('Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_MANAGE_HOME);
		parent::before();
	}
	
	public function index(){
		
	}
	
	private function do_file(&$data, &$errors, &$files){
		$field = 'logo';
		$file = $files[$field];
		if($file && is_uploaded_file($file['tmp_name'])){
			if(empty($error)){
				$path = $this->upload_file($file);
				$data[$field] = $path;
			}
			else{
				$errors[$field] = $error;
			}
		}
	}
	
	public function base(){
		if($this->request->post){
			$post = $this->request->post;
			$data = array();
			$errors = array();
			$this->do_file($data, $errors, $this->request->file);
			$data['title'] = esc_text($post['title']);
			$data['slogan'] = esc_text($post['slogan']);
			Option::persist('ADMIN_MANAGE_BASE', serialize($data));
			$this->redirect('base');
		}
		else{
			$data = unserialize(Option::find('ADMIN_MANAGE_BASE'));
			$this->set('logo', UPLOAD_HOME.'/'.$data['logo']);
			$this->set('title', $data['title']);
			$this->set('slogan', $data['slogan']);
		}
	}
	
	public function statistics(){
		if($this->request->post){
			$post = $this->request->post;
			$html = addslashes($post['html']);
			Option::persist('ADMIN_MANAGE_STATISTICS', $html);
			$this->redirect('statistics');
		}
		else{
			$html = Option::find('ADMIN_MANAGE_STATISTICS');
			$this->set('html', $html);
		}
	}
	
	public function head(){
		if($this->request->post){
			$post = $this->request->post;
			$html = addslashes($post['html']);
			Option::persist('ADMIN_MANAGE_HEAD_HTML', $html);
			$this->redirect('head');
		}
		else{
			$html = Option::find('ADMIN_MANAGE_HEAD_HTML');
			$this->set('html', $html);
		}
	}
	
	public function foot(){
		if($this->request->post){
			$post = $this->request->post;
			$html = addslashes($post['html']);
			Option::persist('ADMIN_MANAGE_FOOT_HTML', $html);
			$this->redirect('foot');
		}
		else{
			$html = Option::find('ADMIN_MANAGE_FOOT_HTML');
			$this->set('html', $html);
		}
	}
	
}