<?php 
	if($error){
		echo $error;
	}
	else{
?>
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
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home."/index"?>'" />
		<?php echo $HTML->hidden('id', $admin->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>