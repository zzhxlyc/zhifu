<?php

class TagItem extends Model{

	public $table = 'tag_items';
	
	public function check(&$data, array $ignore = array()){
		$must_need = array('user', 'password', 'flag' ,'limit');
		$length_check = array('user'=>200, 'password'=>200);
		$must_int = array('flag', 'limit');
		return parent::check($data, $must_need, $length_check, $must_int, $ignore);
	}
	
	public function get_most($list, $length = 10){
		$r = array();
		foreach($list as $tagid){
			if(!in_array($tagid, $r)){
				$r[$tagid] = 0;
			}
			$r[$tagid]++;
		}
		arsort($r);
		if(count($r) > 10){
			return array_slice($r, 0, 10);
		}
		else{
			return $r;
		}
	}

}