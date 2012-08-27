<div class="topic">
	<h2><?php echo $topic->title?></h2>
	<div class="topic-meta">
		<span class="time"><?php echo $topic->time?></span>
		<span class="author">来自：
			<a href="<?php echo $topic->get_author_link()?>"><?php echo $topic->author?></a>
		</span>
		<span class="op">
			<a href="<?php echo $home.'/edit?id='.$topic->id?>">编辑</a>
		</span>
	</div>
	<div class="topic-content">
		<?php echo $topic->content?>
	</div>
	<div class="comment-list">
		<?php foreach($list as $o){?>
		<div class="item clearfix">
			<div class="comment-content">
				<div class="comment-meta">
					<?php echo $o->time?> 
					<a href="<?php echo $o->get_author_link()?>" class="author"><?php echo $o->author?></a>
					<span class="op">
						<a href="javascript:;" class="quote">引用</a>
						
						<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
					</span>
				</div>
				<p><?php echo $o->content?></p>
			</div>
		</div><!--end for item-->
		<?php }?>
	</div>	<!--end for comment-list-->
	
	<div class="page-wrapper">
		<?php output_page_list($links);?>
	</div>
	
	<div class="reply">
		<h2>我要回复</h2>
		<textarea id="content" class="" cols="30" rows="10"></textarea>
		<input type="hidden" id="parent" value="<?php echo $topic->id?>" />
		<a href="#" class="btn fl" onclick="reply()">回复</a>
		<a href="#" class="back-btn" onclick="location.href='<?php echo $home?>'">返回</a>
	</div>
	
</div><!--end for topic-->

<script type="text/javascript">
<!--


$('.quote').click(function(){
	var author=$(this).parent().parent().find('.author').text();
	var authorComment=$(this).parent().parent().parent().parent().find('p').text();
	$('#content').val('<blockquote><a href="#">'+author+'</a><p>'+authorComment+'</p></blockquote>');
	
});

function check_content(content){
	if(content == ''){
		return false;
	}
	return true;
}

function reply(){
	var content = $("#content").val();
	var parent = parseInt($("#parent").val());
	if(check_content(content) && parent > 0){
		$.ajax({
			type: "POST",
			url: window.ROOT_URL + '/topic/reply',
			data: "content="+content+"&parent="+parent,
			success: function(msg){
				alert(msg);
			}
		});
	}
	else{
		alert('error');
	}
}
//-->
</script>