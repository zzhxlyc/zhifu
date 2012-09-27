<?php

function async_http_get($url){
	$ret = parse_url($url);
	$scheme = $ret['scheme'];
	$host = $ret['host'];
	$path = $ret['path'];
	if($scheme == 'http'){
	    $fp = fsockopen($host, 80, $errno, $errstr, 30);
	    if ($fp) {
		    $out = "GET $path HTTP/1.1\r\n";
		    $out .= "Host: $host\r\n";
		    $out .= "Connection: Close\r\n";
		    $out .= "Cookie: $cookie\r\n\r\n";
		    $out .= $params;
		    fwrite($fp, $out);  
		    fclose($fp);
	    }
	}
}