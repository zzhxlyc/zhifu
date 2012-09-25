<?php include('sidebar.php');?>

<div class="main-content">
	<div class="section">
		<h3>项目状态
			<?php if(is_company($User)){?>
			<a href="<?php echo $home.'/submit?id='.$Patent->id?>" class="join-btn btn">我要购买</a>
			<?php }?>
			<?php if(is_expert($User) && $User->id == $Patent->expert){?>
			<a href="<?php echo $home.'/edit?id='.$Patent->id?>" class="edit">编辑</a>
			<?php }?>
			
		</h3>
		<div class="content status clearfix">
			<div class="status-item <?php $HTML->current($Patent->status, 0)?>">审核中</div>
			<div class="status-item last <?php $HTML->current($Patent->status, 1)?>">有效</div>
			
		</div>
	</div><!--end for section-->

	<div class="section">
		<h3>购买用户（<?php echo count($deals)?>）</h3>
		<div class="content line-list">
			<?php 
				foreach($deals as $deal){
					$buyer = $buyers[$deal->id];
			?>
			<div class="item clearfix">
				<div class="pic">
					<a target="_blank" href="<?php echo get_author_link($buyer->id, $buyer->get_type())?>">
					<img src="<?php img($buyer->image, $buyer->default_image())?>" alt="<?php echo $buyer->name?>"
						 width="100" height="100"/>
					</a>
					<span class="name">
						<a target="_blank" href="<?php echo get_author_link($buyer->id, $buyer->get_type())?>">
						<?php output_username($buyer)?>
						</a>
					</span>
				</div>
				<div class="des">购买时间：<?php echo $deal->time?></div>
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
	
	<?php comment_div($comments, $links, $Patent, BelongType::PATENT, $User)?>
	
</div><!--end for main-content-->

<?php comment_js()?>