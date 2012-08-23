
<div class="main-content">

	<div class="section">
		<h3>发送站内信</h3>
		<div class="content line-list">
			<form action="" method="post">
<div class="row">
	<label for="name">收信人</label>
	<input size="30" type="text" name="user" value="<?php echo $user?>" />
	<span class="error"><?php echo $errors['user']?></span>
</div>
<div class="row">
	<label for="name">标题</label>
	<input size="70" type="text" name="title" value="<?php echo $message->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="">内容</label>
	<textarea name="content" rows="10" cols="80"><?php echo $message->content?></textarea>
	<span class="error"><?php echo $errors['content']?></span>
</div>
<div class="row">
	<input type="submit" value="发送" class="btn fl">
	<input type="hidden" name="id" value="<?php echo $Problem->id?>">
	<a href="javascript:void(0)" onclick="close()" class="back-btn">关闭</a>
</div>
			</form>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	
</div><!--end for main-content-->