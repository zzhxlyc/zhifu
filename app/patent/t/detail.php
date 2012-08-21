<div class="sidebar">

	<div class="detail-profile">
		<img src="<?php img($Patent->image, $Patent->default_image())?>" alt="<?php echo $Patent->title?>" width="180" height="150"/>
		<p><?php echo $Patent->title?></p>
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
			<p><?php echo $Expert->name?></p>
			
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
			<div class="status-item <?php $HTML->current($Patent->status, 0)?>">发布蓝图</div>
			<div class="status-item <?php $HTML->current($Patent->status, 1)?>">竞标中</div>
			<div class="status-item <?php $HTML->current($Patent->status, 2)?>">付款</div>
			<div class="status-item last  <?php $HTML->current($Patent->status, 3)?>">交付互评</div>
			
		</div>
	</div><!--end for section-->



	<div class="section">
		<h3>购买企业（<?php echo count($companys)?>）</h3>
		<div class="content line-list">
			<?php foreach($companys as $company){?>
			<div class="item clearfix">
				<div class="pic">
					<a target="_blank" href="<?php echo EXPERT_HOME.'/profile?id='.$company->id?>">
					<img src="<?php img($company->image)?>" alt="<?php echo $company->name?>"
						 width="100" height="100"/>
					</a>
					<span class="name">
						<a target="_blank" href="<?php echo COMPANY_HOME.'/profile?id='.$company->id?>">
						<?php echo $company->name?>
						</a>
					</span>
				</div>
				<div class="des"><?php output_desc($company->description)?></div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	<div class="section">
		<h3>专利介绍</h3>
		<div class="content">
			<?php echo $Patent->description?>
		</div>
		<div class="content">
			<?php if($Patent->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Patent->file"?>">点击下载</a>
			<?php }?>
		</div>
	</div>	
	
	
</div><!--end for main-content-->