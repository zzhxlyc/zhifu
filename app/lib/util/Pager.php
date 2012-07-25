<?php

class Pager{
	public static $start = 1;
	
	public $num;
	public $now;
	public $all;
	public $first;
	public $last;
	
	public function Pager($all, $now, $num){
		$this->all = $all;
		$this->first = self::$start;
		$this->num = $num;
		if($this->all % $this->num == 0){
			$this->last = $this->all / $this->num + self::$start - 1;
			if($this->last == 0){
				$this->last = 1;
			}
		}
		else{
			$this->last = intval($this->all / $this->num) + self::$start;
		}
		if(isset($now) && !empty($now) && is_int(intval($now))){
			if($now > $this->last){
				$this->now = $this->last;
			}
			else{
				$this->now = $now;
			}
		}
		else{
			$this->now = self::$start;
		}
	}
	
	public function get_limit_str(){
		$begin = $this->num * ($this->now - self::$start);
		return "$begin, $this->num";
	}
	
	public function get_page_links($base_url){
		if($this->all == 0){
			return array();
		}
		$page_url = $base_url.'page=';
		$all_page = $this->last - $this->first;
		$prev = $this->now == $this->first ? 1 : $this->now - 1;
		$next = $this->now == $this->last ? $this->last : $this->now + 1;
		$page_array = array(array('<', $prev, $page_url.$prev, 0));
		$begin = $this->now - 5 >= self::$start ? $this->now - 5 : self::$start;
		$end = $begin + 10 >= $this->last ? $this->last - 1 : $begin + 10;
		if($all_page <= 10){
			for($i = $this->first;$i <= $this->last;$i++){
				$page_array[] = array($i, $i, $page_url.$i, 0);
			}
		}
		else{
			if($begin > 1){
				$page_array[] = array($this->first, $this->first, $page_url.$this->first, 0);
				if($begin > 2){
					$page_array[] = array('...', '', '', 0);
				}
			}
			$page_array[] = array($begin, $begin, $page_url.$begin, 0);
			for($i = $begin + 1;$i <= $end;$i++){
				$page_array[] = array($i, $i, $page_url.$i, 0);
			}
			if($end != $this->last - 1){
				$page_array[] = array('...', '', '', 0);
			}
			$page_array[] = array($this->last, $this->last, $page_url.$this->last, 0);
		}
		for($i = 0;$i < count($page_array);$i++){
			if($page_array[$i][0] == $this->now){
				$page_array[$i][3] = 1;
			}
		}
		$page_array[] = array('>', $next, $page_url.$next, 0);
		return $page_array;
	}
	
	public static function output_pager_list($page_list, $anchor_id = ''){
		if(count($page_list) == 0){
			//echo '没有相关信息';
			return;
		}
		if(count($page_list) <= 3){
			return;
		}
		if($anchor_id == ''){
			$anchor = '';
		}
		else{
			$anchor = '#'.$anchor_id;
		}
		foreach($page_list as $page){
			list($show, $p, $link, $now) = $page;
			if(is_int($show)){
				if($now == 1){
					echo '<span class="current">'.$show.'</span>';
				}
				else {
					echo '<a href="'.$link.$anchor.'">'.$show.'</a>';
				}
			}
			else if($show == '...'){
				echo '<a>...</a>';
			}
			else{
				echo '<a href="'.$link.$anchor.'">'.$show.'</a>';
			}
		}
	}
	
	public static function output_page_form($base_url){
		$s = '<p>到第</p><input type="text" id="go_page" size="2" /><p>页</p> 
				<a href="javascript:void(0)" onclick="page_go(\''.$base_url.'\')">Go</a>';
		echo $s;
	}
}

