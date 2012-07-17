<form action="" method="post" <?php $HTML->file_form_need()?>>
<table>
<tr>
	<td>链接文字</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $link->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>链接网址</td>
	<td>
		<input size="100" type="text" name="url" value="<?php echo $link->url?>" />
		<span class="error"><?php echo $errors['url']?></span>
	</td>
</tr>
<tr>
	<td>图片</td>
	<td>
		<input type="file" name="img" />
		<span class="error"><?php echo $errors['img']?></span>
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