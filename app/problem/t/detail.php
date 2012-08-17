<div class="sidebar">

	<div class="detail-profile">
		<img src="<?php img($Problem->image)?>" alt="<?php echo $Problem->title?>" width="180" height="150"/>
		<p><?php echo $Problem->title?></p>
		<p>金额<span class="price"><?php output_money($Problem->budget)?></span></p>
		<p></p>
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
	
	
</div><!--end for sidebar-->

<div class="main-content">
	<div class="section">
		<h3>项目状态<a href="<?php echo $home.'/solution'?>" class="join-btn btn">我要竞标</a></h3>
		<div class="content status clearfix">
			<div class="status-item <?php $HTML->current($Problem->status, 0)?>">发布蓝图</div>
			<div class="status-item <?php $HTML->current($Problem->status, 1)?>">竞标中</div>
			<div class="status-item <?php $HTML->current($Problem->status, 2)?>">付款</div>
			<div class="status-item last  <?php $HTML->current($Problem->status, 3)?>">交付互评</div>
			
		</div>
		
		
		
	</div><!--end for section-->



	<div class="section">
		<h3>竞标专家（<?php echo count($experts)?>）</h3>
		<div class="content line-list">
			<?php foreach($experts as $expert){?>
			<div class="item clearfix">
				<div class="pic">
					<a target="_blank" href="<?php echo EXPERT_HOME.'/profile?id='.$expert->id?>">
					<img src="<?php img($expert->image)?>" alt="<?php echo $expert->name?>"
						 width="100" height="100"/>
					</a>
					<span class="name">
						<a target="_blank" href="<?php echo EXPERT_HOME.'/profile?id='.$expert->id?>">
						<?php echo $expert->name?>
						</a>
					</span>
				</div>
				<div class="des"><?php output_desc($expert->description)?></div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->		
	
	
</div><!--end for main-content-->