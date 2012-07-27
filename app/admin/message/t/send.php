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
	<td>发送用户</td>
	<td>
		<input size="50" type="text" name="to_name" value="<?php echo $message->to_name?>" />
		<span class="error"><?php echo $errors['to_name']?></span>
	</td>
</tr>
<tr>
	<td>用户类型</td>
	<td>
		<select name="to_type">
			<option value="">选择用户</option>
			<option value="Expert" <?php $HTML->selected($message->to_type, 'Expert')?>>专家用户</option>
			<option value="Company" <?php $HTML->selected($message->to_type, 'Company')?>>企业用户</option>
		</select>
		<span class="error"><?php echo $errors['to_type']?></span>
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