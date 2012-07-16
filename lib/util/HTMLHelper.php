<?php

class HTMLHelper{
	
	public function file_form_need(){
		echo 'enctype="multipart/form-data"';
	}
	
	public function nbsp($n){
		$s = '';
		for($i = 0;$i < $n;$i++){
			$s .= '&nbsp;';
		}
		echo $s;
	}
	
	public function text($name, $value = null, $id = null){
		$v = $_id = '';
		if($value){
			$v = " value=\"$value\"";
		}
		if($id){
			$_id = " id=\"$id\"";
		}
		$s = "<input$_id type=\"text\" name=\"$name\"$v>";
		echo $s;
	}
	
	public function hidden($name = null, $value = null, $id = null){
		if($id || $name){
			$v = $_id = '';
			if($value){
				$v = " value=\"$value\"";
			}
			if($id){
				$_id = " id=\"$id\"";
			}
			$s = "<input$_id type=\"hidden\" name=\"$name\"$v>";
			echo $s;
		}
	}
	
	public function checked($now, $value){
		if($now == $value){
			echo 'checked="checked"';
		}
	}
	
	public function selected($now, $value){
		if($now == $value){
			echo 'selected="selected"';
		}
	}
	
	public function select_year($value, $begin = 1978, $end = 2030){
		for($year = $begin;$year <= $end;$year++){
			if(intval($value) == $year){
				printf('<option value="%d" selected="selected">%d</option>', $year, $year);
			}
			else{
				printf('<option value="%d">%d</option>', $year, $year);
			}
		}
	}
	
	public function select_month($value){
		for($month = 1;$month <= 12;$month++){
			if(intval($value) == $month){
				printf('<option value="%d" selected="selected">%d</option>', $month, $month);
			}
			else{
				printf('<option value="%d">%d</option>', $month, $month);
			}
		}
	}
	
	public function select_day($value){
		for($day = 1;$day <= 31;$day++){
			if(intval($value) == $day){
				printf('<option value="%d" selected="selected">%d</option>', $day, $day);
			}
			else{
				printf('<option value="%d">%d</option>', $day, $day);
			}
		}
	}
}