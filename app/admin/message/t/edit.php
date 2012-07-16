<?php 
	if($error){
		echo $error;
	}
	else{
?>
<form action="" method="post" >
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
	<td>信息发起用户</td>
	<td><?php echo $message->from?></td>
</tr>
<tr>
	<td>信息目标用户</td>
	<td><?php echo $message->to?></td>
</tr>
<tr>
	<td>是否已被阅读</td>
	<td><?php echo $message->read == 1 ? 'Y' : 'N'?></td>
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