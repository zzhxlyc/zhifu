<?php

class AppModel extends Model{
	
	public function check(&$data, array $check_arrays, array $ignore = array()){
		$errors = &parent::check($data, $check_arrays);
		if(count($errors) == 0 && array_key_exists('word', $check_arrays)){
			$field_array = $check_arrays['word'];
			$tree_str = Option::find(Word::$TREE_KEY);
			if($tree_str){ 
				$trie_tree = new TrieTree();
				$trie_tree->import($tree_str);
				foreach($field_array as $field){
					$str = $this->_check_get_value($data, $field);
					if($trie_tree->contain($str)){
						$errors[$field] = '含有非法词汇';
						break;
					}
				}
			}
		}
		return $errors;
	}
	
	public function check_file($array, array $ext_array = array()){
		$error = '';
		$ext = FileSystem::get_ext($array['name']);
		if(count($ext_array) == 0){
			$ext_array = array('doc', 'docx', 'xls', 'xlsx', 
								'ppt', 'pptx', 'txt', 'zip', 'rar', 
								'pdf', 'jpg', 'png', 'bmp', 'gif');
		}
		if(!in_array($ext, $ext_array)){
			$error = '文件格式不允许';
		}
		if($array['size'] >= 2 * 1024 * 1024){
			$error = '文件不能大于2M';
		}
		return $error;
	}
	
}