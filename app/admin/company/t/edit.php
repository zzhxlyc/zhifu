<?php 
	if($error){
		output_error($error, $home);
	}
	else{
?>
<form action="" method="post" >
<div class="row">
	<label for="name">企业名</label>
	<input size="100" type="text" name="name" value="<?php echo $company->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>
<div class="row">
	<label for="name">邮箱</label>
	<input size="100" type="text" name="email" value="<?php echo $company->email?>" />
	<span class="error"><?php echo $errors['email']?></span>
</div>
<div class="row">
	<label for="name">电话</label>
	<input size="100" type="text" name="phone" value="<?php echo $company->phone?>" />
	<span class="error"><?php echo $errors['phone']?></span>
</div>
<div class="row">
	<label for="name">网址</label>
	<input size="100" type="text" name="url" value="<?php echo $company->url?>" />
	<span class="error"><?php echo $errors['url']?></span>
</div>
<div class="row">
	<label for="tag">领域标签</label>
	<input size="20" type="text" value="" id="new-tag" /> 
	<a href="javascript:;" id="add-tag">添加</a>
</div>	

<div class="tag row">
	<label for="">标签</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a href="javascript:;" class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?><img src="../../images/delete.png"></a>	
	<?php 
		}
	}
	?>
	<input type="hidden" name="new_tag" />
	<input type="hidden" name="old_tag" />
</div>
	
<div class="row">
	<label for="name">描述</label><br/><br/>
	<textarea class="ckeditor" name="description" rows="10" cols="80"><?php echo $company->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
</div>
<div class="row">
	<label for="name">营业执照</label>
	<?php if($company->license){?>
	<a href="<?php download($company->license)?>">点击下载</a>
	<?php }?>
</div>

<div class="row">
	<?php if($company->verified == 0){?>
	<input type="submit" value="审核通过" />
	<?php }?>
	<input type="submit" value="保存" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home."/show?id=$company->id"?>'" />
	<?php echo $HTML->hidden('id', $company->id)?>
</div>
</form>

<script type="text/javascript">
$(document).ready(function($){
	tagEventInit();
});	
</script>

<?php 
	}
?>