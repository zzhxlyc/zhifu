<?php

function p($text, $exit = true){
	header('Content-Type: text/plain');
	print_r($text);
	if($exit){
		exit;
	}
}