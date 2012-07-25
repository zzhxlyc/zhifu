<?php

class AjaxController extends AppController {
	
	public $models = array('Word');
	
	public function before(){
		$this->layout('ajax');
	}
	
	public function checkword(){
		$word = '';
		if(!empty($this->request->post['word'])){
			$word = $this->request->post['word'];
		}
		if(!empty($this->request->get['word'])){
			$word = $this->request->get['word'];
		}
		if($this->Word->check_word($word)){
			echo 0;	//ok
		}
		else{
			echo 1;	// sensitive
		}
	}
	
}