<div class="filter clearfix">
	<div class="order">
		<a href="<?php echo $home.'/index'?>" <?php $HTML->if_current($_GET['type'] == '')?>>全部</a>
		<a href="<?php echo $home.'/index?type=zhaopin'?>" <?php $HTML->if_current($_GET['type'] == 'zhaopin')?>>顾问招聘</a>
		<a href="<?php echo $home.'/index?type=qiuzhi'?>" <?php $HTML->if_current($_GET['type'] == 'qiuzhi')?>>顾问求职</a>
	</div>
	<a href="<?php echo $home.'/add'?>" class="job-btn btn">我要发布</a>
</div>

<div class="list job">
	<?php 
		if(is_array($list)){
			foreach($list as $o){
	?>
	<div class="item clearfix">
		<div class="middle">
			<h3 class="title">
				<a href="<?php echo $home.'/show?id='.$o->id?>"><?php echo $o->title?></a>
			</h3>
			<div class="content"><?php output_desc($o->description)?></div>						
			<div class="time"><?php echo $o->get_status()?></div>	

		</div><!--end for middle-->
		
	</div><!--end for item-->
	<?php 
			}
		}
	?>
</div>

<div class="page-wrapper">
	<?php output_page_list($links);?>
</div>

