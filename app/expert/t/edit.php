<?php 
	if($error){
		output_error($error, $home);
	}
	else{
?>
<form action="<?php echo $home.'/edit?id='.$expert->id?>" method="post" <?php $HTML->file_form_need()?>>
<div class="row">
	<label for="name">姓名</label>
	<input size="50" type="text" name="name" value="<?php echo $expert->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>
<div class="row">
	<label for="name">邮箱</label>
	<input size="50" type="text" name="email" value="<?php echo $expert->email?>" />
	<span class="error"><?php echo $errors['email']?></span>
</div>
<div class="row">
	<label for="name">电话</label>
	<input size="50" type="text" name="phone" value="<?php echo $expert->phone?>" />
	<span class="error"><?php echo $errors['phone']?></span>
</div>
<div class="row">
	<label for="name">网址</label>
	<input size="50" type="text" name="url" value="<?php echo $expert->url?>" />
	<span class="error"><?php echo $errors['url']?></span>
</div>
<div class="row">
	<label for="name">职业</label>
	<input size="50" type="text" name="job" value="<?php echo $expert->job?>" />
	<span class="error"><?php echo $errors['job']?></span>
</div>
<div class="row">
	<label for="name">工作单位</label>
	<input size="50" type="text" name="workplace" value="<?php echo $expert->workplace?>" />
	<span class="error"><?php echo $errors['workplace']?></span>
</div>
<div class="row">
	<label for="tag">领域标签</label>
	<input size="20" type="text" value="" id="new-tag" /> 
	<a href="javascript:;" id="add-tag">添加</a>
</div>	

<div class="tag row">
	<label for="">标签</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a href="javascript:;" class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?><img src="<?php echo IMAGE_HOME?>/delete.png"></a>	
	<?php 
		}
	}
	?>
	<input type="hidden" name="new_tag" />
	<input type="hidden" name="old_tag" />
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
</div>
	
<div class="row">
	<label for="name">描述</label><br/><br/>
	<textarea class="ckeditor" name="description" rows="10" cols="80"><?php echo $expert->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
</div>

<div class="row">
	<label for="name">头像</label>
	<input type="file" name="image" />
	<?php if($expert->image){?>
	<img src="<?php img($expert->image)?>" />
	<?php }?>
</div>

<div class="row">
	<input type="submit" value="保存" />
	<?php echo $HTML->hidden('id', $expert->id)?>
</div>
</form>

<script type="text/javascript">
$(document).ready(function($){
	tagEventInit();
});	
</script>
<?php 
	}
?>