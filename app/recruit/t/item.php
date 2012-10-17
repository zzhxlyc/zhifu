
<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ('提交成功');
?>

<h2>申请职位</h2>

<div class="row">
	<label for="title">申请职位名称</label>
	<?php echo $recruit->title?>
</div>
<div class="row">
	<label for="title">发布用户</label>
	<a href="<?php echo get_user_link($publisher)?>"><?php echo $publisher->username?></a>
</div>

<div class="row">
	<label for="name">姓名</label>
	<?php echo $item->name?>
</div>
<div class="row">
	<label for="name">邮箱</label>
	<?php echo $item->email?>
</div>
<div class="row">
	<label for="name">电话</label>
	<?php echo $item->phone?>
</div>
<div class="row">
	<label for="name">手机</label>
	<?php echo $item->mobile?>
</div>
<div class="row">
	<label for="name">已上传的简历</label>
	<a target="_blank" href="<?php echo $home.'/resume?item='.$item->id?>">下载</a>
</div>
<div class="row">
	<input type="button" value="修改" class="btn fl" onclick="location.href='<?php echo $home.'/itemedit?id='.$item->id?>'">
	<input type="hidden" name="id" value="<?php echo $item->id?>">
	<a href="<?php echo $home.'/show?id='.$recruit->id?>" class="back-btn">返回</a>
</div>	

<?php 
	}
?>