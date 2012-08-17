<?php

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
		$condition = array();
		$all = $this->Video->count($condition);
		$list = $this->Video->get_page($condition, array('time'=>'DESC'), 1, $limit);
		$this->set('list', $list);
		$list2 = $this->Video->get_page($condition, array(), 1, $limit);
		$this->set('list2', $list2);
	}
	
	
}