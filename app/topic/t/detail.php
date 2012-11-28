<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">话题</a> > 
	<a><?php echo $topic->title?></a>
</div>

<div class="topic">
	<h2><?php echo $topic->title?></h2>
	<div class="topic-meta">
		<span class="time"><?php echo $topic->time?></span>
		<span class="author">来自:<a href="<?php echo $topic->get_author_link()?>"><?php echo $topic->username?></a>
		</span>
		<span class="op">
			<?php if($User && $User->id == $topic->belong && $User->get_type() == $topic->type){?>
			<a href="<?php echo $home.'/edit?id='.$topic->id?>">编辑</a>
			<?php }?>
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
					<span class="time"><?php echo $o->time?> </span>
					
					<a href="<?php echo $o->get_author_link()?>" class="author"><?php echo $o->username?></a>
					<span class="op">
						<?php if($User){?>
						<a href="javascript:;" class="quote">引用</a>
						<?php }?>
						<?php if($User && $User->get_type() == $o->type
								 && $User->id == $o->belong){?>
						<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
						<?php }?>
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
		<a href="javascript:;" class="btn fl" onclick="reply()">回复</a>
		<a href="javascript:;" class="back-btn" onclick="location.href='<?php echo $home?>'">返回</a>
	</div>
	
</div><!--end for topic-->

<script type="text/javascript">
<!--
function quoteEvent(){
	var author=$(this).parent().parent().find('.author').text();
	var time=$(this).parent().parent().find('.time').text();
	
	var authorComment=$(this).parent().parent().parent().parent().find('p').text();
	$('#content').val('<blockquote>以下是引用<a href="javascript:;">'+author+'</a>在'+time+'的回复<p>'+authorComment+'</p></blockquote>');
	
}

$('.quote').click(quoteEvent);

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
			dataType: 'json',
			success: function(msg){
				$("#content").val('');
				var html=[];
				
				html.push('<div class="item clearfix">');
				html.push('<div class="comment-content">')
				html.push('<div class="comment-meta">');
				html.push('<span class="time">'+msg.time+'</span> <a class="author" target="_blank" href="'+window.ROOT_URL+'/'+msg.type+'/profile?id='+msg.uid+'">'+(msg.name.length==0?msg.username:msg.username)+'</a>');
				html.push('<span class="op"><a href="javascript:;" class="quote">引用</a><a href="'+window.ROOT_URL+'/topic/edit?id='+msg.id+'">编辑</a></span>');
				html.push('</span></div>');
				html.push('<p>'+content+'</p>');
				html.push('</div>');
				html.push('</div>');
				
				html=html.join('');
				
				
				$('.comment-list').append(html);
				$('.quote').click(quoteEvent);
				
				
			}
		});
	}
	else{
		alert('error');
	}
}
//-->
</script>