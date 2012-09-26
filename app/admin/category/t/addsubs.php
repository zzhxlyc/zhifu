<form action="" method="post" >
<table>
<tr>
	<td>父行业</td>
	<td>
		<select name="parent">
			<option value="">选择父行业</option>
			<?php foreach($list as $cate){?>
			<option value="<?php echo $cate->id?>" 
				<?php $HTML->selected($parent, $cate->id)?>>
				<?php echo $cate->name?></option>
			<?php }?>
		</select>
		<span class="error"><?php echo $errors['parent']?></span>
	</td>
</tr>
<tr>
	<td>子行业</td>
	<td>
		<textarea rows="5" cols="70" name="names"><?php echo $names?></textarea>
		<span class="error"><?php echo $errors['names']?></span>
		以,(英文标点)为分隔符
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