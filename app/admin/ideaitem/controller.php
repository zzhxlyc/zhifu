<?php

class IdeaitemController extends AdminBaseController {
	
	public $models = array('IdeaItem', 'Idea', 'Expert', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_IDEAITEM_HOME);
		parent::before();
	}
	
	public function index(){
		$get = $this->request->get;
		$page = $get['page'];
		$pid = intval($get['pid']);
		$eid = intval($get['eid']);
		$limit = 10;
		$order = array('time'=>'DESC');
		if($pid){
			$idea = $this->Idea->get($pid);
			if($idea){
				$condition = array('idea'=>$pid);
				$all = $this->IdeaItem->count($condition);
				$pager = new Pager($all, $page, $limit);
				$list = $this->IdeaItem->get_list($condition, $order, $pager->now(), $limit);
				$page_list = $pager->get_page_links(ADMIN_IDEAITEM_HOME."/index?pid=$pid&");
				$this->set('list', $list);
				$this->set('$idea', $idea);
				$this->set('$page_list', $page_list);
			}
		}
		else if($eid){
			$expert = $this->Expert->get($eid);
			if($expert){
				$condition = array('expert'=>$eid);
				$all = $this->IdeaItem->count($condition);
				$pager = new Pager($all, $page, $limit);
				$list = $this->IdeaItem->get_list($condition, $order, $pager->now(), $limit);
				$page_list = $pager->get_page_links(ADMIN_IDEAITEM_HOME."/index?eid=$eid&");
				$this->set('list', $list);
				$this->set('$expert', $expert);
				$this->set('$page_list', $page_list);
			}
		}
	}
	
	public function show(){
		$get = $this->request->get;
		$pid = intval($get['pid']);
		$eid = intval($get['eid']);
		if($pid && $eid){
			$condition = array('idea'=>$pid, 'expert'=>$eid);
			$item = $this->IdeaItem->get_row($condition);
			if($item){
				$this->set('$item', $item);
				$idea = $this->Idea->get($item->idea);
				$expert = $this->Expert->get($item->expert);
				$this->set('$idea', $idea);
				$this->set('$expert', $expert);
			}
		}
		if(!$this->is_set('$item')){
			$this->set('error', '数据有误');
		}
	}
	
}