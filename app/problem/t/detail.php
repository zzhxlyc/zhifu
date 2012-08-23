<?php include('sidebar.php')?>

<div class="main-content">
	<div class="section">
		<h3>项目状态
			<?php if(is_expert($User)){?>
			<a href="<?php echo $home.'/submit?id='.$Problem->id?>" class="join-btn btn">我要竞标</a>
			<?php }?>
		</h3>
		<div class="content status clearfix">
			<div class="status-item <?php $HTML->current($Problem->status, 0)?>">发布蓝图</div>
			<div class="status-item <?php $HTML->current($Problem->status, 1)?>">竞标中</div>
			<div class="status-item <?php $HTML->current($Problem->status, 2)?>">付款</div>
			<div class="status-item last  <?php $HTML->current($Problem->status, 3)?>">交付互评</div>
			
		</div>
	</div><!--end for section-->



	<div class="section">
		<h3>竞标专家（<?php echo count($solutions)?>）</h3>
		<div class="content line-list">
			<?php 
				foreach($solutions as $solution){
					$expert = $experts[$solution->expert];
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
					<a href="<?php echo $home."/item?problem=$Problem->id&item=$solution->id"?>">
					<?php echo $solution->title?>
					</a>
				</div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	<div class="section">
		<h3>难题介绍</h3>
		<div class="content">
			<?php echo $Problem->description?>
		</div>
		<div class="content">
			<?php if($Problem->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Problem->file"?>">点击下载</a>
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
		
		<input type="hidden" id="object" name="object" value="<?php echo $Problem->id?>" />
		<input type="hidden" id="type" name="type" value="<?php echo BelongType::PROBLEM?>" />
	</div><!--end for comment-section-->
	
</div><!--end for main-content-->

<script type="text/javascript">
	$('.op a').click(function(){
		var author=$(this).parent().parent().find('.author').text();
		$('#reply textarea').val('回复 '+author+'：');
	})
	
	$('.btn').click(function(){
		var object = $("#object").val();
		var type = $("#type").val();
		var content = $("#reply_content").val();
		if(content != ''){
			$.ajax({
				type: "POST",
				url: window.ROOT_URL + "/ajax/comment",
				data: "object="+object+"&type="+type+"&content="+content,
				success: function(msg){
					var r = parseInt(msg);
					if(r > 0){
						alert('回复成功');
						$("#reply_content").val('');
						var html=[];
						html.push('<div class="item">');
						html.push('<div class="comment-meta">');
						html.push('<a class="author" href="#">'+msg.id+'</a>');
						html.push('<span class="comment-time">'+msg.time+'</span>');
						html.push('<span class="op"><a href="javascript:void(0)">回复</a></span>');
						html.push('</span></div>');
						html.push('<p>'+content+'</p>');
						html.push('</div>');
						html=html.join('');
						$('.comment-section .content .item:eq(0)').before(html);
						
					}
					else if(r == -1){
						alert('请先登录');
					}
					else{
						alert('回复失败');
					}
				}
			});
		}
		else{
			alert('回复内容为空');
		}
	});
</script>