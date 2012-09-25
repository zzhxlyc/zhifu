<div class="sidebar">

	<div class="detail-profile">
		<img src="<?php img($Patent->image, $Patent->default_image())?>" alt="<?php echo $Patent->title?>" width="180" height="135"/>
		<p><?php echo $Patent->title?></p>
		<p>专利号：<?php echo $Patent->pid?></p>
		<p>金额：<span class="price"><?php output_money($Patent->budget)?>万元</span></p>
		<?php if(!empty($Patent->cat_name)){?>
		<p>类别：<?php echo $Patent->cat_name?> <?php echo $Patent->subcat_name?></p>
		<?php }?>
		<?php if(isset($Patent->province)){?>
		<p>地区：<?php output_pcd($Patent)?></p>
		<?php }?>
		<?php if(isset($Patent->deadline)){?>
		<p><?php output_deadline($Patent->deadline)?></p>
		<?php }?>
		<p>电话：<?php echo $Patent->phone?></p>
		<p>手机：<?php echo $Patent->mobile?></p>
		<p>邮箱：<?php echo $Patent->email?></p>
		<p>网址：<?php echo $Patent->url?></p>
		<p>适用分类：<?php echo $Patent->app_tostring()?></p>
		<p>技术成熟度：<?php echo $Patent->skill_tostring()?></p>
		<p>专利类型：<?php echo $Patent->example_tostring()?></p>
		<p>有无样品：<?php echo $Patent->kind_tostring()?></p>
		<p>转让方式：<?php echo $Patent->transfer_tostring()?></p>
		<p>所有人性质：<?php echo $Patent->owner_tostring()?></p>
		<p>发布时间：<?php echo get_date($Patent->time)?></p>
		<p>最后修改时间：<?php echo get_date($Patent->lastmodify)?></p>
	</div><!--end for detail-profile-->
	
	<div class="side-section">
		<div class="title">所有者</div>
		<div class="content">
			<a href="<?php echo EXPERT_HOME.'/profile?id='.$Patent->expert?>">
				<?php output_username($Patent)?></a>
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