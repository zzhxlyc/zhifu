<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<form action="<?php echo $home.'/edit?id='.$article->id?>" method="post" <?php $HTML->file_form_need()?> >

<div class="row">
	<label for="name">标题</label>
	<input size="100" type="text" name="title" value="<?php echo $article->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
	
<div class="row">
	<label for="">内容</label><span class="error"><?php echo $errors['content']?></span><br/><br/>
	<textarea class="ckeditor" name="content" rows="10" cols="80"><?php echo $article->content?></textarea>
</div>

<div class="row">
	<label for="">类型</label>
	<input type="radio" name="type" value="0" <?php $HTML->checked(0, $article->type)?> /> 普通
	<input type="radio" name="type" value="1" <?php $HTML->checked(1, $article->type)?> /> 特殊
</div>

<div class="row">
	<label for="">图片</label>
	<?php if($article->image){?>
	<img alt="" src="<?php img($article->image)?>" width="200">
	<?php }else{?>
	还没有图片
	<?php }?>
</div>
<div class="row">
	<label for="">修改图片</label>
	<input type="file" name="image" />
	<span class="error"><?php echo $errors['image']?></span>
</div>

<div class="row">
	<label for="">附件</label>
	<?php if($article->file){?>
	<a target="_blank" href="<?php echo UPLOAD_HOME."/$article->file"?>">点击下载</a>
	<?php }else{?>
	还没有附件
	<?php }?>
</div>
<div class="row">
	<label for="">修改附件</label>
	<input type="file" name="file" />
	<span class="error"><?php echo $errors['file']?></span>
</div>

<div class="row">
	<input type="submit" value="修改" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<?php echo $HTML->hidden('id', $article->id)?>
</div>

</form>
<?php 
	}
?>