<form action="" method="post">
<table>
<tr>
	<td>标题</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $video->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>网址</td>
	<td>
		<input size="100" type="text" name="url" value="<?php echo $video->url?>" />
		<span class="error"><?php echo $errors['url']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="添加" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	</td>
</tr>
</table>
</form>