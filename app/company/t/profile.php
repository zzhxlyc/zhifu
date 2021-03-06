<?php include('sidebar.php')?>

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
	
	<?php comment_div($comments, $links, $Company, BelongType::COMPANY, $User)?>
	
</div><!--end for main-content-->

<?php comment_js()?>