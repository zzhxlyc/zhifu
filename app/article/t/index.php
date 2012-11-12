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

<div>
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">案例展示</a>
</div>
	<!-- 
<div class="filter clearfix">
	<div class="order">
		<label for="">排序:</label>
		<a href="<?php echo $home.'/index?order=time'?>" <?php $HTML->if_current($_GET['order'] == 'time')?>>发布时间</a>
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
			<a href="<?php echo ARTICLE_HOME.'/detail?id='.$o->id?>">
				<h3 class="title"><?php echo $o->title?></h3>
			</a>
			<div class="meta">
				<span class="time"><?php echo $o->time?></span>
				<span class="author">发布者：管理员</span>
			</div>
			
			<div class="content"><?php output_desc($o->content)?></div>						
	</div><!--end for item-->
	<?php 
			}
		}
	?>
</div><!--end for list-->

<div class="page-wrapper">
	<?php output_page_list($links);?>
</div>

