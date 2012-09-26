<div class="cat-wrapper">
	<!-- 
	<ul class="cat-nav">
		<li><a href="#">所有分类</a></li>
		<li><a href="#">光学</a></li>
		<li><a href="#">计算机</a></li>
		<li><a href="#">机械</a></li>
	</ul>
	 -->
</div><!--end for cat-wrapper-->

<div class="filter clearfix">
	<div class="order">
		<a href="<?php echo $home.'/send'?>" target="_blank">发信件</a>
		<a href="<?php echo $home.'/index'?>" class="current">收件箱</a>
		<a href="<?php echo $home.'/sendbox'?>">发件箱</a>
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
		<div class="middle">
			来自：<a href="<?php echo get_author_link($o->from, $o->from_type)?>">
					<?php echo $o->from_name?></a>
			<?php echo $o->time?>
			<a href="<?php echo $home.'/detail?id='.$o->id?>">
				<?php if($o->read == 1){?>
				<h3 class="title"><?php echo $o->title?></h3>
				<?php }else{?>
				<h3 class="title"><font color="red"><?php echo $o->title?></font></h3>
				<?php }?>
			</a>
			<div class="content"><?php output_desc($o->content)?></div>						
		</div><!--end for middle-->
	</div><!--end for item-->
	<?php 
			}
		}
	?>
</div><!--end for list-->

<div class="page-wrapper">
	<?php output_page_list($links);?>
</div>

