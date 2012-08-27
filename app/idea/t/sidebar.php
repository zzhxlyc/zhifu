<div class="sidebar">

	<div class="detail-profile">
		<img src="<?php img($Idea->image, $Idea->default_image())?>" alt="<?php echo $Idea->title?>" width="180" height="135"/>
		<p><?php echo $Idea->title?></p>
		<p>金额：<span class="price"><?php output_money($Idea->budget)?>万元</span></p>
		<?php if(isset($Idea->deadline)){?>
		<p><?php output_deadline($Idea->deadline)?></p>
		<?php }?>
	</div><!--end for detail-profile-->
	
	<div class="side-section">
		<div class="title">发起者</div>
		<div class="content">
			<p><?php echo $Company->name?></p>
			
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
	
	<div class="side-section">
		<div class="title">操作</div>
		<div class="content">
			<a href="javascript:void(0)" class="idea_finish">结束评奖</a>
		</div>
	</div>
	
	
</div><!--end for sidebar-->
