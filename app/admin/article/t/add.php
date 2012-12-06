<form action="" method="post" <?php $HTML->file_form_need()?> >

<div class="row">
	<label for="name">标题</label>
	<input size="80" type="text" name="title" value="<?php echo $article->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
	
<div class="row">
	<label for="">内容</label><span class="error"><?php echo $errors['content']?></span><br/><br/>
	<textarea class="ckeditor" name="content" rows="10" cols="80"><?php echo $article->content?></textarea>
</div>

<div class="row">
	<label for="">修改图片</label>
	<input type="file" name="image" />
	<span class="error"><?php echo $errors['image']?></span>
</div>

<div class="row">
	<label for="">添加附件</label>
	<input type="file" name="file" />
	<span class="error"><?php echo $errors['file']?></span>
</div>

<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
</div>

</form>