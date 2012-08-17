<div class="cat-wrapper">
	<ul class="cat-nav">
		<li><a href="#">所有分类</a></li>
		<li><a href="#">光学</a></li>
		<li><a href="#">计算机</a></li>
		<li><a href="#">机械</a></li>
	</ul>
</div><!--end for cat-wrapper-->

<div class="filter clearfix">
	<div class="order">
		<label for="">排序:</label>
		<a href="<?php echo $home.'/index?order=time'?>" <?php $HTML->if_current($_GET['order'] == 'time')?>>发布时间</a>
		<a href="<?php echo $home.'/index?order=deadline'?>" <?php $HTML->if_current($_GET['order'] == 'deadline')?>>截止时间</a>
		<a href="<?php echo $home.'/index?order=budget'?>" <?php $HTML->if_current($_GET['order'] == 'budget')?>>任务金额</a>
	</div>

	<div class="search">
		<input type="text" class="text">
		<input type="button" class="btn">
	</div>

</div><!--end for filter-->

<div class="list">
	<?php 
		if(is_array($list)){
			foreach($list as $o){
				$desc = strip_tags($o->description);
	?>
	<div class="item clearfix">
		<div class="pic">
			<img src="<?php img($o->image)?>" width="200" height="150"  alt="<?php echo $o->title?>">
		</div><!--end for pic-->
		<div class="middle">
			<h3 class="title"><a href="<?php echo $home.'/profile?id='.$o->id?>"><?php echo $o->name?></a></h3>
			<div class="content"><?php echo $desc?></div>						
			
		</div><!--end for middle-->

		<div class="right">
			<div class="price-deadline">
				<p>参与项目总额：<span class="num"><?php echo $o->budget?></span>元</p>
				<p>擅长领域：<span class="tag">自动化，骑车</span></p>						
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

