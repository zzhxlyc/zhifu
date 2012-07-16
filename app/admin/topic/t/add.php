<form action="" method="post" >
<table>
<tr>
	<td>标题</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $topic->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>内容</td>
	<td>
		<textarea name="content" rows="10" cols="80"><?php echo $topic->content?></textarea>
		<span class="error"><?php echo $errors['content']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="发布" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
	</td>
</tr>
</table>
</form>