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
	
	<div class="section comment-section">
		<h3>留言</h3>
		<div class="content">
			<?php foreach($comments as $comment){ ?>
			<div class="item">
				<div class="comment-meta">
					<a class="author" href="<?php echo get_author_link($comment)?>"><?php echo $comment->author?></a>
					<span class="comment-time"><?php echo $comment->time?></span>
					<span class="op">
						<a href="javascript:void(0)">回复</a>
					</span>
				</div>
				<p><?php echo $comment->content?></p>
			</div><!--end for item-->
			<?php }?>
			
			<?php if(count($links) > 3){?>
			<div class="page-wrapper">
				<?php output_page_list($links);?>
			</div>
			<?php }?>
			
			
			<div class="reply" id="reply">
				<textarea name="" id="reply_content"></textarea>
				<a href="javascript:void(0)" class="btn">回复</a>
				
			</div>
		</div><!--end for content-->
		
		<input type="hidden" id="object" name="object" value="<?php echo $Company->id?>" />
		<input type="hidden" id="type" name="type" value="<?php echo BelongType::COMPANY?>" />
	</div><!--end for comment-section-->
	
</div><!--end for main-content-->

<script type="text/javascript">
	$('.op a').click(function(){
		var author=$(this).parent().parent().find('.author').text();
		$('#reply textarea').val('回复 '+author+'：');
	})
	
	$('#reply .btn').click(commentReplyEvent);
</script>