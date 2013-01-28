<?php

include(LIB_UTIL_DIR.'/VideoUrlParser.class.php');

class Video extends AppModel{

	public $table = 'videos';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('title', 'url', 'category'),
			'length' => array('desc'=>500),
			'int' => array('belong'),
			'word'=> array('title', 'desc'),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('title', 'desc'),
			'url'=>array('url'),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function click_up(){
		$this->update(array('click eq'=>'click + 1'), array('id'=>$this->id));
	}
	
	/**
	 * http://v.youku.com/v_show/id_XNDIxODQ4NTUy.html
	 * http://www.tudou.com/listplay/aAMUFQNfZnY.html
	 * http://www.56.com/u54/v_Njk2MTQ3MzE.html
	 * http://v.ku6.com/special/show_6578341/-52JhEcphBAgLebS1euDWw...html
	 * http://v.ku6.com/show/22qrof93nfp4_YttqeeiYg...html
	 * http://video.sina.com.cn/p/news/w/v/2012-06-29/224261791967.html
	 * http://v.qq.com/cover/p/pgw3kj13t58x8kc.html
	 * http://tv.sohu.com/20120629/n346910297.shtml/index.shtml
	 */
	public static function get_image($url){
		if($url){
			$data = VideoUrlParser::parse($url);
			$image_url = $data['img'];
			if($image_url){
				$ext = FileSystem::get_ext($image_url);
				if($ext === '') $ext = null;
				$path = FileSystem::gen_upload_path(null, $ext);
//				exit($image_url.'<br>'$path);
				FileSystem::save_url_file($image_url, $path);
				return $path;
			}
		}
		return null;
	}
	
	public function show_image(){
		if($this->image){
			return $this->image;
		}
		else{
			return '';
		}
	}
	
	public static function default_image(){
		return IMAGE_HOME.'/default.jpg';
	}

}