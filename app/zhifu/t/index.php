<div class="index">
<div class="left-content">
	<div class="video-wrapper list ">
		<div class="top-title clearfix">
			<h3>精彩视频</h3><a class="more" href="<?php echo ROOT_URL.'/video'?>">查看更多</a>
		</div>
		
		
		<?php foreach($videos as $video){?>
		<div class="item clearfix">
			<div class="pic">
				<a href="<?php echo ROOT_URL.'/video/show?id='.$video->id?>" title="<?php echo $video->title?>">
				<img src="<?php img($video->image, $video->default_image())?>" width="110" height="85" alt="<?php echo $video->title?>">			
				</a>
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
				<div class="title"><a href="<?php echo ROOT_URL.'/idea/detail?id='.$idea->id?>" title="<?php echo $idea->title?>"><?php echo subString($idea->title, 20)?></a></div>
				<div class="des">
					<p>共提交<span><?php echo $idea->item_count?></span>个创意方案</p>
					<p>
						奖金：<span><?php echo $idea->budget?>万元</span>&nbsp;&nbsp;&nbsp;
						发布日期：<span><?php echo get_date($idea->time)?></span>&nbsp;&nbsp;&nbsp;
						<?php if(is_valid_date($idea->deadline)){?>
						截止日期：<span><?php echo get_date($idea->deadline)?></span>
						<?php }?>
					</p>
				</div>
			</div>
		</div><!--end for item-->
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
		<div class="title clearfix"><a href="<?php echo ROOT_URL.'/problem/detail?id='.$problem->id?>" title="<?php echo $problem->title?>"><?php echo subString($problem->title, 10)?></a>
			<span class="fr">状态：<?php echo $problem->get_status()?></span>
		</div>
		
		<div class="content clearfix">
			<div class="pic">
				<img src="<?php img($problem->image, $problem->default_image())?>" width="100" height="75" alt="<?php echo $problem->title?>">			
			</div>
			<div class="des">
				<p style="color:#666;"><?php output_desc($problem->description, 100)?></p>
			</div>
			<p style="font-weight:bold;">
				<?php if($problem->budget){?>
				预算：<span><?php echo $problem->budget?>万元</span>&nbsp;&nbsp;&nbsp;
				<?php }?>
				<?php if($problem->city){?>
				所在地区：<span><?php output_pcd($problem)?></span>&nbsp;&nbsp;&nbsp;
				<?php }?>
				<?php if(is_valid_date($problem->deadline)){?>
				截止日期：<span><?php echo $problem->deadline?></span>
				<?php }?>
			</p>
		</div>
	</div><!--end for item-->
	<?php }?>
	</div>
	

</div><!--end for right-content-->


<div class="problem-more fr">
	<div class="problem-add">
		<div class="content">
			<form action="<?php echo PROBLEM_HOME.'/add'?>" method="post">
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
			<p>公司名称</p>
			<p><input class="text" size="50" type="text" name="name" /><span class="error"></span></p>
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
			<p>
				<input type="hidden" id="type" name="type" value="1" />
				<input type="submit" value="发布" />
			</p>
			</form>
		</div>
	</div>
	<!--
	<div class="problem-interest">
		<div class="content">
			<p><a href="">难题名称</a></p>
			<p><a href="">难题名称</a></p>
			<p><a href="">难题名称</a></p>
			<p><a href="">难题名称</a></p>
			<p><a href="">难题名称</a></p>
			
		</div>
		<a class="more" href="<?php //echo ROOT_URL.'/problem'?>"></a>		
	</div>
	-->
	<div class="problem-tips" style="margin: 10px 0">
		<span>温馨提示</span>：如果您能将难题描述得比较详细，请进入详细难题发布页面，<a href="<?php echo ROOT_URL.'/problem/add'?>">点击进入</a>
	</div>
	<div class="problem-search">
		<div class="content">
			<form action="<?php echo PROBLEM_HOME?>" method="get">
			<input type="text" class="text" name="title"/>
			<input type="submit" value="搜索" />
			</form>
		</div>
	</div>
	
	
</div>
<div class="clear"></div>


<div class="job-wrapper list">
		<div class="top-title clearfix">
			<h3>兼职顾问</h3><a href="<?php echo ROOT_URL.'/recruit/add'?>" style="display:block;float:left;width:100px;height: 24px;"></a><a class="more" href="<?php echo ROOT_URL.'/recruit'?>">查看更多</a>
		</div>
		<img class="fl" src="<?php echo IMAGE_HOME?>/job-img.jpg" alt="" />
		
		<div class="content fl">
			
				<table>
					<tr class="top">
						<td>招聘对象</td>
						<td>职位名称</td>
						<td>公司名称</td>
						<td>工作地区</td>
						<td>发布时间</td>
					</tr>
					<?php foreach($recruits as $recruit){?>
					<tr>
						<td><?php output_identity($recruit->identity)?></td>
						<td><a href="<?php echo ROOT_URL.'/recruit/show?id='.$recruit->id?>" target="_blank"><?php echo $recruit->title?></a></td>
						<td><?php echo $recruit->company?></td>
						<td><?php echo $recruit->area?></td>
						<td><?php echo get_date($recruit->time)?></td>
					</tr>
					<?php }?>
					
				</table>
				
				
		
			
		</div>
		<div class="clear"></div>

</div>
	
<div class="patent-wrapper list clearfix">
	<div class="top-title clearfix">
		<h3>科技成果</h3><a href="<?php echo ROOT_URL.'/patent/add'?>" style="display:block;float:left;width:100px;height: 24px;padding-top: 75px;"></a><a class="more" href="<?php echo ROOT_URL.'/article'?>">查看更多</a>
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


<div class="case-wrapper list clearfix">
	<div class="top-title clearfix">
		<h3>案例展示</h3><a class="more" href="<?php echo ROOT_URL.'/article'?>">查看更多</a>
	</div>
	
	<div class="clearfix">
	
	<?php foreach($articles as $article){?>
	<div class="item clearfix">
		<div class="pic fl"><img src="http://localhost/zhifu/images/default.jpg" alt=""  width="200" height="150"/></div>
		
		<div class="content fl">
			<div class="title"><a href="<?php echo ROOT_URL.'/article/detail?id='.$article->id?>" title="<?php echo $article->title?>"><?php echo subString($article->title, 20)?></a></div>
			<div class="des">
				<?php echo $article->content?>
			
			</div>
		</div>
	</div><!--end for item-->
	<?php }?>
	</div>
</div><!--end for case-wrapper-->
	
</div>
<?php category_js($cat_array)?>

<script type="text/javascript">
$(document).ready(function(){
	catEventInitNormal();
});	
</script>