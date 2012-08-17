<?php

class AppController extends Controller{
	
	public function before(){
		if($this->is_set('home')){
			$this->set('index_page', $this->get('home').'/index');
		}
		$User = new Expert();
		$User->id = 1;
		$this->set('user', $User);
	}
	
	public function get_data(){
		if($this->request->post){
			return $this->request->post;
		}
		else{
			return $this->request->get;
		}
	}
	
	protected function upload_file($array){
		$path = FileSystem::gen_upload_path($array['name']);
		$save_path = FileSystem::get_save_path($path);
		move_uploaded_file($array['tmp_name'], $save_path);
		return $path;
	}
	
	protected function do_tag($object_id, $type, $old_tag, $new_tag){
		$tag_array = array();	// the now exist tag ids
		if(strlen($old_tag) > 0){
			$tag_array = split_ids($old_tag);
		}
		$tag_items = $this->TagItem->get_list(array('belong'=>$object_id, 'type'=>$type));
		$tag_old_array = get_attrs($tag_items, 'tag');	// the old exist tag ids
		$remove_tag_array = array_diff($tag_old_array, $tag_array);
		if(count($remove_tag_array) > 0){
			$tag_item_ids = array();
			foreach($tag_items as $old_tag){
				if(in_array($old_tag->tag, $remove_tag_array)){
					$tag_item_ids[] = $old_tag->id;
				}
			}
			$this->TagItem->delete($tag_item_ids);
		}
		$this->Tag->minus($remove_tag_array);
		
		$new_tag_array = array();
		$new_tag = trim($new_tag);
		if(strlen($new_tag) > 0){
			$new_tag_array = split_words($new_tag);
		}
		if($new_tag_array){
			$tags = $this->Tag->get_list(array('name in'=>$new_tag_array));
			$named_tags = array_to_map($tags, 'name');
			$plus_tag_array = array();
			foreach($new_tag_array as $tag_name){
				$tag_id = 0;
				if(!array_key_exists($tag_name, $named_tags)){
					$tag_data = array('name'=>$tag_name, 'count'=>1);
					$errors = $this->Tag->check($tag_data); 
					if(count($errors) == 0){
						$tag_id = $this->Tag->save($tag_data);
					}
				}
				else{
					$tag_id = $named_tags[$tag_name]->id;
				}
				if($tag_id > 0 && !in_array($tag_id, $tag_array)){
					$data = array('tag'=>$tag_id, 'belong'=>$object_id, 'type'=>$type);
					$count = $this->TagItem->count($data);
					if($count == 0){
						$this->TagItem->save($data);
						$plus_tag_array[] = $tag_id;
					}
				}
			}
			$this->Tag->plus($plus_tag_array);
		}
	}
	
}