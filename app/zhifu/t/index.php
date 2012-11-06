<div class="index">
<div class="left-content">
	<div class="video-wrapper list ">
		<div class="top-title clearfix">
			<h3>精彩视频</h3><a class="more" href="<?php echo ROOT_URL.'/video'?>">查看更多</a>
		</div>
		
		
		<?php foreach($videos as $video){?>
		<div class="item clearfix">
			<div class="pic">
				<img src="<?php img($video->image, $video->default_image())?>" width="110" height="85" alt="<?php echo $video->title?>">			
			</div>
			<div class="title">
				<a href="<?php echo ROOT_URL.'/video/show?id='.$video->id?>" title="<?php echo $video->title?>"><?php echo subString($video->title, 6)?></a>
			</div>
			
		</div><!--end for item-->
		<?php }?>
		
	</div>
	

</div>	<!--end for left-content-->
<div class="right-content">
	<div class="idea-wrapper list clearfix">
		<div class="top-title clearfix">
			<h3>创意悬赏</h3><a class="more" href="<?php echo ROOT_URL.'/idea'?>">查看更多</a>
		</div>
		<div class="clearfix">
		
		<?php foreach($ideas as $idea){?>
		<div class="item clearfix">
			<div class="pic">
				<img src="<?php img($idea->image, $idea->default_image())?>" width="100" height="75" alt="<?php echo $idea->title?>">			
			</div>
			<div class="content">
				<div class="title"><a href="<?php echo ROOT_URL.'/idea/detail?id='.$idea->id?>" title="<?php echo $idea->title?>"><?php echo subString($idea->title, 10)?></a></div>
				<div class="des">
					<p>
					<?php if(strtotime($idea->deadline) > 0){?>
					<?php echo get_date($idea->deadline)?> 截止
					<?php }?>
					<?php echo $idea->item_count?>人提交方案
					</p>
					<p><?php output_desc($idea->description, 20)?></p>
				</div>
			</div>
		</div><!--end for item-->
		<?php }?>
		</div>
		<span class="more"><a href="<?php echo ROOT_URL.'/idea'?>">查看更多</a></span>
	</div>
	
	<div class="patent-wrapper list clearfix">
		<div class="top-title clearfix">
			<h3>科技成果</h3><a class="more" href="<?php echo ROOT_URL.'/article'?>">查看更多</a>
		</div>
		<img class="fl" src="<?php echo IMAGE_HOME?>/patent-img.jpg" alt="" />
		<div class="content fl">
			<?php foreach($patents as $patent){?>
			<div class="item">
				<span class="title"><a href="<?php echo ROOT_URL.'/patent/detail?id='.$patent->id?>" title="<?php echo $patent->title?>"><?php echo subString($patent->title, 10)?></a></span>
				<span class="time fr">2012-11-1</span>
			</div>
			<?php }?>
		</div>
		
	</div><!--end for patent-wrapper-->
	
	<div class="job-wrapper list">
			<div class="top-title clearfix">
				<h3>兼职顾问</h3><a class="more" href="<?php echo ROOT_URL.'/recruit'?>">查看更多</a>
			</div>
			<img class="fl" src="<?php echo IMAGE_HOME?>/job-img.jpg" alt="" />
			
			<div class="content fl">
				<?php foreach($recruits as $recruit){?>
						<div class="item">
							<span>【<?php output_identity($recruit->identity)?>】<a href="<?php echo ROOT_URL.'/recruit/show?id='.$recruit->id?>" title="<?php echo $recruit->title?>"><?php echo subString($recruit->title, 30)?></a></span>
							<span class="time fr">
								<?php echo $recruit->time?>
							</span>

						</div>
				<?php }?>
			
				
			</div>
	
	</div>
	
	
	
</div><!--end for right-content-->
<div class="clear"></div>
<div class="problem-wrapper list fl">
	<div class="top-title clearfix">
		<h3>技术难题</h3><a class="more" href="<?php echo ROOT_URL.'/problem'?>">查看更多</a>
	</div>

	<div class="clearfix">
	
	<?php foreach($problems as $problem){?>
		
		
	<div class="item clearfix">
		<div class="pic">
			<img src="<?php img($problem->image, $problem->default_image())?>" width="100" height="75" alt="<?php echo $problem->title?>">			
		</div>
		<div class="content">
			<div class="title"><a href="<?php echo ROOT_URL.'/problem/detail?id='.$problem->id?>" title="<?php echo $problem->title?>"><?php echo subString($problem->title, 10)?></a></div>
			<div class="des">
				<p>
				<?php if(strtotime($idea->deadline) > 0){?>
				<?php echo get_date($idea->deadline)?> 截止
				<?php }?>
				</p>
				<p><?php output_desc($problem->description, 20)?></p>
			</div>
		</div>
	</div><!--end for item-->
	<?php }?>
	</div>
	

</div><!--end for right-content-->


<div class="problem-more fr">
	<div class="problem-add">
		<div class="content">
			<p>难题名称</p>
			<p><input type="text"  class="text" name="title" /><span class="error"></span></p>
			<p>所属行业
				<select name="cat">
					<option value="-1">选择行业</option>
				</select>
				<span class="error"></span>
				<select name="subcat">
					<option value="-1">选择行业</option>
				</select>
				<span class="error"></span>	
			</p>
			<p>联系人姓名</p>
			<p><input type="text"  class="text" name="contact" /><span class="error"></span></p>
			<p>联系方式</p>
			<p><input type="text"  class="text" name="phone" /><span class="error"></span></p>
			<p>预算资金</p>
			<p><input type="text"  class="text"/><span class="error"></span></p>
			<p>难题简单描述</p>
			<p>
			<textarea name="desc" class="text"> </textarea>
			<span class="error"></span>
			</p>
			<p><input type="submit" value="发布" /></p>
		</div>
	</div>
	
	<div class="problem-interest">
		<div class="content">
			<p><a href="">难题名称</a></p>
			<p><a href="">难题名称</a></p>
			<p><a href="">难题名称</a></p>
			
			<p><a href="">难题名称</a></p>
			
		</div>
		<a class="more" href="<?php echo ROOT_URL.'/problem'?>"></a>		
	</div>
	
	<div class="problem-search">
		<div class="content">
			<input type="text"  class="text"/><input type="submit" value="搜索" />
		</div>
	</div>
	
	
</div>
<div class="clear"></div>

	


<div class="case-wrapper list clearfix">
	<div class="top-title clearfix">
		<h3>案例展示</h3><a class="more" href="<?php echo ROOT_URL.'/article'?>">查看更多</a>
	</div>
	
	<div class="clearfix">
	
	<?php foreach($articles as $article){?>
	<div class="item clearfix">
		<div class="content">
			<div class="title"><a href="<?php echo ROOT_URL.'/article/detail?id='.$article->id?>" title="<?php echo $article->title?>"><?php echo subString($article->title, 10)?></a></div>
			<div class="des">
				<p><?php echo $article->time?></p>
			</div>
		</div>
	</div><!--end for item-->
	<?php }?>
	</div>
	<span class="more"><a href="<?php echo ROOT_URL.'/article'?>">查看更多</a></span>
</div><!--end for case-wrapper-->
	
</div>