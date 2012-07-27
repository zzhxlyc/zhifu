<?php 
	if($error){
		echo $error;
	}
	else{
?>
<form action="" method="post">
<table>
<tr>
	<td>标签名</td>
	<td>
		<input type="text" name="name" value="<?php echo $tag->name?>" />
		<span class="error"><?php echo $errors['name']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $index_page?>'" />
		<?php echo $HTML->hidden('id', $tag->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>