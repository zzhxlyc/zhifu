<?php

function comment_div($comments, $links, $object, $type, $User){
?>
	<div class="section comment-section">
		<h3>留言</h3>
		<div class="content">
			<div class="comment-begin"></div>
			<?php foreach($comments as $comment){ ?>
			<div class="item">
				<div class="comment-meta">
					<a class="author" href="<?php echo get_author_link($comment)?>"><?php echo $comment->author?></a>
					<span class="comment-time"><?php echo $comment->time?></span>
					<?php if($User && $User->id != $comment->user){?>
					<span class="op">
						<a href="javascript:void(0)">回复</a>
					</span>
					<?php }?>
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
		
		<input type="hidden" id="object" name="object" value="<?php echo $object->id?>" />
		<input type="hidden" id="type" name="type" value="<?php echo $type?>" />
	</div><!--end for comment-section-->
<?php 	
}

function comment_js(){
?>
<script type="text/javascript">
	$('.op a').click(function(){
		var author=$(this).parent().parent().find('.author').text();
		$('#reply textarea').val('回复 '+author+'：');
	})
	
	$('#reply .btn').click(commentReplyEvent);
</script>
<?php 
}