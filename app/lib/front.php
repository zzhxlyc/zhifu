<?php

function head_tab0(){
	global $request;
	$array = array('zhifu');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}
function head_tab1(){
	global $request;
	$array = array('problem');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}
function head_tab2(){
	global $request;
	$array = array('idea');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}
function head_tab3(){
	global $request;
	$array = array('patent');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}
function head_tab4(){
	global $request;
	$array = array('recruit', 'apply');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}
function head_tab5(){
	global $request;
	$array = array('expert');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}
function head_tab6(){
	global $request;
	$array = array('video');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}
function head_tab7(){
	global $request;
	$array = array('topic');
	if(in_array($request->get_module(), $array)){
		echo 'class="current"';
	}
}
function head_tab8(){
	global $request;
	$array = array('article');
	if(in_array($request->get_module(), $array)){
		echo ' current';
	}
}