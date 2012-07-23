<?php 
	if($error){
		echo $error;
	}
	else{
?>
<form action="" method="post" <?php $HTML->file_form_need()?> >
	
<div class="row">
	<label for="name">难题名称</label>
	<input size="100" type="text" name="title" value="<?php echo $problem->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>	
<div class="row">
	<label for="cat">所属行业</label>
	
	<select name="cat">
		<option value="">选择行业</option>
		<?php foreach($cat_list as $cat){?>
		<option value="<?php echo $cat->id?>" 
<?php $HTML->selected($problem->cat, $cat->id)?>><?php echo $cat->name?></option>
		<?php }?>
	</select>
	<span class="error"><?php echo $errors['cat']?></span>
	
	
	<select name="subcat">
		<option value="">选择行业</option>
		<?php foreach($subcat_list as $subcat){?>
		<option value="<?php echo $subcat->id?>" 
<?php $HTML->selected($problem->subcat, $subcat->id)?>><?php echo $subcat->name?></option>
		<?php }?>
	</select>
	<span class="error"><?php echo $errors['subcat']?></span>
</div>

<div class="row">
	
	<label for="">地区</label>
	<div class="province_city"></div>	
</div>	


<div class="row">
	<label for="budget">预算</label>
		<input size="20" type="text" name="budget" value="<?php echo $problem->budget?>" />万元
		<span class="error"><?php echo $errors['budget']?></span>
</div>


<div class="row">
	<label for="deadline">截止日期</label>
		<input size="20" type="text" name="deadline" class="datepicker" value="<?php echo $problem->deadline?>" />
		<span class="error"><?php echo $errors['deadline']?></span>
</div>

<div class="row">
	<label for="tag">领域标签</label>
	<input size="100" type="text" name="tag" value="" />
		
</div>


<div class="row">
	<label for="">详细描述</label>
	<textarea name="description" rows="10" cols="80"><?php echo $problem->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
</div>
<div class="row">
	附件
	<input type="file" name="file" />
	<span class="error"><?php echo $errors['file']?></span>
</div>


<div class="row">
	<input type="submit" value="修改" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
	<?php echo $HTML->hidden('id', $problem->id)?>
</div>

</form>
<?php 
	}
?>