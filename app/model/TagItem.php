<?php

function TagItem_get_most_sort($a, $b){
	return $a->count > $b->count;
}

class TagItem extends Model{

	public $table = 'tag_items';
	
	public function check(&$data, array $ignore = array()){
		$must_need = array('user', 'password', 'flag' ,'limit');
		$length_check = array('user'=>200, 'password'=>200);
		$must_int = array('flag', 'limit');
		return parent::check($data, $must_need, $length_check, $must_int, $ignore);
	}
	
	public function get_most($list, $length = 10){
		usort($list, TagItem_get_most_sort);
		return array_slice($list, 0, 10);
	}

}