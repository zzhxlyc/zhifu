<?php include('sidebar.php');?>

<div class="main-content">
	
	<div class="section">
		<h3>
			<?php echo $Item->title?>
			<?php if(is_company_object($User, $Idea)){?>
			<a class="edit"><?php echo $Item->get_status();?></a>
			<?php }?>
		</h3>
		<div class="content line-list">
			<?php echo $Item->content?>
		</div><!--end for list-->
		<div>
			<?php if(is_expert_object($User, $Item) && $Idea->status == 0){?>
			<a href="<?php echo $home."/itemedit?idea=$Idea->id&item=$Item->id"?>">编辑</a>
			<?php }?>
			<?php if(is_company_object($User, $Idea) && $Idea->status < 2){?>
			<select class="idea_prize_choose">
				<option value="">设置奖项</option>
				<option value="1">采纳为一等奖</option>
				<option value="2">采纳为二等奖</option>
				<option value="3">采纳为三等奖</option>
			</select>
			<?php }?>
		</div>
		<input type="hidden" id="idea" name="idea" value="<?php echo $Idea->id?>"/>
		<input type="hidden" id="item" name="item" value="<?php echo $Item->id?>"/>
	</div><!--end for section-->
	
	<?php if(is_company_object($User, $Idea)){?>
	<div class="section">
		<h3>创意提供者：<?php echo $Expert->name?></h3>
		<div class="content line-list">
			<?php echo $Expert->description?>
		</div><!--end for list-->
	</div><!--end for section-->
	<?php }?>
	
	<?php if($Item->status >= 1 && is_company_object($User, $Idea)){?>
	<div class="section">
		<h3>给中标者评分</h3>
		<div class="rating">
			<a href="javascript:;" rank="1"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star1" alt="" /></a>
			<a href="javascript:;" rank="2"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star2" alt="" /></a>
			<a href="javascript:;" rank="3"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star3" alt="" /></a>
			<a href="javascript:;" rank="4"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star4" alt="" /></a>
			<a href="javascript:;" rank="5"><img src="<?php echo IMAGE_HOME.'/star_d.png'?>" id="star5" alt="" /></a>
		</div>
		
		<div>
			<form action="<?php echo $home.'/score'?>" method="post">
				<input type="hidden" name="id" value="<?php echo $Idea->id?>" />
				<input type="hidden" name="itemid" value="<?php echo $Item->id?>" />
				<input type="hidden" name="score" value="<?php echo $score?>" />
				<?php if(!$score){?>
				<input type="submit" value="提交" class="btn fl" />
				<?php }?>
			</form>
		</div>
	</div><!--end for section-->
	<?php }?>
	
	<div class="section">
		<div class="content line-list">
			<a href="<?php echo $home.'/detail?id='.$Idea->id?>" class="back-btn">返回</a>
		</div><!--end for list-->
	</div><!--end for section-->
	
</div><!--end for main-content-->

<?php if(is_company_object($User, $Idea)){?>
<script type="text/javascript">
<!--
scoreEventInit();

$(".idea_prize_choose").change(function (){
	var prize = this.value;
	var idea = $("#idea").val();
	var item = $("#item").val();
	if(prize != ''){
		$.ajax({
			type: "POST",
			url: window.ROOT_URL + "/idea/choose",
			data: "prize="+prize+"&idea="+idea+"&item="+item,
			success: function(msg){
				if(msg == '0'){
					alert('评奖成功');
				}
				else{
					alert(msg);
				}
			}
		});
	}
});
//-->
</script>
<?php }?>
