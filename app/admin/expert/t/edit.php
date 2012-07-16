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
		<input size="100" type="text" name="name" value="<?php echo $expert->name?>" />
		<span class="error"><?php echo $errors['name']?></span>
	</td>
</tr>
<tr>
	<td>工作单位</td>
	<td>
		<input size="100" type="text" name=workplace value="<?php echo $expert->workplace?>" />
		<span class="error"><?php echo $errors['workplace']?></span>
	</td>
</tr>
<tr>
	<td>职位</td>
	<td>
		<input size="100" type="text" name="job" value="<?php echo $expert->job?>" />
		<span class="error"><?php echo $errors['job']?></span>
	</td>
</tr>
<tr>
	<td>邮箱</td>
	<td>
		<input size="100" type="text" name="email" value="<?php echo $expert->email?>" />
		<span class="error"><?php echo $errors['email']?></span>
	</td>
</tr>
<tr>
	<td>电话</td>
	<td>
		<input size="100" type="text" name="phone" value="<?php echo $expert->phone?>" />
		<span class="error"><?php echo $errors['phone']?></span>
	</td>
</tr>
<tr>
	<td>个人主页</td>
	<td>
		<input size="100" type="text" name="url" value="<?php echo $expert->url?>" />
		<span class="error"><?php echo $errors['url']?></span>
	</td>
</tr>
<tr>
	<td>描述</td>
	<td>
		<textarea name="description" rows="10" cols="80"><?php echo $expert->description?></textarea>
		<span class="error"><?php echo $errors['description']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
		<?php echo $HTML->hidden('id', $expert->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>