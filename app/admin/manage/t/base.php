<form action="" method="post" <?php echo $HTML->file_form_need()?>>
<table>
<tr>
	<td>Logo设置</td>
	<td>
		<img alt="" src="<?php img($logo)?>">
		<input type="file" name="logo" />
	</td>
</tr>
<tr>
	<td>网站标题</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $title?>" />
	</td>
</tr>
<tr>
	<td>网站标语</td>
	<td>
		<input size="100" type="text" name="slogan" value="<?php echo $slogan?>" />
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
	</td>
</tr>
</table>
</form>
