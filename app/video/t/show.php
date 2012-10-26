<h3><?php echo $video->title?></h3>

<div class="meta">
	<span>
		<label for="desc">发布者</label>
		<a target="_blank" href="<?php echo get_author_link($video->belong, $video->type)?>"><?php echo $video->username?></a>
	</span>
	<span>
		<label for="desc">发布时间</label>
		<?php echo $video->time?>
	</span>
	<span>
		<label for="desc">点击次数</label>
		<?php echo $video->click?>
	</span>
	<span>
		<label for="">标签</label>
		<?php 
		if(is_array($tag_list)){
			foreach($tag_list as $tag){
		?>
			<a count="<?php echo $tag->count?>" tagid="<?php echo $tag->id?>"><?php echo $tag->name?></a>	
		<?php 
			}
		}
		?>
	</span>
	
</div>


<div class="single-video">
	<embed src="<?php echo $video->url?>" 
		allowfullscreen="false" quality="high" width="600" height="500" 
		align="middle" allowscriptaccess="always" 
		type="application/x-shockwave-flash" />
</div>

<?php comment_div($comments, $links, $video, BelongType::VIDEO, $User)?>

<div><a href="<?php echo $home?>">返回视频列表</a></div>

<?php comment_js()?>
