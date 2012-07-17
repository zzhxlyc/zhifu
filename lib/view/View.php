<?php

class View{
	public $title;
	public $charset;
	public $icon;
	public $layout;
	public $prefix_folder;
	public $module;
	public $template;
	public $template_abs;
	
	public $meta_array;
	public $js_array;
	public $css_array;
	
	public static $EXT = 'php';
	
	public function __construct(){
		$this->template_abs = false;
		$this->meta_array = array();
		$this->js_array = array();
		$this->css_array = array();
	}
	
	public function set_title($title){
		$this->title = $title;
	}
	
	public function set_layout($layout){
		$this->layout = $layout;
	}
	
	public function get_layout(){
		if(empty($this->layout)) return 'default';
		return $this->layout;
	}
	
	public function get_layout_file(){
		$layout = $this->get_layout();
		return LAYOUT_DIR."/$layout.".self::$EXT;
	}
	
	public function set_template($module, $template){
		if(empty($this->template)){
			$this->module = $module;
			$this->template = $template;
		}
	}
	
	public function set_template_direct($template){
		$this->template = $template;
		$this->template_abs = true;
	}
	
	public function get_template_dir(){
		if($this->template_abs){
			return basename($this->template_abs);
		}
		else{
			$pf = $this->prefix_folder;
			$m = $this->module;
			$t = $this->template;
			if(empty($pf)){
				return APP_DIR."/$m/t";
			}
			else{
				return APP_DIR."/$pf/$m/t";
			}
		}
	}
	
	public function get_template(){
		if($this->template_abs){
			return $this->template;
		}
		else{
			$pf = $this->prefix_folder;
			$m = $this->module;
			$t = $this->template;
			if(empty($pf)){
				return APP_DIR."/$m/t/$t.".self::$EXT;
			}
			else{
				return APP_DIR."/$pf/$m/t/$t.".self::$EXT;
			}
		}
	}
	
	public function title(){
		if($this->title){
			$this->before();
			echo "<title>$this->title</title>\n";
		}
	}
	
	public function charset(){
		if(empty($this->$charset)) $this->charset = 'utf-8';
		$this->before();
		echo '<meta http-equiv="Content-Type"'. 
				'content="text/html; charset='.$this->charset.'" />'."\n";
	}
	
	public function css($css){
		if(empty($css)) return;
		$css_url = CSS_HOME."/$css.css";
		$this->link('stylesheet', 'text/css', $css_url, null, 'all');
	}
	
	public function js($js){
		if(empty($js)) return;
		$this->before();
		$js_url = JS_HOME."/$js.js";
		echo '<script type="text/javascript" src="'.$js_url."\"></script>\n";
	}
	
	public function icon(){
		if($this->icon){
			$this->link('shortcut icon', 'image/x-icon', $this->icon);
		}
	}
	
	public function meta($name, $content){
		if($name){
			$this->before();
			echo '<meta name="'.$name.'" content="'.$content.'" />'."\n";
		}
	}
	
	public function link($rel, $type, $href, $title = null, $media = null){
		$s = '<link rel="'.$rel.'" type="'.$type.'"';
		$s .= " href=\"$href\"";
		if(!empty($title)){
			$s .= " title=\"$title\"";
		}
		if(!empty($media)){
			$s .= " media=\"$media\"";
		}
		$s .= " />\n";
		$this->before();
		echo $s;
	}
	
	public function add_js($js){
		$this->js_array[] = $js;
	}
	
	public function fetch_js(){
		foreach($this->js_array as $js){
			$this->js($js);
		}
	}
	
	public function add_css($css){
		$this->css_array[] = $css;
	}
	
	public function fetch_css(){
		foreach($this->css_array as $css){
			$this->css($css);
		}
	}
	
	public function set_keywords($keywords){
		if(is_string($keywords)){
			$this->add_meta('keywords', $keywords);
		}
		else if(is_array($keywords)){
			$s = implode(',', $keywords);
			$this->add_meta('keywords', $s);
		}
	}
	
	public function set_description($description){
		$this->add_meta('description', $description);
	}
	
	public function add_meta($name, $content){
		$this->meta_array[$name] = $content;
	}
	
	public function set_icon($url){
		$this->icon = $url;
	}
	
	public function fetch_meta(){
		foreach($this->meta_array as $name => $content){
			$this->meta($name, $content);
		}
	}
	
	public function before(){
		echo "\t";
	}
	
}