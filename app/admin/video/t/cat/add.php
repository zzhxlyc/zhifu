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
		<select name="parent">
			<option value="0">选择类别</option>
			<?php 
				foreach($cat_list as $cat){
			?>
			<option value="<?php echo $cat->id?>" <?php $HTML->selected($videocat->parent, $cat->id)?>><?php echo $cat->name?></option>
			<?php 
				}
			?>
		</select>
		<span class="error"><?php echo $errors['parent']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="添加" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/cat'" />
	</td>
</tr>
</table>
</form>
