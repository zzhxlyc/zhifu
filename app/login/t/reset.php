<?php 
	if(isset($error)){
?>
<span><?php echo $error?></span>
<?php 
	}else{
?>
<form action="" method="post" >
<div class="row">
	<label for="">新密码</label>
	<input class="text" type="password" name="pswd" />
	<span class="error"><?php echo $errors['pswd']?></span>
</div>
<div class="row">
	<label for="">确认密码</label>
	<input class="text" type="password" name="pswd2" />
	<span class="error"><?php echo $errors['pswd2']?></span>
</div>
<div class="row">
	<input type="submit" value="修改" />
	<input type="hidden" value="<?php echo $code?>" name="code" />
</div>
</form>
<?php }?>