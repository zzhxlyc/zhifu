<?php

include(LIB_UTIL_DIR.'/DateCrossUtil.php');

class VideoController extends AppController {
	
	public $models = array('Video');
	
	public function before(){
		$this->set('home', VIDEO_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$ord = $get['order'];
		$limit = 10;
		$cond = array();
		$all = $this->Video->count($cond);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Video->get_page($cond, array('time'=>'DESC'), 
										$pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
		
		list($from, $to) = DateCrossUtil::this_month();
		$cond = array('time >='=>$from);
		$hot_list = $this->Video->get_list($cond, array('click'=>'DESC'), 3);
		$this->set('hot_list', $hot_list);
	}
	
	public function url(){
		
	}
	
}