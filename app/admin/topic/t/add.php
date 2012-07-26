<form action="" method="post" >
<div class="row">
	<label for="name">标题</label>
	<input size="100" type="text" name="title" value="<?php echo $topic->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="">内容</label><br/><br/>
	<textarea class="ckeditor" name="content" rows="10" cols="80"><?php echo $topic->content?></textarea>
	<span class="error"><?php echo $errors['content']?></span>
</div>
<div class="row">
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
</div>
</form>