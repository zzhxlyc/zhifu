<?php include('sidebar.php')?>

<div class="main-content">

	<?php 
		if($closed){
	?>
	<p>已停止提交</p>
	<a href="<?php echo $home.'/detail?id='.$Problem->id?>" class="back-btn">返回</a>
	<?php }else{?>
	<div class="section">
		<h3>修改竞标方案</h3>
		<div class="content line-list">
			<form action="" method="post" <?php $HTML->file_form_need()?>>
<div class="row">
	<label for="name">方案</label>
	<input size="70" type="text" name="title" value="<?php echo $Item->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="">详细描述</label><span class="error"><?php echo $errors['description']?></span><br/><br/>
	<textarea class="ckeditor" name="description" rows="10" cols="80"><?php echo $Item->description?></textarea>
</div>
<?php if($Item->file){?>
<div class="row">
	<label for="">附件</label>
	<a target="_blank" href="<?php echo UPLOAD_HOME.'/'.$Item->file?>">下载</a>
</div>
<?php }?>
<div class="row">
	<label for="">新附件</label>
	<input type="file" name="file" />
	<span class="error"><?php echo $errors['file']?></span>
</div>
<div class="row">
	<input type="submit" value="提交" class="btn fl">
	<input type="hidden" name="problem" value="<?php echo $Problem->id?>">
	<input type="hidden" name="item" value="<?php echo $Item->id?>">
	<a href="<?php echo $home."/item?problem=$Problem->id&item=$Item->id"?>" class="back-btn">返回</a>
</div>
			</form>
		</div><!--end for list-->
	</div><!--end for section-->	
	<?php }?>
	
</div><!--end for main-content-->