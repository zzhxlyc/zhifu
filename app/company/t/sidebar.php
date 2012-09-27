<div class="sidebar">
	<div class="pic">
		<img src="<?php img($Company->image, $Company->default_image())?>" alt="<?php echo $Company->name?>" width="200" height="150"/>
	</div>
	<div class="detail-profile">
		<p>用户名：<?php echo $Company->username?></p>
		<p>姓名：<?php echo $Company->name?></p>
		<p>邮件：<?php echo $Company->email?></p>
		<p>电话：<?php echo $Company->phone?></p>
		<p>网址：<?php echo $Company->url?></p>
		<!-- <p>参与项目金额：<?php output_money($Company->budget)?>万元</p> -->
		<p>综合评价：<?php echo output_score($Company)?></p>
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
			<a target="_blank" href="<?php echo MESSAGE_HOME.'/send?user='.$Company->username?>">发送站内信</a>
		</div>
	</div><!--end for tag-->
	
</div><!--end for sidebar-->