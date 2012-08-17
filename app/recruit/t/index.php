<div class="filter clearfix">
	<div class="order">
		<a href="<?php echo $home.'/index?type=zhaopin'?>" <?php $HTML->if_current($_GET['type'] == 'zhaopin')?>>顾问招聘</a>
		<a href="<?php echo $home.'/index?type=qiuzhi'?>" <?php $HTML->if_current($_GET['type'] == 'qiuzhi')?>>顾问求职</a>
	</div>
	<a href="<?php echo $home.'/ask'?>" class="job-btn btn">我要求职</a>
</div>

<div class="list job">
	<?php 
		if(is_array($list)){
			foreach($list as $o){
				$desc = strip_tags($o->description);
	?>
	<div class="item clearfix">
		<div class="pic">
			<img src="http://zjuhpp.com/demo/wp-content/uploads/2012/02/hero.jpg" alt="" width="150" height="100"/>
		</div><!--end for pic-->
		<div class="middle">
			<h3 class="title"><?php echo $o->title?></h3>
			<div class="content"> <?php echo $desc?></div>						
			<div class="time">期望时间：湘潭</div>	

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

