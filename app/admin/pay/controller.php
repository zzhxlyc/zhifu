<?php

class PayController extends AdminBaseController {
	
	public $models = array('Pay', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_PAY_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$limit = 10;
		$cond = array();
		$all = $this->Pay->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Pay->get_page($cond, array('id'=>'DESC'), $pager->now(), $limit);
		$page_list = $pager->get_page_links(ADMIN_PAY_HOME.'/index?');
		$this->set('list', $list);
		$this->set('$page_list', $page_list);
	}
	
}