<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<form action="<?php echo $home.'/edit?id='.$video->id?>" method="post">
<table>
<tr>
	<td>标题</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $video->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>简介</td>
	<td>
		<textarea cols="90" rows="10" name="desc" class="text"><?php echo $video->desc?></textarea>
		<span class="error"><?php echo $errors['desc']?></span>
	</td>
</tr>
<tr>
	<td>网址</td>
	<td>
		<input size="100" type="text" name="url" value="<?php echo $video->url?>" />
		<span class="error"><?php echo $errors['url']?></span>
	</td>
</tr>
<tr>
	<td>图片</td>
	<td>
		<?php if($video->image){?>
		<img src="<?php img($video->image)?>"/>
		<?php }?>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
		<?php echo $HTML->hidden('id', $video->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>