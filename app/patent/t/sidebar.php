<div class="sidebar">

	<div class="detail-profile">
		<img src="<?php img($Patent->image, $Patent->default_image())?>" alt="<?php echo $Patent->title?>" width="180" height="150"/>
		<p><?php echo $Patent->title?></p>
		<p>专利号：<?php echo $Patent->pid?></p>
		<p>金额：<span class="price"><?php output_money($Patent->budget)?>万元</span></p>
		<?php if(isset($Patent->province)){?>
		<p>地区：<?php output_pcd($Patent)?></p>
		<?php }?>
		<?php if(isset($Patent->deadline)){?>
		<p><?php output_deadline($Patent->deadline)?></p>
		<?php }?>
	</div><!--end for detail-profile-->
	
	<div class="side-section">
		<div class="title">发起者</div>
		<div class="content">
			<a href="<?php echo EXPERT_HOME.'/profile?id='.$Patent->expert?>">
				<?php echo $Patent->author?></a>
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