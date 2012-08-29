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
			<?php if(is_expert_object($User, $Item)){?>
			<a href="<?php echo $home."/itemedit?idea=$Idea->id&item=$Item->id"?>">编辑</a>
			<?php }?>
			<?php if(is_company_object($User, $Idea)){?>
			<select class="idea_prize_choose">
				<option value="">设置奖项</option>
				<option value="1">采纳为一等奖</option>
				<option value="2">采纳为二等奖</option>
				<option value="3">采纳为三等奖</option>
			</select>
			<?php }?>
			<a href="<?php echo $home.'/detail?id='.$Idea->id?>" class="back-btn">返回</a>
		</div>
		<input type="hidden" id="idea" name="idea" value="<?php echo $Idea->id?>"/>
		<input type="hidden" id="item" name="item" value="<?php echo $Item->id?>"/>
	</div><!--end for section-->	
	
	
</div><!--end for main-content-->

<?php if(is_company_object($User, $Idea)){?>
<script type="text/javascript">
<!--
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
