<div class="sidebar">
	<div class="pic">
		<img src="<?php img($Expert->image, $Expert->default_image())?>" alt="<?php echo $Expert->name?>" width="200" height="150"/>
	</div>
	<div class="detail-profile">
		<p>用户名：<?php echo $Expert->username?></p>
		<p>姓名：<?php echo $Expert->name?></p>
		<p>所在单位：<?php echo $Expert->workplace?></p>
		<p>职称：<?php echo $Expert->job?></p>
		<p>参与项目金额：<?php output_money($Expert->budget)?></p>
		<p>综合评价：<?php echo output_score($Expert)?></p>
	</div><!--end for detail-profile-->
	
	<div class="side-section">
		<div class="title"><h4>领域标签</h4></div>
		<div class="content">
			<?php foreach($tags as $tag){?>
			<span class="item"><?php echo $tag->name?></span>
			<?php }?>
		</div>
	</div><!--end for tag-->
	
	<div class="side-section">
		<div class="title"><h4>操作</h4></div>
		<div class="content">
			<a target="_blank" href="<?php echo MESSAGE_HOME.'/send?user='.$Expert->username?>">发送站内信</a>
		</div>
	</div><!--end for tag-->
	
</div><!--end for sidebar-->