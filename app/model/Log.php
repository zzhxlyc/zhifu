<?php

Model::load_model('Admin');

class Log extends AppModel{
	
	const TYPE_NORMAL = 1;
	const TYPE_IMPORTANT = 2;
	const TYPE_CRUCIAL = 3;

	public $table = 'logs';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('admin', 'action', 'type'),
			'length' => array('action'=>250),
			'int' => array('type'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('action'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	private function get_admin($admin_or_id){
		if(!is_object($admin_or_id)){
			$admin_model = new Admin();
			$admin = $admin_model->get(intval($admin_or_id));
		}
		else{
			$admin = $admin_or_id;
		}
		return $admin;
	}
	
	public function action_login($admin_or_id){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 登陆', $admin->user);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_admin_add($admin_or_id, $admin_user){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 添加新管理员 %s', $admin->user, $admin_user);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_admin_delete($admin_or_id, $admin_user){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除管理员 %s', $admin->user, $admin_user);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_article_add($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 添加文章 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_article_edit($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 修改文章 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_article_delete($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除文章 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_video_add($admin_or_id, $video_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 添加视频 %s', $admin->user, $video_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_video_delete($admin_or_id, $video_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除视频 %s', $admin->user, $video_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_category_add($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 添加行业 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_category_delete($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除行业 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_company_edit($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 修改企业 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_company_pass($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 审核通过企业 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_company_delete($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除企业 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_expert_edit($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 修改专家 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_expert_pass($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 审核通过专家 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_expert_delete($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除专家 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_message_send($admin_or_id, &$post){
		$admin = $this->get_admin($admin_or_id);
		$type = BelongType::to_string($post['type']);
		$user = BelongType::get_user($post['to'], $post['type']);
		$action = sprintf('管理员 %s 向%s用户 %s 发送站内信 标题：%s', 
			$admin->user, $type, $user, $post['title']);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_patent_edit($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 修改专利 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_patent_delete($admin_or_id, $name){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除专利 %s', $admin->user, $name);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_topic_add($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 添加话题 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_topic_edit($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 修改话题 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_topic_delete($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除话题 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_problem_add($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 添加难题 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_problem_edit($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 修改难题 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_problem_delete($admin_or_id, $article_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除难题 %s', $admin->user, $article_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_NORMAL));
	}
	
	public function action_link_add($admin_or_id, $link_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 添加友情链接 %s', $admin->user, $link_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	public function action_link_delete($admin_or_id, $link_title){
		$admin = $this->get_admin($admin_or_id);
		$action = sprintf('管理员 %s 删除友情链接 %s', $admin->user, $link_title);
		$this->save(array('admin'=>$admin->id, 'action'=>$action, 
					'time'=>DATETIME, 'type'=>self::TYPE_IMPORTANT));
	}
	
	
	
}