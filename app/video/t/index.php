<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">科技视频</a>
	
	<a href="<?php echo VIDEO_HOME.'/add';?>" class="fr btn">上传视频</a>
</div>

<div class="video-left">

	<?php foreach($level1_list as $cat){?>
	<div class="section left-video-section">
		<h3><?php echo $cat->name?></h3>
		<div class="list clearfix">
			<?php 
				$video_list = $cat_video_list[$cat->id];
				foreach($video_list as $video){
			?>
			<div class="video-item">
				<a target="_blank" href="<?php echo VIDEO_HOME.'/show?id='.$video->id?>">
					<img src="<?php img($video->image)?>" width="200" height="200" />
				</a>
				<div class="title"><?php echo $video->title?></div>
			</div>
			<?php }?>
		</div>
	</div><!--end for left-video-section-->
	<?php }?>
	
</div>


<div class="video-right">
	
	<div class="section right-video-section fr">
		<h3>精彩推荐</h3>
		<div class="list clearfix">
			<?php foreach($hot_list as $video){?>
			<div class="video-item">
				<a target="_blank" href="<?php echo VIDEO_HOME.'/show?id='.$video->id?>">
					<img src="<?php img($video->image)?>" width="130" height="130" />
				</a>
				<div class="title"><?php echo $video->title?></div>
			</div>
			<?php }?>
		</div>
	</div>

	<div class="section right-video-section fr">
		<h3>最新视频</h3>
		<div class="list clearfix">
			<?php foreach($newly_list as $video){?>
			<div class="video-item">
				<a target="_blank" href="<?php echo VIDEO_HOME.'/show?id='.$video->id?>">
					<img src="<?php img($video->image)?>" width="130" height="130" />
				</a>
				<div class="title"><?php echo $video->title?></div>
			</div>
			<?php }?>
		</div>
	</div>
	
	
	
	<div class="section video-cat right-video-section fr">
		<h3>视频分类</h3>
		<div class="list clearfix">
			<?php 
				foreach($children as $top_cat_id => $sub_cat_list){
					$top_cat = $cat_list[$top_cat_id];
			?>
			<span class="cat-item">
				<a href="<?php echo VIDEO_HOME.'?cat='.$top_cat->id?>" style="color:#333333">
				<?php echo $top_cat->name?>
				</a>
			</span> 
			<div class="subcat">
				<?php
					foreach($sub_cat_list as $cat_id){
						$cat = $cat_list[$cat_id];
				?>
				<a href="<?php echo VIDEO_HOME.'?cat='.$cat->id?>"><?php echo $cat->name?></a>
				<?php }?>
			</div>
			<?php }?>
		</div>
	</div>
</div>





<div class="clear"></div>
