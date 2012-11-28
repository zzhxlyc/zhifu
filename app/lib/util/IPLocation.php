<?php

class IPLocation{
	
	public static function get_from_taobaoip($ip){
		if($ip == '::1'){
			return false;
		}
		$api_url = "http://ip.taobao.com/service/getIpInfo.php?ip=$ip";
		$content = file_get_contents($api_url);
		if($content){
			$json = json_decode($content);
			if($json->code == 0){
				$data = $json->data;
				$ret = array();
				$ret['country'] = $data['country'];
				$ret['area'] = $data['area'];
				$ret['region'] = $data['region'];
				$ret['city'] = $data['city'];
				$ret['isp'] = $data['isp'];
				$ret['ip'] = $data['ip'];
				return $ret;
			}
		}
		return false;
	}
	
	public static function get_district($ip){
		$ipinfo = self::get_from_taobaoip($ip);
		$ret = array();
		if($ipinfo){
			if($ipinfo['country'] == '中国'){
				$ret['dis1'] = $ipinfo['region'];
				$ret['dis2'] = $ipinfo['city'];
			}
			else{
				$ret['dis1'] = $ipinfo['country'];
				$ret['dis2'] = $ipinfo['region'];
			}
		}
		else{
			$ret['dis1'] = '';
			$ret['dis2'] = '';
		}
		return $ret;
	}
	
}
