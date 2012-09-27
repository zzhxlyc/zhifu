<?php

class Option extends Model{

	public $table = 'options';
	public static $option;
	
	public static function get_instance(){
		if(!self::$option){
			self::$option = new Option();
		}
		return self::$option;
	}
	
	public static function persist_array($key, $value){
		self::persist($key, serialize($value));
	}
	
	public static function persist($key, $value){
		$option = self::get_instance();
		$count = $option->count(array('key'=>$key));
		if($count == 0){
			$option->save(array('key'=>$key, 'value'=>$value));
		}
		else{
			$option->update(array('value'=>$value), array('key'=>$key));
		}
	}
	
	public static function find_array($key){
		return unserialize(self::find($key));
	}
	
	public static function find($key){
		$option = self::get_instance();
		$obj = $option->get_row(array('key'=>$key));
		if($obj){
			return $obj->value;
		}
		else{
			return '';
		}
	}
	

}