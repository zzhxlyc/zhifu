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
	 
<div>
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">技术难题</a>
</div>

<div class="filter clearfix">
	<div class="order">
		<label for="">排序:</label>
		<a href="<?php echo $home.'/index?order=time'?>" <?php $HTML->if_current($_GET['order'] == 'time')?>>发布时间</a>
		<a href="<?php echo $home.'/index?order=deadline'?>" <?php $HTML->if_current($_GET['order'] == 'deadline')?>>截止时间</a>
		<a href="<?php echo $home.'/index?order=budget'?>" <?php $HTML->if_current($_GET['order'] == 'budget')?>>任务金额</a>
	</div>
	
	<form action="" method="get">
	<div class="search">
		<input type="text" class="text" name="title" value="<?php echo $_GET['title']?>">
		<input type="submit" class="btn" value="">
	</div>
	</form>
</div>


<div class="list">
	<?php 
		if(is_array($list)){
			foreach($list as $o){
	?>
	<div class="item clearfix">
		<div class="pic">
			<a href="<?php echo $home.'/detail?id='.$o->id?>">
			<img src="<?php img($o->image, $o->default_image())?>" width="200" height="150"  alt="<?php echo $o->title?>">
			</a>
		</div><!--end for pic-->
		<div class="middle">
			<h3 class="title"><a href="<?php echo $home.'/detail?id='.$o->id?>"><?php echo $o->title?></a></h3>
			<div class="content"><?php output_desc($o->description)?></div>						
			<div class="status clearfix">
				<div class="title">状态:</div>
				<div class="status-item last current"><?php echo $o->get_status()?></div>
			</div>
		</div><!--end for middle-->

		<div class="right">
			<div class="price-deadline">
				<?php if($o->budget){?>
				<p>出价：<span class="num"><?php echo $o->budget?></span>万元</p>
				<?php }else{?>
				<p>出价：<span class="num">面议</span></p>
				<?php }?>
				<?php if($o->city){?>
				<p>所在地区：<span><?php output_pcd($o);?></span></p>
				<?php }?>
				<?php if($o->city2){?>
				<p>面向地区：<span><?php output_pcd2($o);?></span></p>
				<?php }?>
				
				<p>发布日期：<span><?php echo get_date($o->time)?></span></p>
				
				<?php output_deadline($o->deadline)?>
				
			</div>
			<?php if(is_expert($User) && $o->status == 1){?>
			<a href="<?php echo $home.'/submit?id='.$o->id?>" class="btn">我要竞标</a>
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

