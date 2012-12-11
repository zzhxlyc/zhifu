<?php 
	if($error){
		output_error($error, $home);
	}
	else{
?>
<form action="<?php echo ADMIN_EXPERT_HOME.'/verify'?>" method="post" >

<div class="row">
	<label for="name">姓名</label>
	<?php echo $expert->name?>
</div>
<div class="row">
	<label for="name">邮箱</label>
	<?php echo $expert->email?>
</div>
<div class="row">
	<label for="name">电话</label>
	<?php echo $expert->phone?>
</div>
<div class="row">
	<label for="name">手机</label>
	<?php echo $expert->mobile?>
</div>
<div class="row">
	<label for="name">网址</label>
	<?php echo $expert->url?>
</div>
<div class="row">
	<label for="job">职业</label>
	<?php echo $expert->job?>
</div>
<div class="row">
	<label for="workplace">工作单位</label>
	<?php echo $expert->workplace?>
</div>
<div class="row">
	<label for="name">专利数</label>
	<?php echo $expert->patent_num?>
</div>

<div class="row">
	<label for="name">难题数</label>
	<?php echo $expert->problem_num?>
</div>

<div class="tag row">
	<label for="">擅长领域</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a class="old" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?></a>	
	<?php 
		}
	}
	?>
</div>
	
<div class="row">
	<label for="name">描述</label>
	<?php echo $expert->description?>
</div>
<div class="row">
	<label for="name">头像</label>
	<?php if($expert->image){?>
	<img src="<?php img($expert->image)?>"  width="200" height="150"/>
	<?php }?>
</div>

<div class="row">
	<?php if($expert->verified == 0){?>
		<input type="submit" value="审核通过" />
	<?php }?>
		<input type="button" value="编辑" onclick="location.href='<?php echo $home."/edit?id=$expert->id"?>'" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
		<?php echo $HTML->hidden('id', $expert->id)?>
</div>

</form>
<?php 
	}
?>