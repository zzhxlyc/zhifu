<?php include('sidebar.php');?>

<div class="main-content">
	<div class="section">
		<h3>项目状态
			<?php if(is_company($User)){?>
			<a href="<?php echo $home.'/submit?id='.$Patent->id?>" class="join-btn btn">我要购买</a>
			<?php }?>
		</h3>
		<div class="content status clearfix">
			<div class="status-item <?php $HTML->current($Patent->status, 0)?>">审核中</div>
			<div class="status-item last <?php $HTML->current($Patent->status, 1)?>">有效</div>
			
		</div>
	</div><!--end for section-->

	<div class="section">
		<h3>购买企业（<?php echo count($deals)?>）</h3>
		<div class="content line-list">
			<?php 
				foreach($deals as $deal){
					$company = $companys[$deal->company];
			?>
			<div class="item clearfix">
				<div class="pic">
					<a target="_blank" href="<?php echo COMPANY_HOME.'/profile?id='.$company->id?>">
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