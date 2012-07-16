<?php

function get_id($get){
	$id = intval($get[id]);
	return $id;
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
	foreach($list as $obj){
		$ret[$obj->id] = $obj;
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
