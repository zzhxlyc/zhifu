<h2>发表话题</h2>
<form action="" method="post">
<div class="row">
	<label for="">标题：</label>
	<input type="text" name="title" class="text wide" value="<?php echo $topic->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="des">内容：</label>
	<textarea name="content" class="text" ><?php echo $topic->content?></textarea>
	<span class="error"><?php echo $errors['content']?></span>
</div>

<div class="row button-area clearfix" >
	<input type="submit" value="发表" class="btn fl" /> 
	<a class="back-btn" href="<?php echo $home?>">返回</a>
</div>
</form>