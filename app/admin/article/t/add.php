<form action="" method="post" <?php $HTML->file_form_need()?> >
<table>
<tr>
	<td>标题</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $article->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>内容</td>
	<td>
		<textarea name="content" rows="10" cols="80"><?php echo $article->content?></textarea>
		<span class="error"><?php echo $errors['content']?></span>
	</td>
</tr>
<tr>
	<td>附件</td>
	<td>
		<input type="file" name="file" />
		<span class="error"><?php echo $errors['file']?></span>
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