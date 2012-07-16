<?php 
	if($error){
		echo $error;
	}
	else{
?>
<form action="" method="post" >
<table>
<tr>
	<td><?php echo $recruit->typeName?>用户</td>
	<td><?php echo $recruit->name?></td>
</tr>
<tr>
	<td>时间</td>
	<td>
		<?php print_r($recruit->days);?>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
		<?php echo $HTML->hidden('id', $recruit->id)?>
		<?php echo $HTML->hidden('available', '')?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>