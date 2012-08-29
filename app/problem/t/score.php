<?php include('sidebar.php')?>

<div class="main-content">
	
	<div class="section">
		<h3>中标方案：<?php echo $Item->title?></h3>
		<div class="content line-list">
			<?php echo $Item->description?>
		</div><!--end for list-->
	</div><!--end for section-->
	
	<?php if($User->is_company()){?>
	<div class="section">
		<h3>难题中标者：<?php echo $Expert->name?></h3>
	</div><!--end for section-->
	<?php }?>
	
	<?php if($User->is_expert()){?>
	<div class="section">
		<h3>难题发起者：<?php echo $Company->name?></h3>
	</div><!--end for section-->
	<?php }?>
	
	<div class="section">
		<h3>评分</h3>
		<div class="rating">
			<a href="javascript:;" rank="1"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star1" alt="" /></a>
			<a href="javascript:;" rank="2"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star2" alt="" /></a>
			<a href="javascript:;" rank="3"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star3" alt="" /></a>
			<a href="javascript:;" rank="4"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star4" alt="" /></a>
			<a href="javascript:;" rank="5"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star5" alt="" /></a>
			
			
		</div>
		
		<div>
			<select>
				<option value="">评分</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<form action="<?php echo $home.'/score'?>" method="post">
				<input type="hidden" name="id" value="<?php echo $Problem->id?>" />
				<input type="hidden" name="score" value="<?php echo $score?>" />
				<input type="submit" value="提交" class="btn fl" />
				<a href="<?php echo $home.'/detail?id='.$Problem->id?>" class="back-btn">返回</a>
			</form>
		</div>
	</div><!--end for section-->
	
</div><!--end for main-content-->


<script type="text/javascript">
	scoreEventInit();
	
	
</script>
