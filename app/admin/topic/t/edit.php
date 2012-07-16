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
		<input size="100" type="text" name="title" value="<?php echo $topic->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>内容</td>
	<td>
		<textarea name="content" rows="10" cols="80"><?php echo $topic->content?></textarea>
		<span class="error"><?php echo $errors['content']?></span>
	</td>
</tr>
<tr>
	<td>层级</td>
	<td>
		<?php if($topic->parent != 0){?>
		<a href="<?php echo ADMIN_TOPIC_HOME.'/edit?id='.$topic->parent?>">父话题</a>
		<?php }?>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
		<?php echo $HTML->hidden('id', $topic->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>