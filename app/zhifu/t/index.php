<div class="index">
<div class="left-content">

	<div class="idea-wrapper list clearfix">
		<span class="icon1"></span><h3>创意悬赏</h3>
		<?php foreach($ideas as $idea){?>
		<div class="item clearfix">
			<div class="pic">
				<img src="<?php img($idea->image, $idea->default_image())?>" width="100" height="75" alt="<?php echo $idea->title?>">			
			</div>
			<div class="content">
				<div class="title"><a href="<?php echo ROOT_URL.'/idea/detail?id='.$idea->id?>"><?php echo subString($idea->title, 10)?></a></div>
				<div class="des">
					<p><?php echo get_date($idea->time)?> 发布</p>
					<?php if(strtotime($idea->deadline) > 0){?>
					<p><?php echo get_date($idea->deadline)?> 截止</p>
					<?php }?>
				</div>
			</div>
		</div><!--end for item-->
		<?php }?>
		<span class="more"><a href="<?php echo ROOT_URL.'/idea'?>">查看更多</a></span>
	</div>
	
	<div class="problem-wrapper list">
		<span class="icon2"></span><h3>技术难题</h3>
		<?php foreach($problems as $problem){?>
		<div class="item clearfix">
			<div class="pic">
				<img src="<?php img($problem->image, $problem->default_image())?>" width="100" height="75" alt="<?php echo $problem->title?>">			
			</div>
			<div class="content">
				<div class="title"><a href="<?php echo ROOT_URL.'/problem/detail?id='.$problem->id?>"><?php echo subString($problem->title, 10)?></a></div>
				<div class="des">
					<p><?php echo get_date($idea->time)?> 发布</p>
					<p><?php output_desc($problem->description, 20)?></p>
				</div>
			</div>
		</div><!--end for item-->
		<?php }?>
		<span class="more"><a href="<?php echo ROOT_URL.'/problem'?>">查看更多</a></span>
	</div>
	
	

</div>	<!--end for left-content-->
<div class="right-content">
	<div class="video-wrapper list ">
		<span class="icon6"></span><h3>精彩视频</h3>
		<?php foreach($videos as $video){?>
		<div class="item clearfix">
			<div class="pic">
				<img src="<?php img($video->image, $video->default_image())?>" width="100" height="75" alt="<?php echo $video->title?>">			
			</div>
			<div class="title">
				<a href=""><?php echo subString($video->title, 6)?></a>
			</div>
			<div class="des">
				<p>点击：<?php echo $video->click?></p>
			</div>
		</div><!--end for item-->
		<?php }?>
		<span class="more"><a href="<?php echo ROOT_URL.'/video'?>">查看更多</a></span>
	</div>
	
</div><!--end for right-content-->
<div class="clear"></div>
<div class="job-wrapper job list">
	<span class="icon3"></span><h3>兼职顾问</h3>
	<table>
		<tr class="top">
			<th width="100">类型</th>
			<th>职位名称</th>
			<th width="200">工作地点</th>
			<th width="80">招聘人数</th>
			<th width="120">发布者</th>
			<th width="140">发布时间</th>				
		</tr>
		<?php foreach($recruits as $recruit){?>
		<tr>
			<td><?php output_identity($recruit->identity)?></td>
			<td><?php echo $recruit->title?></td>
			<td><?php echo $recruit->area?></td>
			<td><?php echo $recruit->num?></td>
			<td><?php output_author_link2($recruit->belong, $recruit->type, $recruit->username)?></td>
			<td><?php echo $recruit->time?></td>
		</tr>
		<?php }?>
	</table>
	<span class="more"><a href="<?php echo ROOT_URL.'/recruit'?>">查看更多</a></span>
</div>
	
<div class="patent-wrapper list clearfix">
	<span class="icon4"></span><h3>科技成果</h3>
	<?php foreach($patents as $patent){?>
	<div class="item">
		<span class="title"><a href="<?php echo ROOT_URL.'/patent/detail?id='.$patent->id?>"><?php echo $patent->title?></a></span>
		<span class="cat">发布者：<?php output_author_link2($patent->expert, BelongType::EXPERT, $patent->username)?></span>
	</div>
	<?php }?>
	<span class="more"><a href="<?php echo ROOT_URL.'/patent'?>">查看更多</a></span>
</div><!--end for patent-wrapper-->


<div class="case-wrapper list clearfix">
	<span class="icon5"></span><h3>案例展示</h3>
	<?php foreach($articles as $article){?>
	<div class="item clearfix">
		<div class="content">
			<div class="title"><a href="<?php echo ROOT_URL.'/article/detail?id='.$article->id?>"><?php echo $article->title?></a></div>
			<div class="des">
				<p><?php echo $article->time?></p>
				<p>点击：<?php echo $article->click?></p>
			</div>
		</div>
	</div><!--end for item-->
	<?php }?>
	<span class="more"><a href="<?php echo ROOT_URL.'/article'?>">查看更多</a></span>
</div><!--end for case-wrapper-->
	
</div>