<?php 
	if($error){
		echo $error;
	}
	else{
?>
<form action="" method="post" <?php $HTML->file_form_need()?> >
<table>
<tr>
	<td>标题</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $patent->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>行业一</td>
	<td>
		<select name="cat">
			<option value="">选择行业</option>
			<?php foreach($cat_list as $cat){?>
			<option value="<?php echo $cat->id?>" 
	<?php $HTML->selected($patent->cat, $cat->id)?>><?php echo $cat->name?></option>
			<?php }?>
		</select>
		<span class="error"><?php echo $errors['cat']?></span>
	</td>
	
</tr>
<tr>
	<td>行业二</td>
	<td>
		<select name="subcat">
			<option value="">选择行业</option>
			<?php foreach($subcat_list as $subcat){?>
			<option value="<?php echo $subcat->id?>" 
	<?php $HTML->selected($patent->subcat, $subcat->id)?>><?php echo $subcat->name?></option>
			<?php }?>
		</select>
		<span class="error"><?php echo $errors['subcat']?></span>
	</td>
</tr>
<tr>
	<td>描述</td>
	<td>
		<textarea name="description" rows="10" cols="80"><?php echo $patent->description?></textarea>
		<span class="error"><?php echo $errors['description']?></span>
	</td>
</tr>
<tr>
	<td>附件</td>
	<td>
		<?php if($patent->file){?>
		<a href="<?php echo UPLOAD_HOME.'/'.$patent->file?>">下载附件</a>
		<?php }?>
	</td>
</tr>
<tr>
	<td>新附件</td>
	<td>
		<input type="file" name="file" />
		<span class="error"><?php echo $errors['file']?></span>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="修改" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
		<?php echo $HTML->hidden('id', $patent->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>