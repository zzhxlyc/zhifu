<h2>发布视频</h2>

<form action="" method="post" <?php $HTML->file_form_need()?>>

<div class="row">
	<label for="">标题</label>
	<input class="text wide" type="text" name="title" value="<?php echo $video->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
	
</div>
<div class="row">
	<label for="desc">简介</label>
	<textarea name="desc" class="text" style="height: 50px"><?php echo $video->desc?></textarea>
	<span class="error"><?php echo $errors['desc']?></span>
</div>
<div class="row">
	<label for="">网址</label>
	<input class="text wide"  type="text" name="url" value="<?php echo $video->url?>" />
	<span class="error"><?php echo $errors['url']?></span>
</div>
<div class="row">
	<label for="desc">*</label>
	优酷的视频直接填写html地址即可，也不用填封面图片
</div>
<div class="row">
	<label for="">封面图</label>
	<input class="text wide"  type="text" name="image" value="<?php echo $video->image?>" />
	<span class="error"><?php echo $errors['image']?></span>
</div>
<div class="row">
	<label for="">上传封面图</label>
	<input type="file" name="image2" />
	<span class="error"><?php echo $errors['image2']?></span>
</div>

<div class="row">
	<label for="tag">领域标签</label>
	<input size="20" type="text" value="" class="text" id="new-tag" /> 
	<a href="javascript:;" id="add-tag">添加</a>
</div>	

<div class="tag row">
	<label for="">标签</label>
</div>

<div class="hot-tag row">
	<label for="">热门标签</label>
	<?php 
	if(is_array($most_common_tags)){
		foreach($most_common_tags as $tag){
	?>
		<a href="javascript:;" count="<?php echo $tag['count']?>" tagid="<?php echo $tag['id']?>" id="tag_<?php echo $tag['id']?>"><?php echo $tag['name']?></a>	
	<?php 
		}
	}
	?>
	<input type="hidden" name="new_tag" />
	<input type="hidden" name="old_tag" />
</div>


<div class="row">
	<input type="submit" class="btn fl" value="发布" />
</div>


</form>

<script type="text/javascript">
$(document).ready(function($){
	tagEventInit();
});	
</script>