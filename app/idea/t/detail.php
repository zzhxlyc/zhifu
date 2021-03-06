<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">创意悬赏</a> >
	<a><?php echo $Idea->title?></a>
</div>

<?php include('sidebar.php');?>

<div class="main-content">
	<div class="section">
		<h3>创意状态
			<?php if(is_expert($User) && $Idea->status == 0){?>
			<a href="<?php echo $home.'/submit?id='.$Idea->id?>" class="join-btn btn">我有创意</a>
			<?php }?>
			<?php if(is_company($User) && $User->id == $Idea->company && $Idea->status == 0){?>
			<a href="<?php echo $home.'/edit?id='.$Idea->id?>" class="edit">编辑</a>
			<?php }?>
		</h3>
		<div class="content status clearfix">
			<div class="status-item <?php $HTML->current($Idea->status, 0)?>">投稿中</div>
			<div class="status-item <?php $HTML->current($Idea->status, 1)?>">评奖中</div>
			<div class="status-item  <?php $HTML->current($Idea->status, 2)?>">发放奖金</div>
			<div class="status-item last  <?php $HTML->current($Idea->status, 3)?>">结束</div>
		</div>
	</div><!--end for section-->

	<?php if($Idea->status >= 2){?>
	<div class="section">
		<?php 
			$array = array('一等奖'=>$one_list, '二等奖'=>$two_list, '三等奖'=>$three_list);
			foreach($array as $title => $list){
				if($list && count($list) > 0){
		?>
		<h3><?php echo $title?></h3>
		<div class="content line-list" style="padding: 0px">
			<?php 
				foreach($list as $item){
					$expert = $experts[$item->expert];
			?>
			<div class="item clearfix">
				<div class="pic">
					<span class="name">
						<a target="_blank" href="<?php echo EXPERT_HOME.'/profile?id='.$expert->id?>">
						<?php echo $expert->username?>
						</a>
						<?php if(is_company_object($User, $Idea)){?>
						<br/>
						<!-- <a href="<?php echo $home."/item?idea=$Idea->id&item=$item->id"?>">
						给TA评分
						</a> -->
						<?php }?>
						<?php if(is_expert_object($User, $item)){?>
						<br/>
						<a href="<?php echo $home.'/score?id='.$Idea->id?>">给企业评分</a>
						<?php }?>
					</span>
				</div>
				<div class="des">
					<?php if(is_company_object($User, $Idea) || is_expert_object($User, $item)){?>
					<a href="<?php echo $home."/item?idea=$Idea->id&item=$item->id"?>">
					<?php echo $item->title?>
					</a>
					<?php 
						}else{
							echo $item->title;
						}
					?>
				</div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
		<?php 
				}
			}
		?>
	</div><!--end for section-->
	<?php }?>

	<div class="section">
		<h3>共提交（<?php echo count($items)?>）个方案 
			<?php if(is_company_object($User, $Idea)){?>
			<?php if($Idea->status == 0){?>
				<a href="javascript:void(0)" class="idea_finish" style="float: right;">结束提交方案</a>
			<?php }else if($Idea->status == 1){?>
			<a href="javascript:void(0)" class="idea_done" style="float: right;">结束评奖</a>
			<?php }?>
			<?php }?>
		</h3>
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
					<a target="_blank" href="<?php echo EXPERT_HOME.'/profile?id='.$expert->id?>">
					<span class="name"><?php echo $item->username?></span>
					</a>
				</div>
				<div class="des">
					<?php 
						if(is_company_object($User, $Idea) || is_expert_object($User, $item)){
					?>
					<h4>
						<a href="<?php echo $home."/item?idea=$Idea->id&item=$item->id"?>">
						<?php echo $item->title?>
						</a>
					</h4>
					<?php }else{?>
					<h4><?php echo $item->title?></h4>
					<?php }?>
					<p><?php output_desc($item->content)?></p>
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
	
	<?php comment_div($comments, $links, $Idea, BelongType::IDEA, $User)?>
	
</div><!--end for main-content-->

<?php comment_js()?>


<?php if(is_company_object($User, $Idea)){?>
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
				alert('已成功结束提交');
//				$(".idea_finish").hide();
				location.href = window.ROOT_URL + '/idea/detail?id=' + idea;
			}
			else{
				alert(msg);
			}
		}
	});
});
$(".idea_done").click(function (){
	var idea = $("#object").val();
	$.ajax({
		type: "POST",
		url: window.ROOT_URL + "/idea/done",
		data: "idea="+idea,
		success: function(msg){
			if(msg == '0'){
				alert('已成功结束评奖');
//				$(".idea_finish").hide();
				location.href = window.ROOT_URL + '/idea/detail?id=' + idea;
			}
			else{
				alert(msg);
			}
		}
	});
});
</script>
<?php }?>