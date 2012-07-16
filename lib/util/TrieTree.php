<?php

App::load('util', 'UTF8Util');

class TrieTree{
	
	public $tree = array();
	
	public function insert($utf8_str){
		$chars = &UTF8Util::get_chars($utf8_str);
		$chars[] = null;
		$count = count($chars);
		$T = &$this->tree;
		for($i = 0;$i < $count;$i++){
			$c = $chars[$i];
			if(!array_key_exists($c, $T)){
				$T[$c] = array();
			}
			$T = &$T[$c];
		}
	}
	
	public function remove($utf8_str){
		$chars = &UTF8Util::get_chars($utf8_str);
		$chars[] = null;
		if($this->_find($chars)){
			$chars[] = null;
			$count = count($chars);
			$T = &$this->tree;
			for($i = 0;$i < $count;$i++){
				$c = $chars[$i];
				if(count($T[$c]) == 1){
					unset($T[$c]);
					return;
				}
				$T = &$T[$c];
			}
		}
	}
	
	private function _find(&$chars){
		$count = count($chars);
		$T = &$this->tree;
		for($i = 0;$i < $count;$i++){
			$c = $chars[$i];
			if(!array_key_exists($c, $T)){
				return false;
			}
			$T = &$T[$c];
		}
		return true;
	}
	
	public function find($utf8_str){
		$chars = &UTF8Util::get_chars($utf8_str);
		$chars[] = null;
		return $this->_find($chars);
	}
	
	public function contain($utf8_str, $do_count = 0){
		$chars = &UTF8Util::get_chars($utf8_str);
		$chars[] = null;
		$len = count($chars);
		$Tree = &$this->tree;
		$count = 0;
		for($i = 0;$i < $len;$i++){
			$c = $chars[$i];
			if(array_key_exists($c, $Tree)){	//起始字符匹配
				$T = &$Tree[$c];
				for($j = $i + 1;$j < $len;$j++){
					$c = $chars[$j];
					if(array_key_exists(null, $T)){
						if($do_count){
							$count++;
						}
						else{
							return true;
						}
					}
					if(!array_key_exists($c, $T)){
						break;
					}
					$T = &$T[$c];
				}
			}
		}
		if($do_count){
			return $count;
		}
		else{
			return false;
		}
	}
	
	public function contain_all($str_array){
		foreach($str_array as $str){
			if($this->contain($str)){
				return true;
			}
		}
		return false;
	}
	
	public function export(){
		return serialize($this->tree);
	}
	
	public function import($str){
		$this->tree = unserialize($str);
	}
	
}