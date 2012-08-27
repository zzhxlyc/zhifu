<?php include('sidebar.php');?>

<div class="main-content">
	<div class="section">
		<h3>创意状态
			<?php if(is_expert($User)){?>
			<a href="<?php echo $home.'/submit?id='.$Idea->id?>" class="join-btn btn">我有创意</a>
			<?php }?>
			<?php if(is_company($User) && $User->id == $Idea->company){?>
			<a href="<?php echo $home.'/edit?id='.$Idea->id?>" class="edit">编辑</a>
			<?php }?>
			
		</h3>
		<div class="content status clearfix">
			<div class="status-item <?php $HTML->current($Idea->status, 0)?>">竞标中</div>
			<div class="status-item <?php $HTML->current($Idea->status, 1)?>">评奖中</div>
			<div class="status-item last  <?php $HTML->current($Idea->status, 2)?>">结束</div>
		</div>
	</div><!--end for section-->



	<div class="section">
		<h3>竞标专家（<?php echo count($items)?>）</h3>
		<div class="content line-list">
			<?php 
				foreach($items as $item){
					$expert = $experts[$item->expert];
			?>
			<div class="item clearfix">
				<div class="pic">
					<a target="_blank" href="<?php echo EXPERT_HOME.'/profile?id='.$expert->id?>">
					<img src="<?php img($expert->image)?>" alt="<?php echo $expert->name?>"
						 width="100" height="100"/>
					</a>
					<span class="name">
						<a target="_blank" href="<?php echo EXPERT_HOME.'/profile?id='.$expert->id?>">
						<?php echo $expert->name?>
						</a>
					</span>
				</div>
				<div class="des">
					<a href="<?php echo $home."/item?idea=$Idea->id&item=$item->id"?>">
					<?php echo $item->title?>
					</a>
				</div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	<div class="section">
		<h3>创意介绍</h3>
		<div class="content">
			<?php echo $Idea->description?>
		</div>
		<div class="content">
			<?php if($Idea->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Idea->file"?>">点击下载</a>
			<?php }?>
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
		
		<input type="hidden" id="object" name="object" value="<?php echo $Idea->id?>" />
		<input type="hidden" id="type" name="type" value="<?php echo BelongType::IDEA?>" />
	</div><!--end for comment-section-->
	
</div><!--end for main-content-->

<script type="text/javascript">
<!--
$(".idea_finish").click(function (){
	var idea = $("#object").val();
	$.ajax({
		type: "POST",
		url: window.ROOT_URL + "/idea/finish",
		data: "idea="+idea,
		success: function(msg){
			if(msg == '0'){
				alert('success');
			}
			else{
				alert(msg);
			}
		}
	});
});
$('.op a').click(function(){
	var author=$(this).parent().parent().find('.author').text();
	$('#reply textarea').val('回复 '+author+'：');
})

$('#reply .btn').click(commentReplyEvent);
</script>
