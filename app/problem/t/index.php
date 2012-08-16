
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
			<img src="<?php echo $o->image?>" alt="<?php echo $o->title?>">
		</div><!--end for pic-->
		<div class="middle">
			<h3 class="title"><?php echo $o->title?></h3>
			<div class="content"><?php echo $desc?></div>						
			<div class="status clearfix">
				<div class="title">任务状态:</div>
				<div class="status-item <?php $HTML->current(0, $o->status)?>">竞标中</div>
				<div class="status-item <?php $HTML->current(1, $o->status)?>">专家会诊</div>
				<div class="status-item last <?php $HTML->current(2, $o->status)?>">已完成</div>
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

