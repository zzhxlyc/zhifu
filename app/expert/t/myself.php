<?php 
	if($error){
		output_error($error, $home);
	}
	else{
?>
<h2>用户中心 <a href="<?php echo EXPERT_HOME.'/edit'?>">编辑</a>
 <a href="<?php echo COMPANY_HOME.'/pswd'?>">修改密码</a></h2>
<div class="edit-left">
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
	<label for="name">网址</label>
	<?php echo $expert->url?>
</div>
<div class="row">
	<label for="name">职业</label>
	<?php echo $expert->job?>
</div>
<div class="row">
	<label for="name">工作单位</label>
	<?php echo $expert->workplace?>
</div>

<div class="tag row">
	<label for="">领域标签</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?></a>	
	<?php 
		}
	}
	?>
</div>
	
<div class="row">
	<label for="name">自我介绍</label><br/><br/>
	<?php echo $expert->description?>
</div>

</div>	<!--end for edit-left-->

<div class="edit-right">

<div class="row">
	<label for="name">头像</label>
	<?php if($expert->image){?>
	<img width="200" height="150" src="<?php img($expert->image)?>" />
	<?php }?>
</div>

</div>

</form>

<?php 
	}
?>