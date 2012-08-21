<form action="" method="post">
<table>
<tr>
	<td>用户名</td>
	<td>
		<?php $HTML->text('user', $admin->user);?>
		<span class="error"><?php echo $errors['user']?></span>
	</td>
</tr>
<tr>
	<td>密码</td>
	<td>
		<input type="password" name="password" />
		<span class="error"><?php echo $errors['password']?></span>
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
		<input type="submit" value="添加" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
	</td>
</tr>
</table>
</form>