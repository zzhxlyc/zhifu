<form action="" method="post">
<table>
<tr>
	<td>标签名</td>
	<td>
		<input type="text" name="name" value="<?php echo $word->name?>" />
		<span class="error"><?php echo $errors['name']?></span>
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