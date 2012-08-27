
<div class="filter clearfix">
	<div class="order">
		<label for="">排序:</label>
		<a href="<?php echo $home.'/index?order=time'?>" <?php $HTML->if_current($_GET['order'] == 'time')?>>发布时间</a>
		<a href="<?php echo $home.'/index?order=deadline'?>" <?php $HTML->if_current($_GET['order'] == 'deadline')?>>截止时间</a>
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
				$desc = strip_tags($o->description);
	?>
	<div class="item clearfix">
		<div class="pic">
			<a href="<?php echo $home.'/detail?id='.$o->id?>">
			<img src="<?php img($o->image, $o->default_image())?>" width="200" height="150" alt="<?php echo $o->title?>">
			</a>
		</div><!--end for pic-->
		<div class="middle">
			<h3 class="title">
				<a href="<?php echo $home.'/detail?id='.$o->id?>">
				<?php echo $o->title?>
				</a>
			</h3>
			<div class="content"><?php echo $desc?></div>						
			<div class="status clearfix">
				<div class="title">状态:</div>
				<div class="status-item <?php $HTML->current(0, $o->status)?>">审核中</div>
				<div class="status-item last <?php $HTML->current(1, $o->status)?>">正常</div>
			</div>
		</div><!--end for middle-->

		<div class="right">
			<div class="price-deadline">
				<?php if($o->budget){?>
				<p>出价：<span class="num"><?php echo $o->budget?></span>万元</p>
				<?php }?>
			</div>
			<?php if(is_company($User)){?>
			<a href="<?php echo $home.'/submit?id='.$o->id?>" class="btn">我要购买</a>
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

