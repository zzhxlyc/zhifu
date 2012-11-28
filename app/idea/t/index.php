	<!-- 
<div class="cat-wrapper">
	<ul class="cat-nav">
		<li><a href="#">所有分类</a></li>
		<li><a href="#">光学</a></li>
		<li><a href="#">计算机</a></li>
		<li><a href="#">机械</a></li>
	</ul>
</div>
	 -->

<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">创意悬赏</a>
</div>

	<!-- 
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
</div>
	 -->

<div class="list">
	<?php 
		if(is_array($list)){
			foreach($list as $o){
				$desc = subString(strip_tags($o->description), 150);
	?>
	<div class="item clearfix">
		<div class="pic">
			<a href="<?php echo $home.'/detail?id='.$o->id?>">
			<img src="<?php img($o->image, $o->default_image())?>" width="200" height="150"  alt="<?php echo $o->title?>">
			</a>
		</div><!--end for pic-->
		<div class="middle">
			<h3 class="title"><a href="<?php echo $home.'/detail?id='.$o->id?>"><?php echo $o->title?></a></h3>
			<div class="content"><?php echo $desc?></div>						
			<div class="status clearfix">
				<div class="title">状态：</div>
				<div class="status-item last current"><?php echo $o->get_status()?></div>
			</div>
		</div><!--end for middle-->

		<div class="right">
			<div class="price-deadline">
				<?php if($o->budget){?>
				<p>出价：<span class="num"><?php echo $o->budget?></span>万元</p>
				<?php }?>
				<?php output_deadline($o->deadline)?>
			</div>
			<?php if(is_expert($User) && $o->status == 0){?>
			<a href="<?php echo $home.'/submit?id='.$o->id?>" class="btn">我有创意</a>
			<?php }?>
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

