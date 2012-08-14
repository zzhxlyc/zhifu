<?php

class LogController extends AdminBaseController {
	
	public $models = array('Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_LOG_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$cond = array();
		$all = $this->Log->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Log->get_page($cond, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_LOG_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
}