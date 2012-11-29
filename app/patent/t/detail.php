<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">科技成果</a> >
	<a><?php echo $Patent->title?></a>
</div>

<?php include('sidebar.php');?>

<div class="main-content">
	 
	<div class="section">
		<h3>专利介绍
		<?php if(is_expert($User) && $User->id == $Patent->expert){?>
			<a href="<?php echo $home.'/edit?id='.$Patent->id?>" class="edit">编辑</a>
			<?php }?>
		</h3>
		<div class="content">
			<?php echo $Patent->description?>
		</div>
		<div class="content">
			<?php if($Patent->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Patent->file"?>">点击下载</a>
			<?php }?>
		</div>
	</div>	

	<!-- 
	<div class="section">
		<h3>购买者留言</h3>
		<div class="content line-list">
			<?php 
				foreach($deals as $deal){
					$buyer = $buyers[$deal->id];
			?>
			<div class="item clearfix">
				
				<div class="pic">
					<a target="_blank" href="<?php echo get_author_link($buyer->id, $buyer->get_type())?>">
					<img src="<?php img($buyer->image, $buyer->default_image())?>" alt="<?php echo $buyer->name?>"
						 width="100" height="100"/>
					</a>
					<span class="name">
						<a target="_blank" href="<?php echo get_author_link($buyer->id, $buyer->get_type())?>">
						<?php output_username($buyer)?>
						</a>
					</span>
				</div>
				
				<div class="des">
					<p><?php echo $deal->note?></p>
					<p>购买时间：<?php echo $deal->time?></p>
					<?php if(is_expert_object($User, $deal) || is_his_object($User, $deal)){?>
					<p>购买者：<a href="<?php echo get_author_link($deal->belong, $deal->type)?>"><?php echo $deal->name?></a></p>
					<p>联系方式：<?php echo $deal->phone?></p>
					<p>评估价格：<?php echo $deal->price?></p>
					<?php }?>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
	 -->
	
	<div class="section patent-comment">
		<h3>相关咨询与投资意向</h3>
		<div class="content line-list">
			<?php 
				foreach($deals as $deal){
					$buyer = $buyers[$deal->id];
					$comments = $comments_map[$deal->id];
			?>
			<div class="one_item">
			<div class="item">
				<div class="meta">
					<span><a href="<?php echo get_author_link($buyer->id, $buyer->get_type())?>"><?php echo $buyer->username?></a></span>
					<?php if($deal->dis1){?>
					来自：<span><?php output_district($deal)?></span>
					<?php }?>
					<span><?php echo $deal->time?></span>
					<input class="deal_id" type="hidden" value="<?php echo $deal->id?>" />
				</div>
				<div class="des">
					<?php echo $deal->note?>
				</div>
				<div class="price clearfix">
					<span>评估价值：<?php echo $deal->price?></span> &nbsp;&nbsp;&nbsp;&nbsp;
					<?php if(is_expert_object($User, $Patent) || is_his_object($User, $deal)){?>
					<span>姓名：<?php echo $deal->name?></span> &nbsp;&nbsp;&nbsp;&nbsp;
					<span>联系方式：<?php echo $deal->phone?></span>
					<?php }?>
				 	<span class="fr"><a href="javascript:void(0)" class="reply">回复</a></span>
				</div>
				<div class="comm"></div>
			</div><!--end for item-->
			<div class="child_item_list">
				<?php
					if(count($comments) > 0){ 
					foreach($comments as $comment){
				?>
				<div class="child-item">
					<div class="meta">
						<span><a href="<?php echo get_author_link($comment->id, $comment->type)?>"><?php echo $comment->username?></a></span>
						<?php if($comment->dis1){?>
						来自：<span><?php output_district($comment)?></span>
						<?php }?>
						<span><?php echo $comment->time?></span>
					</div>
					<div class="des"><?php echo $comment->comment?></div>
				</div>
				<?php }}?>
			</div>
			</div>
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	<div id="deal_div" class="leave-comment section">
		<h3>如果您有意向投资或咨询，请给技术持有人留言</h3>
		<div class="row">
			<label for="name">您的姓名</label>
			<input size="50" type="text" class="text" id="deal_name" value="" />
			<span class="error"><?php echo $errors['name']?></span>
		</div>
		<div class="row">
			<label for="name">您的电话</label>
			<input size="50" type="text" class="text" id="deal_phone" value="" />
			<span class="error"><?php echo $errors['phone']?></span>
		</div>
		<div class="row">
			<label for="name">评估价格</label>
			<input size="50" type="text" class="text" id="deal_price" value="" />
			<span>您认为这个技术价值多少</span>
			<span class="error"><?php echo $errors['price']?></span>
		</div>
		<div class="row clearfix">
			<label for="name">留言</label>
			<textarea rows="3" cols="70" id="deal_note" class="text fl"></textarea>
			<span class="error"><?php echo $errors['note']?></span> <br>
			<p style="clear:both;padding-left:70px;padding-top:10px">
			提示：给技术持有人留言，简要说明您的投资意向或问题，勿在详细内容里留下电话以防骚扰</p>
		</div>
		<div class="row">
			<label for="name"></label>
			<input type="button" value="提交" class="btn fl" onclick="deal_submit()">
			<input type="hidden" id="patent_id" value="<?php echo $Patent->id?>">
		</div>
	</div>
	
</div><!--end for main-content-->

<script type="text/javascript">
<!--
$(".reply").toggle(
	function (){
		var deal_id = $(this).parents(".item").find(".deal_id").val();;
		var html = '<div>'+
			'<textarea rows="3" cols="80" id="comment"></textarea>'+
			'<input type="hidden" class="d" value="'+deal_id+'" />'+
			'<input type="button" value="提交" class="btn" onclick="dealitem_submit(this)" />'+
			'</div>';
		$(this).parents(".item").find(".comm").append(html);
	},
	function (){
		$(this).parents(".item").find(".comm").html("");
	}
);
function deal_submit(){
	var name = $("#deal_name").val();
	var phone = $("#deal_phone").val();
	var price = $("#deal_price").val();
	var note = $("#deal_note").val();
	var patent_id = $("#patent_id").val();
	if(name == ''){
		alert('姓名为空');
		return false;
	}
	else if(phone == ''){
		alert('电话为空');
		return false;
	}
	else if(price == ''){
		alert('价格为空');
		return false;
	}
	var d = "patent="+patent_id
			+"&name="+name
			+"&phone="+phone
			+"&price="+price
			+"&note="+note;
	$.ajax({
		type: "POST",
		url: window.ROOT_URL + "/patent/deal",
		data: d,
		dataType:'json',
		success: function(ret){
			if(ret.succ == 1){
				location.href = window.ROOT_URL + '/patent/detail?id=' + patent_id;
			}
			else{
				alert(ret.error);
			}
		}
	});
}
function dealitem_submit(dom){
	var patent_id = $("#patent_id").val();
	var $div = $(dom).parents("div");
	var comment = $div.find("textarea").val();
	var deal_id = $div.find(".d").val();
	if(comment == ''){
		alert('评论为空');
		return false;
	}
	var d = "patent="+patent_id
			+"&deal="+deal_id
			+"&comment="+comment;
	$.ajax({
		type: "POST",
		url: window.ROOT_URL + "/patent/dealitem",
		data: d,
		dataType:'json',
		success: function(ret){
			if(ret.succ == 1){
				var html = '<div class="child-item">'+
								'<div class="meta">'+
									'<span>'+ret.username+'</span>';
				if(ret.dis1){
					html += '来自：<span>'+ret.dis1+' '+ret.dis2+'</span>';
				}
				html += 		'<span>'+ret.time+'</span>'+
							'</div>'+
							'<div class="des">'+comment+'</div>'+
						'</div>';
				var item = $(dom).parents(".one_item");
				item.find(".reply").click();
				item.find(".child_item_list").append(html);
			}
			else{
				alert(ret.error);
			}
		}
	});
}
//-->
</script>
