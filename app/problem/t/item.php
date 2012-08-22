<?php include('sidebar.php')?>

<div class="main-content">
	
	<div class="section">
		<h3><?php echo $Item->title?></h3>
		<div class="content line-list">
			<?php echo $Item->description?>
		</div><!--end for list-->
		<div>
			<input type="button" value="修改" class="btn fl" onclick="location.href='<?php echo $home."/itemedit?problem=$Problem->id&item=$Item->id"?>'">
			<a href="<?php echo $home.'/detail?id='.$Problem->id?>" class="back-btn">返回</a>
		</div>
		<div>
			<form action="<?php echo $home.'/choose'?>" method="post">
				<input type="hidden" name="problem" value="<?php echo $Problem->id?>" />
				<input type="hidden" name="item" value="<?php echo $Item->id?>" />
				<input type="submit" value="选择" class="btn fl" />
			</form>
		</div>
	</div><!--end for section-->	
	
	
</div><!--end for main-content-->
