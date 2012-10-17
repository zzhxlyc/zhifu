
<div class="main-content">
	
	<div class="section">
		<h3><?php echo $Article->title?></h3>
		<span>发布人：管理员</span>
		<span>发布时间：<?php echo $Article->time?></span>
		<div class="content">
			<?php echo $Article->content?>
		</div>
		<div class="content">
			<?php if($Article->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Article->file"?>">点击下载</a>
			<?php }?>
		</div>
	</div>
	
</div><!--end for main-content-->
