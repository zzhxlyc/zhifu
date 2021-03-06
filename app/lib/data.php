<?php

function get_id($get){
	$id = intval($get[id]);
	return $id;
}

function get_ids($list, $array = true){
	$ret = array();
	foreach($list as $o){
		$ret[] = $o->id;
	}
	if($array){
		return $ret;
	}
	else{
		return join(',', $ret);
	}
}

function get_attrs($list, $attr, $array = true){
	$ret = array();
	foreach($list as $o){
		$ret[] = $o->$attr;
	}
	if($array){
		return $ret;
	}
	else{
		return join(',', $ret);
	}
}

function id_to_index($list){
	$s = count($list);
	$array = array();
	for($i = 0;$i < $s;$i++){
		$array[$list[$i]->id] = $i;
	}
	return $array;
}

function split_ids($ids, $split = ','){
	if($ids){
		$array = explode($split, $ids);
		$array = array_map('intval', $array);
		$array = array_unique($array);
		return $array;
	}
	return array();
}

function split_words($str, $split = ','){
	$ret = array();
	$array = explode($split, $str);
	foreach($array as $s){
		$s = trim($s);
		if(strlen($s) > 0){
			$ret[] = $s;
		}
	}
	return $ret;
}

function array_to_map($list, $field = 'id'){
	$ret = array();
	foreach($list as $obj){
		$ret[$obj->$field] = $obj;
	}
	return $ret;
}

//$list是一个obj的list，obj带id属性
function get_map_by_id($list){
	$ret = array();
	if($list){
		foreach($list as $obj){
			$ret[$obj->id] = $obj;
		}
	}
	return $ret;
}

function sort_as_ids($list, $id_list){
	if(!is_array($list)) return $list;
	if(is_string($id_list)){
		$id_list = explode(',', $id_list);
	}
	$t = array();
	$s = array();
	foreach($list as $l){
		$t[$l->id] = $l;
	}
	foreach($id_list as $id){
		$s[] = $t[$id];
	}
	return $s;
}

function get_date($time){
	if(!empty($time)){
		$ts = strtotime($time);
		if($ts > 0){
			return date('Y-m-d', $ts);
		}
	}
	return '';
}

function get_page($data, $field = 'page'){
	$page = intval($data[$field]);
	if($page <= 0){
		$page = 1;
	}
	return $page;
}

function get_value($o, $k){
	if(is_array($o)){
		return $o[$k];
	}
	else if(is_object($o)){
		return $o->$k;
	}
}

function set_value(&$o, $k, $v){
	if(is_array($o)){
		$o[$k] = $v;
	}
	else if(is_object($o)){
		$o->$k = $v;
	}
}

function preg_image($content){
	$pattern = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
	preg_match_all($pattern, $content, $m);
	if(count($m[0]) == 0) return '';
	return $m[1][0];
}

function is_valid_date($date){
	if(empty($date) || $date == '0000-00-00' || $date == '1970-01-01'){
		return false;	
	}
	return true;
}

function subString($str, $allow, $last = '...'){
	$l = strlen($str);
	$length = 0;
	$i = 0;
	for(;$i < $l;$i++){
		$c = $str[$i];
		$n = ord($c);
		if(($n >> 7) == 0){			//0xxx xxxx, asci, single
			$length += 0.5;
		}
		else if(($n >> 4) == 15){ 	//1111 xxxx, first in four char
			if(isset($str[$i + 1])){
				$i++;
				if(isset($str[$i + 1])){
					$i++;
					if(isset($str[$i + 1])){
						$i++;
					}
				}
			}
			$length++;
		}
		else if(($n >> 5) == 7){ 	//111x xxxx, first in three char
			if(isset($str[$i + 1])){
				$i++;
				if(isset($str[$i + 1])){
					$i++;
				}
			}
			$length++;
		}
		else if(($n >> 6) == 3){ 	//11xx xxxx, first in two char
			if(isset($str[$i + 1])){
				$i++;
			}
			$length++;
		}
		if($length >= $allow) break;
	}
	$ret = substr($str, 0, $i + 1);
	if($i + 1 < $l) $ret .= $last;
	return $ret;
}
