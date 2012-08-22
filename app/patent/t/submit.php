<?php include('sidebar.php');?>

<div class="main-content">

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