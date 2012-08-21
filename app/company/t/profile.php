<div class="sidebar">
	<div class="pic">
		<img src="<?php img($Company->image, $Company->default_image())?>" alt="<?php echo $Company->name?>" width="200" height="150"/>
	</div>
	<div class="detail-profile">
		<p>姓名：<?php echo $Company->name?></p>
		<p>邮件：<?php echo $Company->email?></p>
		<p>电话：<?php echo $Company->phone?></p>
		<p>网址：<?php echo $Company->url?></p>
		<p>参与项目金额：<?php output_money($Company->budget)?></p>
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
	
	
</div><!--end for sidebar-->

<div class="main-content">
	<div class="section">
		<h3>所属项目</h3>
		<div class="list clearfix">
			<?php 
				foreach($problems as $problem){
			?>
			<div class="item">
				<div class="pic">
					<a href="<?php echo PROBLEM_HOME.'/detail?id='.$problem->id?>">
					<img src="<?php img($problem->image, $problem->default_image())?>" alt="" width="100" height="100"/>
					</a>
				</div>
				<div class="des">
					<a href="<?php echo PROBLEM_HOME.'/detail?id='.$problem->id?>">
					<?php echo $problem->title?>
					</a>
				</div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->
	
	<div class="section">
		<h3>购买的专利</h3>
		<div class="list clearfix">
			<?php 
				foreach($patents as $patent){
			?>
			<div class="item">
				<div class="pic">
					<a href="<?php echo PATENT_HOME.'/detail?id='.$patent->id?>">
					<img src="<?php img($patent->image, $patent->default_image())?>" alt="" width="100" height="100"/>
					</a>
				</div>
				<div class="des">
					<a href="<?php echo PATENT_HOME.'/detail?id='.$patent->id?>">
					<?php echo $patent->title?>
					</a>
				</div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->
	
	<div class="section">
		<h3>公司介绍</h3>
		<div class="content">
			<?php echo $Company->description?>
		</div>
	</div>	
	
	
</div><!--end for main-content-->