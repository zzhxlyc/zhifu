<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">科技视频</a> >
	<a><?php echo $video->title?></a>
</div>

<h3><?php echo $video->title?></h3>

<div class="meta">
	<span>
		<label for="desc">发布者</label>
		<?php output_author_link2($video->belong, $video->type, $video->username)?>
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
<div class="meta">
	<span>
		<label for="desc">简介</label>
		<?php echo $video->desc?>
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
