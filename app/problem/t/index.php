<div class="header_wrap">
	<div class="header">
		<h1 class="logo"><a href="#">知富网</a></h1>
		<div class="top-nav">
			<a href="#">首页</a>|
			<a href="#">个人主页</a>|
			<a href="#">我的订阅</a>|
			<a href="#">我的小组</a>|
			<a href="#">用户中心</a>|
			<a href="#">发布</a>
		</div>

		<ul class="main-nav">
			<li><a href="<?php echo ROOT_URL?>/problem" class="current">企业难题</a></li>
			<li><a href="#">创意悬赏</a></li>
			<li><a href="#">技术专利</a></li>
			<li><a href="#">兼职顾问</a></li>
			<li><a href="#">领域专家</a></li>
			<li><a href="#">视频</a></li>
			<li><a href="#">话题</a></li>
			<li><a href="#" class="last">案例展示</a></li>

		</ul>
	</div><!--end for header-->
	<ul class="cat-nav">
		<li><a href="#">所有分类</a></li>
		<li><a href="#">光学</a></li>
		<li><a href="#">计算机</a></li>
		<li><a href="#">机械</a></li>
	</ul>

</div><!--end for header_wrap-->
<div class="wrapper">
	<div class="main">
		<div class="filter clearfix">
			<div class="order">
				<label for="">排序:</label>
				<a href="<?php echo $home.'/index?order=time'?>" class="current">发布时间</a>
				<a href="<?php echo $home.'/index?order=deadline'?>">截止时间</a>
				<a href="<?php echo $home.'/index?order=budget'?>">任务金额</a>
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
						print_r($o);
			?>
			<div class="item clearfix">
				<div class="pic">
					<img src="<?php echo $o->image?>" alt="<?php echo $o->title?>">
				</div><!--end for pic-->
				<div class="middle">
					<h3 class="title"><?php echo $o->title?></h3>
					<div class="content"><?php echo $o->description?></div>						
					<div class="status clearfix">
						<div class="title">任务状态:</div>
						<div class="status-item <?php $HTML->current(0, $o->status)?>">竞标中</div>
						<div class="status-item <?php $HTML->current(0, $o->status)?>">专家会诊</div>
						<div class="status-item last <?php $HTML->current(0, $o->status)?>">已完成</div>
					</div>
				</div><!--end for middle-->

				<div class="right">
					<div class="price-deadline">
						<p>出价：<span class="num"><?php echo $o->budget?></span>元</p>
						<p>截止日期：<span class="date"><?php echo $o->deadline?></span></p>						
					</div>
					<a href="<?php echo $home.'/'?>" class="btn">我要竞标</a>
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

	

	</div><!--end for main-->
</div><!--end for wrapper-->
