<?php

class Word extends Model{

	public static $TREE_KEY = 'SENSITIVE_TRIE_TREE';
	public $table = 'words';
	
	public function check(&$data, array $ignore = array()){
		$check_arrays = array(
			'need' => array('name'),
			'length' => array('name'=>250),
			'int' => array(),
		);
		$errors = &parent::check($data, $check_arrays, $ignore);
		return $errors;
	}
	
	public function escape(&$data, array $ignore = array()){
		$escape_array = array(
			'string'=>array('name'),
			'url'=>array(),
			'html'=>array()
		);
		return parent::escape($data, $escape_array, $ignore);
	}
	
	public function build(){
		$words = $this->get_list();
		$TrieTree = new TrieTree();
		foreach($words as $word){
			$TrieTree->insert($word->name);
		}
		Option::persist(Word::$TREE_KEY, $TrieTree->export());
	}
	
	public function save($data){
		$new_word = $data['name'];
		if(isset($data['id'])){
			$word = $this->get($data['id']);
			$old_word = $word->name;
			if($new_word == $old_word){
				parent::save($data);
				return;
			}
		}
		$trie_tree = new TrieTree();
		$tree_str = Option::find(Word::$TREE_KEY);
		if($tree_str){ 
			$trie_tree->import($tree_str);
		}
		if(isset($old_word)){
			$trie_tree->remove($old_word);
		}
		$trie_tree->insert($new_word);
		Option::persist(Word::$TREE_KEY, $trie_tree->export());
		parent::save($data);
	}
	
	public function delete($id_or_array){
		if(is_array($id_or_array)){
			$list = $this->get_list(array('id in'=>$id_or_array));
		}
		else if(is_string($id_or_array)){
			$list = $this->get_list(array('id'=>$id_or_array));
		}
		$trie_tree = new TrieTree();
		$tree_str = Option::find(Word::$TREE_KEY);
		if($tree_str){ 
			$trie_tree->import($tree_str);
		}
		foreach($list as $word){
			$trie_tree->remove($word->name);
		}
		Option::persist(Word::$TREE_KEY, $trie_tree->export());
		parent::delete($id_or_array);
	}
	
	public function check_word($word){
		if(empty($word)){
			return true;
		}
		$tree_str = Option::find(Word::$TREE_KEY);
		if($tree_str){ 
			$trie_tree = new TrieTree();
			$trie_tree->import($tree_str);
			if($trie_tree->contain($word)){
				return false;
			}
			else{
				return true;
			}
		}
		return true;
	}

}