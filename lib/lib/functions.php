<?php

function p($text, $exit = true){
	if($exit){
		header('Content-Type: text/plain');
	}
	print_r($text);
	if($exit){
		exit;
	}
}

function dump_sql(){
	global $DB;
	$sqls = $DB->sql_list;
	foreach($sqls as $sql){
		echo '<p>'.$sql.'</p>';
	}
}