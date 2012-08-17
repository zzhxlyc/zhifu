<?php

function img($image, $default = ''){
	if(!empty($image) && file_exists(UPLOAD_DIR.'/'.$image)){
		echo UPLOAD_HOME.'/'.$image;
	}
	else{
		echo $default;
	}
}

function download($file){
	echo UPLOAD_HOME.'/'.$file;
}

function output_error($error, $home){
	echo '<p>'.$error.'</p>';
	echo '<a href="'.$home.'">返回</a>';
}

function output_page_list($page_list, $anchor_id = ''){
	if(count($page_list) <= 3){
		return;
	}
	if($anchor_id == ''){
		$anchor = '';
	}
	else{
		$anchor = '#'.$anchor_id;
	}
	echo '<div class="pagenavi">'."\n";
	foreach($page_list as $page){
		list($show, $p, $link, $now) = $page;
		$link = $link.$anchor;
		if($show == '<'){
			echo '<a class="page-prev page-prev-abled" href="'.$link.'" title="'.$show.'"></a>';
		}
		else if($show == '>'){
			echo '<a class="page-next page-next-abled" href="'.$link.'" title="'.$show.'"></a>';
		}
		else if(is_int($show)){
			if($now == 1){
				echo '<span class="current" title="'.$show.'">'.$show.'</span>';
			}
			else {
				echo '<a title="'.$show.'" href="'.$link.'">'.$show.'</a>';
			}
		}
		else if($show == '...'){
			echo '<a>...</a>';
		}
		echo '&nbsp;'."\n";
	}
	echo '</div>'."\n";
	echo '<div id="goodslist2-page" class="pagenavi hidden"></div>'."\n";
}

function output_desc($desc){
	$d = strip_tags($desc);
	echo subString($d, 100);
}

function output_money($money){
	echo $money;
}