<div class="sidebar">
	<div class="pic">
		<img src="<?php img($Expert->image, $Expert->default_image())?>" 
			alt="<?php echo $Expert->name?>" width="150" height="150"/>
	</div>
	<div class="detail-profile">
		<p>用户名：<?php echo $Expert->username?></p>
		<p>姓名：<?php echo $Expert->name?></p>
		<p>邮箱：<?php echo $Expert->email?></p>
		<p>电话：<?php echo $Expert->phone?></p>
		<p>网址：<?php echo $Expert->url?></p>
		<p>所在单位：<?php echo $Expert->workplace?></p>
		<p>职称：<?php echo $Expert->job?></p>
		<p>综合评价：<?php echo output_score($Expert)?></p>
	</div><!--end for detail-profile-->
	
	<div class="side-section">
		<div class="title"><h4>擅长领域</h4></div>
		<div class="content">
			<?php foreach($tags as $tag){?>
			<span class="item"><?php echo $tag->name?></span>
			<?php }?>
		</div>
	</div><!--end for tag-->
	
	<div class="side-section">
		<div class="title"><h4>操作</h4></div>
		<div class="content">
			<?php if($User->id != $Expert->id || $User->get_type() != $Expert->get_type()){?>
			<a target="_blank" href="<?php echo MESSAGE_HOME.'/send?user='.$Expert->username?>">发送站内信</a>
			<?php }?>
		</div>
	</div><!--end for tag-->
	
</div><!--end for sidebar-->