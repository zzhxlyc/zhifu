<form action="" method="post" <?php echo $HTML->file_form_need()?>>
<table>
<tr>
	<td>Logo设置</td>
	<td>
		<img alt="" src="<?php echo $logo?>">
		<input type="file" name="logo" />
	</td>
</tr>
<tr>
	<td>网站标题</td>
	<td>
		<input type="text" name="title" value="<?php echo $title?>" />
	</td>
</tr>
<tr>
	<td>网站标语</td>
	<td>
		<input type="text" name="slogan" value="<?php echo $slogan?>" />
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
	</td>
</tr>
</table>
</form>
