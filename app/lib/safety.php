<?php

function remove_magic_quotes_gpc($content){
	if (get_magic_quotes_gpc()) {
		return stripslashes($content);
	}
	else{
		return $content;
	}
}

function url_escape_unsafe($str, array $add = array(), array $sub = array()){
	$unsafe_array = array("'", '"', '<', '>', '\\');
	$unsafe_array = array_merge($unsafe_array, $add);
	$unsafe_array = array_diff($unsafe_array, $sub);
	$s = str_replace($unsafe_array, '', $str);
	return $s;
}

function escape_unsafe($str, array $unsafe = array()){
	$escape = array('html'=>1, 'quote'=>1, 'and'=>0);
	$escape = array_merge($escape, $unsafe);
	$s = str_replace('\\', '&#92;', $str);
	if($escape['html'] === 1){
		$s = str_replace('<', '&lt;', $s);
		$s = str_replace('>', '&gt;', $s);
	}
	if($escape['quote'] === 1){
		$s = str_replace("'", '&#39;', $s);
		$s = str_replace('"', '&quot;', $s);
	}
	if($escape['and'] === 1){
		$s = str_replace('&', '&amp;', $s);
	}
	return $s;
}

function escape_html($str){
	$s = str_replace('\\', '&#92;', $str);
	$s = base64_encode($s);
	return $s;
}
