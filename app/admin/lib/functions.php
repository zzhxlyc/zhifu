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

function if_tab1_current(){
	global $request;
	$array = array('problem', 'patent', 'topic', 'article', 'video');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}

function if_tab2_current(){
	global $request;
	$array = array('company', 'expert', 'admin');
	if(in_array($request->get_module(), $array)){
		if($request->get_module() != 'admin' ||
				$request->get_method() != 'pswd'){
			echo 'class="current"';
		}
	}
}

function if_tab3_current(){
	global $request;
	$array = array('word', 'log');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}

function if_tab4_current(){
	global $request;
	$array = array('pay');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}

function if_tab5_current(){
	global $request;
	$array = array('manage');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}

function if_tab6_current(){
	global $request;
	return false;
}

function if_tab7_current(){
	global $request;
	if($request->get_module() == 'admin' &&
			$request->get_method() == 'pswd'){
		echo 'class="current"';
	}
}