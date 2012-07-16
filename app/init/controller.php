<?php

App::load('util', 'TrieTree');
App::load('util', 'FileSystem');

class InitController extends Controller{
	
	public $models = array('Admin');
	
	public function index(){
		if($this->Admin->count() == 0){
			$admin = array('user'=>'root', 'password'=>md5('123'), 
							'time'=>DATETIME, 'flag'=>1, 'limit'=>65535);
			$this->Admin->save($admin);
		}
	}
	
	public function test(){
//		$this->trie();
		$this->file();
	}
	
	public function file(){
		$s = 'http://img1.c2.ku6.cn/20086/26/15/134033092807028402/1.jpg';
		$path = FileSystem::gen_upload_path($s);
		FileSystem::save_url_file($s, $path);
	}
	
	function save(){
		$path = UPLOAD_DIR.'/'.FileSystem::gen_file_name();
		echo $path;
		$url = 'http://g1.ykimg.com/1100641F464DD37D68F073003AE1A1E6E84908-F067-33D3-6FEC-5615F851AA70';
		FileSystem::save_url_file($url, $path);
	}
	
	function trie(){
		$tree = new TrieTree();
//		$tree->insert('柳云超');
//		$tree->insert('柳云超');
//		$tree->insert('朱丽');
//		$tree->insert('柳树');
//		$tree->insert('abc');
//		$tree->insert('柳a');
		print_r($tree->tree);
		echo '<br>';
		$tree->remove('柳云');
//		$tree->remove('朱丽');
		print_r($tree->tree);
//		echo $tree->find('柳树');
//		echo $tree->find('柳云超');
//		echo $tree->find('柳a');
//		echo $tree->find('朱丽');
//		echo $tree->find('abc');
//		echo $tree->find('柳') ? '1' : '0';
//		echo $tree->find('柳b') ? '1' : '0';
//		echo $tree->find('ac') ? '1' : '0';
//		echo $tree->find('a') ? '1' : '0';
//		$s = 'abaca';
//		$s = '柳朱丽朱丽柳树aabfabc柳柳柳柳树';
//		$r = $tree->contain($s, 1);
//		echo $r ? $r : '0';
	}
	
}