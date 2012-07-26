<?php 
	if($error){
		echo $error;
	}
	else{
?>
<form action="" method="post">
<table>
<tr>
	<td>原密码</td>
	<td>
		<input type="password" name="password" />
		<span class="error"><?php echo $errors['password']?></span>
	</td>
</tr>
<tr>
	<td>新密码</td>
	<td>
		<input type="password" name="password1" />
		<span class="error"><?php echo $errors['password1']?></span>
	</td>
</tr>
<tr>
	<td>确认密码</td>
	<td>
		<input type="password" name="password2" />
		<span class="error"><?php echo $errors['password2']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
	</td>
</tr>
</table>
</form>
<?php 
	}
?>