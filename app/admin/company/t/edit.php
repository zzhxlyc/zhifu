<?php 
	if($error){
		output_error($error, $home);
	}
	else{
?>
<form action="" method="post" >
<table>
<tr>
	<td>企业名</td>
	<td>
		<input size="100" type="text" name="name" value="<?php echo $company->name?>" />
		<span class="error"><?php echo $errors['name']?></span>
	</td>
</tr>
<tr>
	<td>邮箱</td>
	<td>
		<input size="100" type="text" name="email" value="<?php echo $company->email?>" />
		<span class="error"><?php echo $errors['email']?></span>
	</td>
</tr>
<tr>
	<td>电话</td>
	<td>
		<input size="100" type="text" name="phone" value="<?php echo $company->phone?>" />
		<span class="error"><?php echo $errors['phone']?></span>
	</td>
</tr>
<tr>
	<td>网址</td>
	<td>
		<input size="100" type="text" name="url" value="<?php echo $company->url?>" />
		<span class="error"><?php echo $errors['url']?></span>
	</td>
</tr>
<tr>
	<td>描述</td>
	<td>
		<textarea name="description" rows="10" cols="80"><?php echo $company->description?></textarea>
		<span class="error"><?php echo $errors['description']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
		<?php echo $HTML->hidden('id', $company->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>