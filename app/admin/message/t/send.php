<form action="" method="post" >
<table>
<tr>
	<td>发送用户</td>
	<td>
		<input size="50" type="text" name="to_name" value="<?php echo $message->to_name?>" />
		<span class="error"><?php echo $errors['to_name']?></span>
	</td>
</tr>
<tr>
	<td>标题</td>
	<td>
		<input size="80" type="text" name="title" value="<?php echo $message->title?>" />
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
	<td></td>
	<td>
		<input type="submit" value="发送" />
		<input type="button" value="返回" onclick="location.href='<?php echo $index_page?>'" />
	</td>
</tr>
</table>
</form>