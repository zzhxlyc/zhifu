<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<form action="" method="post">
<table>
<tr>
	<td>名称</td>
	<td>
		<input size="30" type="text" name="name" value="<?php echo $videocat->name?>" />
		<span class="error"><?php echo $errors['name']?></span>
	</td>
</tr>
<tr>
	<td>父类</td>
	<td>
		<?php 
			foreach($cat_list as $cat){
				if($cat->id == $videocat->parent){
					echo $cat->name;
				}
			}
		?>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="hidden" name="id" value="<?php echo $videocat->id?>" />
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/cat'" />
	</td>
</tr>
</table>
</form>
<?php 
	}
?>