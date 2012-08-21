<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<form action="<?php echo $home.'/edit?id='.$category->id?>" method="post" >
<table>
<tr>
	<td>父行业</td>
	<td>
		<input type="text" name="name" value="<?php echo $category->name?>" />
		<span class="error"><?php echo $errors['name']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="保存" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
		<?php echo $HTML->hidden('id', $category->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>