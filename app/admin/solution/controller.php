<?php

class SolutionController extends AdminBaseController {
	
	public $models = array('Solution', 'Problem', 'Expert', 'Log');
	public $no_session = array();
	
	public function before(){
		$this->set('home', ADMIN_SOLUTION_HOME);
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
			$problem = $this->Problem->get($pid);
			if($problem){
				$condition = array('problem'=>$pid);
				$all = $this->Solution->count($condition);
				$pager = new Pager($all, $page, $limit);
				$list = $this->Solution->get_list($condition, $order, $pager->now(), $limit);
				$page_list = $pager->get_page_links(ADMIN_SOLUTION_HOME."/index?pid=$pid&");
				$this->set('list', $list);
				$this->set('$problem', $problem);
				$this->set('$page_list', $page_list);
			}
		}
		else if($eid){
			$expert = $this->Expert->get($eid);
			if($expert){
				$condition = array('expert'=>$eid);
				$all = $this->Solution->count($condition);
				$pager = new Pager($all, $page, $limit);
				$list = $this->Solution->get_list($condition, $order, $pager->now(), $limit);
				$page_list = $pager->get_page_links(ADMIN_SOLUTION_HOME."/index?eid=$eid&");
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
			$condition = array('problem'=>$pid, 'expert'=>$eid);
			$solution = $this->Solution->get_row($condition);
			if($solution){
				$this->set('$solution', $solution);
				$problem = $this->Problem->get($solution->problem);
				$expert = $this->Expert->get($solution->expert);
				$this->set('$problem', $problem);
				$this->set('$expert', $expert);
			}
		}
		if(!$this->is_set('$solution')){
			$this->set('error', '数据有误');
		}
	}
	
}