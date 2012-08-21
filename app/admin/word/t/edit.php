<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<form action="<?php echo $home.'/edit?id='.$word->id?>" method="post">
<table>
<tr>
	<td>敏感词</td>
	<td>
		<input type="text" name="name" value="<?php echo $word->name?>" />
		<span class="error"><?php echo $errors['name']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
		<?php echo $HTML->hidden('id', $word->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>