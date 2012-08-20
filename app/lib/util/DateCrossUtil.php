<?php

class DateCrossUtil{
	
	public static $timezone = 8;
	const DAY_TS = 86400;
	const WEEK_TS = 604800;
	const HOUR_TS = 3600;
	
	private static function day_start($ts){
		$time = date('Y-m-d 00:00:00', $ts);
		return strtotime($time);
	}
	
	public static function set_timezone($tz){
		self::$timezone = $tz;
		if($tz == 8){
			date_default_timezone_set('Asia/Shanghai');
		}
		else if($tz > 0){
			date_default_timezone_set("Etc/GMT+".$tz);
		}
		else if($tz < 0){
			date_default_timezone_set("Etc/GMT-".$tz);
		}
	}
	
	public static function today($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		$from = self::day_start($ts);
		$to = $ts;
		if($return == 'str'){
			$from = date('Y-m-d H:i:s', $from);
			$to = date('Y-m-d H:i:s', $to);
		}
		return array($from, $to);
	}
	
	public static function yesterday_now($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		$time = self::day_start($ts);
		$from = $time - self::DAY_TS;
		$to = $ts - self::DAY_TS;
		if($return == 'str'){
			$from = date('Y-m-d H:i:s', $from);
			$to = date('Y-m-d H:i:s', $to);
		}
		return array($from, $to);
	}
	
	public static function yesterday($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		$time = self::day_start($ts);
		$from = $time - self::DAY_TS;
		$to = $time - 1;
		if($return == 'str'){
			$from = date('Y-m-d H:i:s', $from);
			$to = date('Y-m-d H:i:s', $to);
		}
		return array($from, $to);
	}
	
	public static function this_week($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		$week_day = idate('w', $ts);
		$from = self::day_start($ts) - ($week_day - 0) * self::DAY_TS;
		$to = $ts;
		if($return == 'str'){
			$from = date('Y-m-d H:i:s', $from);
			$to = date('Y-m-d H:i:s', $to);
		}
		return array($from, $to);
	}
	
	public static function last_week($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		$week_day = idate('w', $ts);
		$from = self::day_start($ts) - ($week_day - 0) * self::DAY_TS - self::WEEK_TS;
		$to = $from + self::WEEK_TS - 1;
		if($return == 'str'){
			$from = date('Y-m-d H:i:s', $from);
			$to = date('Y-m-d H:i:s', $to);
		}
		return array($from, $to);
	}
	
	public static function this_month($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		$month_day = idate('d', $ts);
		$from = self::day_start($ts) - ($month_day - 1) * self::DAY_TS;
		$to = $ts;
		if($return == 'str'){
			$from = date('Y-m-d H:i:s', $from);
			$to = date('Y-m-d H:i:s', $to);
		}
		return array($from, $to);
	}
	
	public static function last_month($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		$month_day = idate('d', $ts);
		$from_this_month = self::day_start($ts) - ($month_day - 1) * self::DAY_TS;
		$last_month_days = idate('t', $from_this_month - 1);
		$from = $from_this_month - self::DAY_TS * $last_month_days;
		$to = $from_this_month - 1;
		if($return == 'str'){
			$from = date('Y-m-d H:i:s', $from);
			$to = date('Y-m-d H:i:s', $to);
		}
		return array($from, $to);
	}
	
	public static function last_30_days($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		$day_start = self::day_start($ts);
		$to = $day_start - 1;
		$from = $day_start - 30 * self::DAY_TS;
		if($return == 'str'){
			$from = date('Y-m-d H:i:s', $from);
			$to = date('Y-m-d H:i:s', $to);
		}
		return array($from, $to);
	}
	
	public static function this_year($return = 'str', $ts = null){
		if($ts == ''){
			$ts = time();
		}
		if($return == 'str'){
			$year = idate('Y', $ts);
			$from = $year.'-01-01 00:00:00';
			$to = date('Y-m-d H:i:s', $ts);
		}
		else if($return == 'timestamp'){
			$days = idate('z', $ts);
			$from = self::day_start($ts) - $days * self::DAY_TS;
			$to = $ts;
		}
		return array($from, $to);
	}
	
}
