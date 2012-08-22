<?php 
	if($error){
		echo $error;
	}
	else{
?>

<div class="row">
	<label for="name">创意名称</label>
	<?php echo $idea->title?>
</div>	

<div class="row">
	<label for="name">专家</label>
	<?php echo $expert->name?>
</div>

<div class="row">
	<label for="name">方案</label>
	<?php echo $item->title?>
</div>

<div class="row">
	<label for="name">详细描述</label>
	<?php echo $item->content?>
</div>

<div class="row">
	<label for="name">进展状态</label>
	<?php echo $item->get_status()?>
</div>

<div>
	<input type="button" value="返回" onclick="history.back()" />
</div>

<?php 
	}
?>

