<div class="cat-wrapper">
	<!-- <ul class="cat-nav">
		<li><a href="#">所有分类</a></li>
		<li><a href="#">光学</a></li>
		<li><a href="#">计算机</a></li>
		<li><a href="#">机械</a></li>
	</ul> -->
</div><!--end for cat-wrapper-->

<div class="filter clearfix">
	<div class="order">
		<label for="">排序:</label>
		<a href="<?php echo $home.'/index?order=budget'?>" <?php $HTML->if_current($_GET['order'] == 'budget')?>>任务金额</a>
	</div>
	<!-- 
	<div class="search">
		<input type="text" class="text">
		<input type="button" class="btn">
	</div>
	-->

</div><!--end for filter-->

<div class="list">
	<?php 
		if(is_array($list)){
			foreach($list as $o){
	?>
	<div class="item clearfix">
		<div class="pic">
			<a href="<?php echo $home.'/profile?id='.$o->id?>">
			<img src="<?php img($o->image, $o->default_image())?>" width="200" height="150"  alt="<?php echo $o->title?>">
			</a>
		</div><!--end for pic-->
		<div class="middle">
			<h3 class="title"><a href="<?php echo $home.'/profile?id='.$o->id?>"><?php echo $o->name?></a></h3>
			<div class="content"><?php output_desc($o->description)?></div>						
			
		</div><!--end for middle-->

		<div class="right">
			<div class="price-deadline">
				<p>邮件：<?php echo $o->email?></p>
				<p>参与项目总额：<span class="num"><?php echo $o->budget?></span>元</p>
				<p>综合评价：<span class="num"><?php output_score($o)?></span></p>
			</div>
			<a href="<?php echo $home.'/'?>" class="btn">向他咨询</a>
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

