<?php

class ResetCode extends User {

	public $table = 'reset_code';
	
	public function get_reset_code(){
		return md5(TIMESTAMP);
	}
	
	public function is_expire(){
		if($this->time + 3600 * 24 < time()){
			return true;
		}
		else{
			return false;
		}
	}

}