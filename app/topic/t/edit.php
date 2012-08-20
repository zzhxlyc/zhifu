<h2>修改话题</h2>
<form action="" method="post">
<?php if($topic->parent == 0){?>
<div class="row">
	<label for="">标题：</label>
	<input type="text" name="title" class="text wide" value="<?php echo $topic->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<?php }?>
<div class="row">
	<label for="des">内容：</label>
	<textarea name="content" class="text" ><?php echo $topic->content?></textarea>
	<span class="error"><?php echo $errors['content']?></span>
</div>

<div class="row button-area clearfix" >
	<input type="hidden" name="id" value="<?php echo $topic->id?>" />
	<input type="submit" value="保存" class="btn fl" /> 
	<a class="back-btn" href="<?php echo $back_url?>">返回</a>
</div>
</form>