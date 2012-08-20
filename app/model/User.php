<?php

abstract class User extends AppModel{
	
	public function is_company(){
		return false;
	}
	
	public function is_expert(){
		return false;
	}
	
	public function is_admin(){
		return false;
	}
	
	public function get_type(){
		if($this->is_company()){
			return BelongType::COMPANY;
		}
		if($this->is_expert()){
			return BelongType::EXPERT;
		}
		if($this->is_admin()){
			return BelongType::ADMIN;
		}
	}
	
	public function status(){
		if($this->verified == 1){
			return '已验证';
		}
		else{
			return '未验证';
		}
	}

}