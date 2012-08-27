<div class="sidebar">

	<div class="detail-profile">
		<img src="<?php img($Problem->image, $Problem->default_image())?>" 
			alt="<?php echo $Problem->title?>" width="180" height="135"/>
		<p><?php echo $Problem->title?></p>
		<p>金额：<span class="price"><?php output_money($Problem->budget)?>万元</span></p>
		<?php if(isset($Problem->province)){?>
		<p>地区：<?php output_pcd($Problem)?></p>
		<?php }?>
		<?php if(isset($Problem->deadline)){?>
		<p><?php output_deadline($Problem->deadline)?></p>
		<?php }?>
	</div><!--end for detail-profile-->
	
	<div class="side-section">
		<div class="title">发起者</div>
		<div class="content">
			<a href="<?php echo COMPANY_HOME.'/profile?id='.$Problem->company?>">
				<?php echo $Problem->author?></a>
		</div>
	</div><!--end for tag-->
	
	<div class="side-section">
		<div class="title">领域标签</div>
		<div class="content">
			<?php foreach($tags as $tag){?>
			<span class="item"><?php echo $tag->name?></span>
			<?php }?>
		</div>
	</div>
	
</div><!--end for sidebar-->