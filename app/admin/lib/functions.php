<?php

function set_admin_session($session, $admin_id){
//	$session->set('admin', $admin_id);
}

function get_admin_session($session){
	return 1;
//	return $session->get('admin');
}

function get_user_cookie($cookie){
	return array(1, 'expert');
//	$cookie = $cookie['ZHIFU_U'];
//	list($type, $id) = explode('&', $cookie);
//	return array(base64_decode($id), $type);
}

function output_error($error, $home){
	echo '<p>'.$error.'</p>';
	echo '<a href="'.$home.'">返回</a>';
}