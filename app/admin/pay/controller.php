<?php

class PayController extends AdminController {
	
	public $models = array('Pay', 'Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_PAY_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Pay->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Pay->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_PAY_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
	public function delete(){
		if($this->request->post){
			$post = $this->request->post;
			$admin = get_admin_session($this->session);
			if(isset($post['ids'])){
				$ids = $post['ids'];
				$this->Pay->delete($ids);
			}
			else if(isset($post['id'])){
				$id = $post['id'];
				$pay = $this->Pay->get($id);
				$this->Pay->delete($id);
			}
			$this->response->redirect('index');
		}
	}
	
}