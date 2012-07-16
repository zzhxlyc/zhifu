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
		<input size="100" type="text" name="title" value="<?php echo $problem->title?>" />
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
	<?php $HTML->selected($problem->cat, $cat->id)?>><?php echo $cat->name?></option>
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
	<?php $HTML->selected($problem->subcat, $subcat->id)?>><?php echo $subcat->name?></option>
			<?php }?>
		</select>
		<span class="error"><?php echo $errors['subcat']?></span>
	</td>
</tr>
<tr>
	<td>描述</td>
	<td>
		<?php echo $problem->province?><?php echo $problem->city?><?php echo $problem->district?>
	</td>
</tr>
<tr>
	<td>描述</td>
	<td>
		<textarea name="description" rows="10" cols="80"><?php echo $problem->description?></textarea>
		<span class="error"><?php echo $errors['description']?></span>
	</td>
</tr>
<tr>
	<td>预算</td>
	<td>
		<input size="100" type="text" name="budget" value="<?php echo $problem->budget?>" />
		<span class="error"><?php echo $errors['budget']?></span>
	</td>
</tr>
<tr>
	<td>截止日期</td>
	<td>
		<input size="100" type="text" name="deadline" value="<?php echo $problem->deadline?>" />
		<span class="error"><?php echo $errors['deadline']?></span>
	</td>
</tr>
<tr>
	<td>附件</td>
	<td>
		<?php if($problem->file){?>
		<a href="<?php echo UPLOAD_HOME.'/'.$problem->file?>">下载附件</a>
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
		<?php echo $HTML->hidden('id', $problem->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>