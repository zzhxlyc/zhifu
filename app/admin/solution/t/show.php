<?php 
	if($error){
		echo $error;
	}
	else{
?>

<div class="row">
	<label for="name">难题名称</label>
	<?php echo $problem->title?>
</div>	

<div class="row">
	<label for="name">专家</label>
	<a href="<?php echo get_user_link($expert)?>"><?php echo $expert->username?></a>
</div>

<div class="row">
	<label for="name">方案</label>
	<?php echo $solution->title?>
</div>

<div class="row">
	<label for="name">详细描述</label>
	<?php echo $solution->description?>
</div>

<div class="row">
	<label for="name">进展状态</label>
	<?php echo $solution->get_status()?>
</div>

<div>
	<input type="button" value="返回" onclick="history.back()" />
</div>

<?php 
	}
?>

