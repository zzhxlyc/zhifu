<?php include('sidebar.php');?>

<div class="main-content">
	
	<div class="section">
		<h3><?php echo $Item->title?></h3>
		<div class="content line-list">
			<?php echo $Item->content?>
		</div><!--end for list-->
		<div>
			<a href="<?php echo $home."/itemedit?idea=$Idea->id&item=$Item->id"?>">编辑</a>
			<select class="idea_prize_choose">
				<option value="1">采纳为一等奖</option>
				<option value="2">采纳为二等奖</option>
				<option value="3">采纳为三等奖</option>
			</select>
			<a href="<?php echo $home.'/detail?id='.$Idea->id?>" class="back-btn">返回</a>
		</div>
		<input type="hidden" id="idea" name="idea" value="<?php echo $Idea->id?>"/>
		<input type="hidden" id="item" name="item" value="<?php echo $Item->id?>"/>
	</div><!--end for section-->	
	
	
</div><!--end for main-content-->

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
					alert('success');
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
