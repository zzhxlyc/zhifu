<?php

class TopicController extends AppController {
	
	public $models = array('Topic');
	
	public function before(){
		$this->set('home', TOPIC_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$ord = $get['order'];
		$limit = 10;
		$condition = array('parent'=>0);
		$order = array();
		if($ord == 'time'){
			$order['time'] = 'DESC';
		}
		else if($ord == 'deadline'){
			$order['deadline'] = 'DESC';
		}
		else if($ord == 'budget'){
			$order['budget'] = 'DESC';
		}
		else{
			$order['id'] = 'DESC';
		}
		$all = $this->Topic->count($condition);
		$pager = new Pager($all, $page, $limit);
		$list = $this->Topic->get_page($condition, $order, $pager->now(), $limit);
		$links = $pager->get_page_links($this->get('home').'/index?');
		$this->set('list', $list);
		$this->set('links', $links);
		$hot_list = $this->Topic->get_list($condition, array('comments'=>'DESC'), 10);
		$this->set('hot_list', $hot_list);
	}
	
	
}