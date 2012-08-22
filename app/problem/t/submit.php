<?php include('sidebar.php')?>

<div class="main-content">

	<div class="section">
		<h3>解决难题</h3>
		<div class="content line-list">
			<form action="" method="post">
<div class="row">
	<label for="name">方案</label>
	<input size="70" type="text" name="title" value="<?php echo $solution->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="">详细描述</label><span class="error"><?php echo $errors['description']?></span><br/><br/>
	<textarea class="ckeditor" name="description" rows="10" cols="80"><?php echo $solution->description?></textarea>
</div>
<div class="row">
	<input type="submit" value="提交" class="btn fl">
	<input type="hidden" name="id" value="<?php echo $Problem->id?>">
	<a href="<?php echo $home.'/detail?id='.$Problem->id?>" class="back-btn">返回</a>
</div>
			</form>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	
</div><!--end for main-content-->