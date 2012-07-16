<?php

class FileController extends AppController {
	
	public $models = array('File');
	
	public function before(){
	}
	
	private function do_file(&$data, &$errors, &$files){
		$file = $files['file'];
		if($file && is_uploaded_file($file['tmp_name'])){
			$error = $this->File->check_file($file);
			if(empty($error)){
				$path = $this->upload_file($file);
				return $path;
			}
			else{
				$errors['file'] = $error;
			}
		}
	}
	
	public function upload(){
		$this->view->layout = 'empty';
		if($this->request->post){
			$post = $this->request->post;
			$errors = array();
			$path = $this->do_file($post, $errors, $this->request->file);
			if(count($errors) == 0){
				if($post['type'] == 'admin'){
					$admin = get_admin_session($this->session);
					$this->File->save_by_admin($path, $admin);
				}
				else if($post['type'] == 'expert'){
					list($expert, $type) = get_user_cookie($this->request->cookie);
					if($type == 'expert'){
						$this->File->save_by_expert($path, $expert);
					}
				}
				else if($post['type'] == 'company'){
					list($company, $type) = get_user_cookie($this->request->cookie);
					if($type == 'company'){
						$this->File->save_by_company($path, $company);
					}
				}
				else{
					$this->response->redirect_404();
				}
				$file_url = UPLOAD_HOME.'/'.$path;
				$this->set('file_url', $file_url);
			}
			else{
				$this->set('errors', $errors);
			}
		}
	}
	
}