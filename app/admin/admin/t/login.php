<form action="" method="post">
<table>
<tr>
	<td>用户名</td>
	<td>
		<?php $HTML->text('user', $user);?>
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
	<td></td>
	<td>
		<input type="submit" value="登陆" />
	</td>
</tr>
</table>
</form>