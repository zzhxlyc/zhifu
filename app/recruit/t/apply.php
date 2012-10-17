
<?php 
	if($error){
		output_error($error);
	}
	else{
?>

<h2>申请职位</h2>

<form action="" method="post" <?php $HTML->file_form_need()?>>

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
	<input size="50" type="text" class="text" name="name" value="<?php echo $item->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>
<div class="row">
	<label for="name">性别</label>
	<input type="radio" name="sex" value="1" <?php $HTML->checked(1, $item->sex)?>/> 男
	<input type="radio" name="sex" value="2" <?php $HTML->checked(2, $item->sex)?>/> 女
	<span class="error"><?php echo $errors['sex']?></span>
</div>
<div class="row">
	<label for="name">邮箱</label>
	<input size="50" type="text" class="text"  name="email" value="<?php echo $item->email?>" />
	<span class="error"><?php echo $errors['email']?></span>
</div>
<div class="row">
	<label for="name">电话</label>
	<input size="50" type="text" class="text"  name="phone" value="<?php echo $item->phone?>" />
	<span class="error"><?php echo $errors['phone']?></span>
</div>
<div class="row">
	<label for="name">手机</label>
	<input size="50" type="text" class="text"  name="mobile" value="<?php echo $item->mobile?>" />
	<span class="error"><?php echo $errors['mobile']?></span>
</div>
<?php if($item->resume){?>
<div class="row">
	<label for="name">已上传的简历</label>
	<a target="_blank" href="<?php download($item->resume)?>">下载</a>
</div>
<?php }?>
<div class="row">
	<label for="name">简历</label>
	<input type="file" name="resume" />
	<span class="error"><?php echo $errors['resume']?></span>
	<span>附件最大20M</span>
</div>
<div class="row">
	<input type="submit" value="提交" class="btn fl">
	<input type="hidden" name="id" value="<?php echo $recruit->id?>"/>
	<a href="<?php echo $home.'/show?id='.$recruit->id?>" class="back-btn">返回</a>
</div>	

</form>

<?php 
	}
?>