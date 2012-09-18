<?php include('sidebar.php');?>

<div class="main-content">
	<div class="section">
		<h3>创意状态
			<?php if(is_expert($User) && $Idea->status == 0){?>
			<a href="<?php echo $home.'/submit?id='.$Idea->id?>" class="join-btn btn">我有创意</a>
			<?php }?>
			<?php if(is_company($User) && $User->id == $Idea->company && $Idea->status == 0){?>
			<a href="<?php echo $home.'/edit?id='.$Idea->id?>" class="edit">编辑</a>
			<?php }?>
		</h3>
		<div class="content status clearfix">
			<div class="status-item <?php $HTML->current($Idea->status, 0)?>">竞标中</div>
			<div class="status-item <?php $HTML->current($Idea->status, 1)?>">评奖中</div>
			<div class="status-item last  <?php $HTML->current($Idea->status, 2)?>">交付互评</div>
		</div>
	</div><!--end for section-->

	<?php if($Idea->status >= 2){?>
	<div class="section">
		<?php 
			$array = array('一等奖'=>$one_list, '二等奖'=>$two_list, '三等奖'=>$three_list);
			foreach($array as $title => $list){
				if($list && count($list) > 0){
		?>
		<h3><?php echo $title?></h3>
		<div class="content line-list">
			<?php 
				foreach($list as $item){
					$expert = $experts[$item->expert];
			?>
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
						<?php if(is_company_object($User, $Idea)){?>
						<br/>
						<a href="<?php echo $home."/item?idea=$Idea->id&item=$item->id"?>">
						给专家评分
						</a>
						<?php }?>
						<?php if(is_expert_object($User, $item)){?>
						<br/>
						<a href="<?php echo $home.'/score?id='.$Idea->id?>">给企业评分</a>
						<?php }?>
					</span>
				</div>
				<div class="des">
					<?php if(is_expert_object($User, $item)){?>
					<a href="<?php echo $home."/item?idea=$Idea->id&item=$item->id"?>">
					<?php echo $item->title?>
					</a>
					<?php 
						}else{
							echo $item->title;
						}
					?>
					
					<?php echo $item->content?>
				</div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
		<?php 
				}
			}
		?>
	</div><!--end for section-->
	<?php }?>

	<div class="section">
		<h3>竞标专家（<?php echo count($items)?>）</h3>
		<div class="content line-list">
			<?php 
				foreach($items as $item){
					$expert = $experts[$item->expert];
			?>
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
				<div class="des">
					<a href="<?php echo $home."/item?idea=$Idea->id&item=$item->id"?>">
					<?php echo $item->title?>
					</a>
					<?php echo $item->content?>
				</div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	<div class="section">
		<h3>创意介绍</h3>
		<div class="content">
			<?php echo $Idea->description?>
		</div>
		<div class="content">
			<?php if($Idea->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Idea->file"?>">点击下载</a>
			<?php }?>
		</div>
	</div>
	
	<?php comment_div($comments, $links, $Idea, BelongType::IDEA, $User)?>
	
</div><!--end for main-content-->

<?php comment_js()?>