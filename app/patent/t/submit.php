<?php include('sidebar.php');?>

<div class="main-content">

	<div class="section">
		<h3>专利介绍</h3>
		<div class="content">
			<?php echo $Patent->description?>
		</div>
		<div class="content">
			<?php if($Patent->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Patent->file"?>">点击下载</a>
			<?php }?>
		</div>
	</div>	

	<div class="section">
		<h3>购买专利</h3>
		<div class="content line-list">
			<form action="" method="post">
		<input type="submit" value="提交" class="btn fl">
		<input type="hidden" name="id" value="<?php echo $Patent->id?>">
		<a href="<?php echo $home.'/detail?id='.$Patent->id?>" class="back-btn">返回</a>
			</form>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	
</div><!--end for main-content-->