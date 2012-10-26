<?php include('sidebar.php')?>

<div class="main-content">
	
	<div class="section">
		<h3>中标方案：<?php echo $Item->title?></h3>
		<div class="content line-list">
			<?php echo $Item->content?>
		</div><!--end for list-->
	</div><!--end for section-->
	
	<?php if($User->is_expert()){?>
	<div class="section">
		<h3>创意发起者：<a href="<?php echo get_user_link($Company)?>"><?php echo $Company->username?></a></h3>
		<div class="content line-list">
			<?php echo $Company->description?>
		</div><!--end for list-->
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
			<?php if(!$score){?>
			<form action="<?php echo $home.'/score'?>" method="post">
				<input type="hidden" name="id" value="<?php echo $Idea->id?>" />
				<input type="hidden" name="score" value="<?php echo $score?>" />
				<textarea rows="5" cols="60" name="comment"></textarea>
				<input type="submit" value="提交" class="btn fl" />
			</form>
			<?php }else{?>
			<p>评论：<?php echo $comment?></p>
			<input type="hidden" name="score" value="<?php echo $score?>" />
			<?php }?>
			<a href="<?php echo $home.'/detail?id='.$Idea->id?>" class="back-btn">返回</a>
		</div>
	</div><!--end for section-->
	
</div><!--end for main-content-->


<script type="text/javascript">
	scoreEventInit();
</script>
