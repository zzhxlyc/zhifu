<?php

function set_admin_session($session, $admin_id){
	$session->set('Admin', $admin_id);
}

function get_admin_session($session){
	return $session->get('Admin');
}

function get_user_cookie($cookie){
	return array(1, 'expert');
//	$cookie = $cookie['ZHIFU_U'];
//	list($type, $id) = explode('&', $cookie);
//	return array(base64_decode($id), $type);
}

function left_tab_current($module, $method = Null){
	global $request;
	if($module == $request->get_module()){
		if($method == Null){
			echo 'class="current"';
		}
		else if($request->get_method() == $method){
			echo 'class="current"';
		}
	}
}

function if_tab1_current(){
	global $request;
	$array = array('problem', 'idea', 'patent', 'recruit', 'video', 'article',
					'topic', 'message', 'category', 'tag');
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
	$array = array('link');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}

function if_tab7_current(){
	global $request;
	if($request->get_module() == 'admin' &&
			$request->get_method() == 'pswd'){
		echo 'class="current"';
	}
}