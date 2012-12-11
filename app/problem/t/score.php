<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">技术难题</a> >
	<a><?php echo $Problem->title?></a>
</div>

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
		<div class="content line-list">
			<?php echo $Expert->description?>
		</div><!--end for list-->
	</div><!--end for section-->
	<?php }?>
	
	<?php if($User->is_expert()){?>
	<div class="section">
		<h3>难题发起者：<?php echo $Company->name?></h3>
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
				<input type="hidden" name="id" value="<?php echo $Problem->id?>" />
				<input type="hidden" name="score" value="<?php echo $score?>" />
				<textarea rows="5" cols="60" name="comment"></textarea>
				<div>
					<input type="submit" value="提交" class="btn fl" />
					<a href="<?php echo $home.'/detail?id='.$Problem->id?>" class="back-btn">返回</a>
				</div>
				
				
			</form>
			<?php }else{?>
			<input type="hidden" name="score" value="<?php echo $score?>" />
			<p>评论：<?php echo $comment?></p>
			<?php }?>
		</div>
		<a href="<?php echo $home.'/detail?id='.$Problem->id?>" class="back-btn">返回</a>
	</div><!--end for section-->
	
</div><!--end for main-content-->


<script type="text/javascript">
	scoreEventInit();
</script>
