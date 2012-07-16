<?php

class LogController extends AdminBaseController {
	
	public $models = array('Log');
	public $no_session = array();
	
	public function before(){
		parent::before();
		$this->set('home', ADMIN_LOG_HOME.'/index');
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$all = $this->Log->count();
		$pager = new Pager($all, $page, $limit);
		$list = $this->Log->get_page(null, array('id'=>'DESC'), $pager->now(), $limit);
		$links = $pager->get_page_links(ADMIN_ARTILCE_HOME.'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
	}
	
}