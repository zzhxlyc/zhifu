<?php include('sidebar.php')?>

<div class="main-content">
	
	<div class="section">
		<h3>
			<?php echo $Item->title?>
			<a class="edit"><?php echo $Item->get_status()?></a>
		</h3>
		<div class="content line-list">
			<?php echo $Item->description?>
		</div><!--end for list-->
		<?php if($Item->file){?>
		<div class="row">
			<label for="">附件</label>
			<a target="_blank" href="<?php echo UPLOAD_HOME.'/'.$Item->file?>">下载</a>
		</div>
		<?php }?>
		<?php if(is_expert_object($User, $Item)){?>
		<div>
			<input type="button" value="修改" class="btn fl" 
	onclick="location.href='<?php echo $home."/itemedit?problem=$Problem->id&item=$Item->id"?>'">
		</div>
		<?php }?>
		<?php 
			if(is_company_object($User, $Problem) && (!$choosed || $Item->status == 1)){
				if($Item->status == 0){
					$submit = '选择';
					$type = 0;
				}
				else{
					$submit = '取消选择';
					$type = 1;
				}
		?>
		<div>
			<form action="<?php echo $home.'/choose'?>" method="post">
				<input type="hidden" name="problem" value="<?php echo $Problem->id?>" />
				<input type="hidden" name="item" value="<?php echo $Item->id?>" />
				<input type="hidden" name="type" value="<?php echo $type?>" />
				<input type="submit" value="<?php echo $submit?>" class="btn fl" />
			</form>
		</div>
		<?php }?>
		<a href="<?php echo $home.'/detail?id='.$Problem->id?>" class="back-btn">返回</a>
	</div><!--end for section-->	
	
	
</div><!--end for main-content-->
