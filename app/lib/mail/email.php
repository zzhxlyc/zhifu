<?php

include(LIB_DIR.'/mail/gmail.php');

function send_pswd_reset_email($email, $name, $code){
	$path = MODULE_DIR.'/html/pswd.html';
	$html = file_get_contents($path);
	$url = LOGIN_HOME.'/reset?code='.$code;
	$html = str_replace('${user}', $name, $html);
	$html = str_replace('${url}', $url, $html);
	$subject = '知富网重置密码';
	return send_gmail($subject, $html, $email, $name);
}

function send_reg_succ_email($email, $name){
	$path = MODULE_DIR.'/html/register.html';
	$html = file_get_contents($path);
	$url = LOGIN_HOME.'/forget';
	$html = str_replace('${user}', $name, $html);
	$html = str_replace('${url}', $url, $html);
	$subject = '知富网注册成功';
	return send_gmail($subject, $html, $email, $name);
}