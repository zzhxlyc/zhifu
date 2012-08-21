<div class="sidebar">
	<div class="pic">
		<img src="<?php img($Expert->image, $Expert->default_image())?>" alt="<?php echo $Expert->name?>" width="200" height="150"/>
	</div>
	<div class="detail-profile">
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
	
	
</div><!--end for sidebar-->

<div class="main-content">
	<div class="section">
		<h3>我的专利</h3>
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
		<h3>我参与的项目</h3>
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
		<h3>专家介绍</h3>
		<div class="content">
			<?php echo $Expert->description?>
		</div>
	</div>	
	
	
</div><!--end for main-content-->