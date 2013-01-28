<?php

function get_wrapped_cat_list($list){
	$ret = array();
	foreach($list as $cat){
		$ret[$cat->id] = $cat;
	}
	return $ret;
}

function cat_list_walk($cat_list, $c, $callback){
	list($root, $children) = get_root_children_cat($cat_list);
	_cat_list_walk($root, $children, $cat_list, $c, 0, $callback);
}

function _cat_list_walk($root, $children, $cat_list, $c, $depth, $callback){
	foreach($root as $id){
		//echo "root={".implode(',', $root)."}, id={$id}\n";
		call_user_func($callback, $id, $cat_list[$id]->name, $c, $depth);
		if(array_key_exists($id, $children)){
			_cat_list_walk($children[$id], $children, $cat_list, $c, $depth + 1, $callback);
		}
	}
}

function output_select_cat_option($value, $name, $c, $depth){
	//echo("value={$value} name={$name} c={$c} depth={$depth}\n");
	$front = '';
	for($i = 0;$i < $depth;$i++) $front.= '&nbsp;&nbsp;&nbsp;'.$front;
	$name = $front.$name;
	if($value == intval($c)){
		echo "<option value=\"$value\" selected=\"selected\">$name</option>";
	}
	else{
		echo "<option value=\"$value\">$name</option>";
	}
}

function get_root_children_cat($list){
	$root = array();
	$children = array();
	foreach($list as $cat){
		if($cat->parent == 0){
			$root[] = $cat->id;
		}
		else{
			$children[$cat->parent][] = $cat->id;
		}
	}
	return array($root, $children);
}

function get_belong_to_top_cat($root, $children, $self){
	$ret = array();
	foreach($root as $rid){
		$ret[$rid] = get_belong_to_cat($rid, $children, $self);
	}
	return $ret;
}

function get_belong_to_cat($id, $children, $self){
	$ret = array();
	$is_parent = array_key_exists($id, $children);
	if(!$is_parent || $self) $ret[] = $id;
	if($is_parent){
		$a = $children[$id];
		if(is_array($a)){
			foreach($a as $aa){
				$rr = get_belong_to_cat($aa, $children, $self);
				$ret = array_merge($ret, $rr);
			}
		}
		else{
			$ret[] = $a;
		}
	}
	return $ret;
}

function get_top_cat($list, $id){
	if($id <= 0) return 0;
	$l = get_wrapped_cat_list($list);
	$d = $id;
	while(true){
		$c = $l[$d];
		if($c->parent == 0) return $c->id;
		$d = $c->parent;
	}
}