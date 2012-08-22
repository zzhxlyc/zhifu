<div class="sidebar">

	<div class="detail-profile">
		<img src="<?php img($Article->image, $Article->default_image())?>" alt="<?php echo $Article->title?>" width="180" height="150"/>
	</div><!--end for detail-profile-->
	
</div><!--end for sidebar-->

<div class="main-content">
	
	<div class="section">
		<h3><?php echo $Article->title?></h3>
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
