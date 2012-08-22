<?php include('sidebar.php');?>

<div class="main-content">
	
	<?php 
		if($closed){
	?>
	<p>已停止提交</p>
	<a href="<?php echo $home.'/detail?id='.$Idea->id?>" class="back-btn">返回</a>
	<?php }else{?>
	<div class="section">
		<h3>我的创意</h3>
		<div class="content line-list">
			<form action="" method="post">
<div class="row">
	<label for="name">创意</label>
	<input size="70" type="text" name="title" value="<?php echo $Item->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="">详细描述</label><span class="error"><?php echo $errors['content']?></span><br/><br/>
	<textarea class="ckeditor" name="content" rows="10" cols="80"><?php echo $Item->content?></textarea>
</div>
<div class="row">
	<input type="submit" value="保存" class="btn fl">
	<input type="hidden" name="idea" value="<?php echo $Idea->id?>">
	<input type="hidden" name="item" value="<?php echo $Item->id?>">
	<a href="<?php echo $home."/item?idea=$Idea->id&item=$Item->id"?>" class="back-btn">返回</a>
</div>
			</form>
		</div><!--end for list-->
	</div><!--end for section-->	
	<?php }?>
	
</div><!--end for main-content-->