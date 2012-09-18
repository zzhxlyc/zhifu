<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<h2>修改密码</h2>
<form action="<?php echo $home.'/pswd'?>" method="post" >
<div class="edit-left">

<div class="row">
	<label for="name">原密码</label>
	<input size="50" type="password" class="text" name="password" />
	<span class="error"><?php echo $errors['password']?></span>
</div>
<div class="row">
	<label for="name">新密码</label>
	<input size="50" type="password" class="text" name="password1" />
	<span class="error"><?php echo $errors['password1']?></span>
</div>
<div class="row">
	<label for="name">确认密码</label>
	<input size="50" type="password" class="text" name="password2" />
	<span class="error"><?php echo $errors['password2']?></span>
</div>

<div class="row">
	<input type="submit" value="保存"  class="btn" />
</div>
</form>

<?php 
	}
?>