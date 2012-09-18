<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<form action="<?php echo $home.'/edit?id='.$message->id?>" method="post" >
<table>
<tr>
	<td>标题</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $message->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>内容</td>
	<td>
		<textarea name="content" rows="10" cols="80"><?php echo $message->content?></textarea>
		<span class="error"><?php echo $errors['content']?></span>
	</td>
</tr>
<tr>
	<td>发起用户</td>
	<td><?php echo BelongType::to_string($message->from_type)?> ：
		<?php echo $message->from_name?></td>
</tr>
<tr>
	<td>目标用户</td>
	<td><?php echo BelongType::to_string($message->to_type)?> ：
		<?php echo $message->to_name?></td>
</tr>
<tr>
	<td>阅读已否</td>
	<td><?php echo $message->read == 1 ? '是' : '否'?></td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
		<?php echo $HTML->hidden('id', $message->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>