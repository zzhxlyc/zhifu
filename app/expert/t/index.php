<div class="cat-wrapper">
	<!-- <ul class="cat-nav">
		<li><a href="#">所有分类</a></li>
		<li><a href="#">光学</a></li>
		<li><a href="#">计算机</a></li>
		<li><a href="#">机械</a></li>
	</ul> -->
</div><!--end for cat-wrapper-->

<div>
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">领域专家</a>
</div>

	<!-- 
<div class="filter clearfix">
	<div class="order">
		<label for="">排序:</label>
		<a href="<?php echo $home.'/index?order=budget'?>" <?php $HTML->if_current($_GET['order'] == 'budget')?>>任务金额</a>
	</div>
	<div class="search">
		<input type="text" class="text">
		<input type="button" class="btn">
	</div>
</div>
	-->

<div class="list">
	<?php 
		if(is_array($list)){
			foreach($list as $o){
	?>
	<div class="item clearfix">
		<div class="pic">
			<a href="<?php echo $home.'/profile?id='.$o->id?>">
			<img src="<?php img($o->image, $o->default_image())?>" width="100" height="100"  alt="<?php echo $o->title?>">
			</a>
			<p><?php echo $o->job?></p>
			<p><?php echo $o->workplace?></p>
		</div><!--end for pic-->
		<div class="middle">
			<h3 class="title"><a href="<?php echo $home.'/profile?id='.$o->id?>"><?php output_username($o, 2)?></a></h3>
			<div class="content"><?php output_desc($o->description)?></div>						
			
		</div><!--end for middle-->

		<div class="right">
			<div class="price-deadline">
				<p>邮件：<?php echo $o->email?></p>
				<p>综合评价：<span class="num"><?php output_score($o)?></span></p>
			</div>
			<a href="<?php echo $home.'/profile?id='.$o->id.'#comments'?>" class="btn">向他咨询</a>
		</div><!--end for right-->
	</div><!--end for item-->
	<?php 
			}
		}
	?>
</div><!--end for list-->

<div class="page-wrapper">
	<?php output_page_list($links);?>
</div>

