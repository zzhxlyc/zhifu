<?php

class StringUtils{
	
	public static function start_with($string, $search){
		return strpos($string, $search) === 0;
	}
	
}