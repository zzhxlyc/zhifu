<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<h2>用户中心</h2>
<form action="<?php echo $home.'/edit'?>" method="post" <?php $HTML->file_form_need()?>>
<div class="edit-left">

<div class="row">
	<label for="name">企业名称</label>
	<input size="50" type="text" class="text" name="name" value="<?php echo $company->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>
<div class="row">
	<label for="name">联系人</label>
	<input size="50" type="text" class="text" name="contact" value="<?php echo $company->contact?>" />
	<span class="error"><?php echo $errors['contact']?></span>
</div>
<div class="row">
	<label for="name">邮箱</label>
	<input size="50" type="text" class="text" name="email" value="<?php echo $company->email?>" />
	<span class="error"><?php echo $errors['email']?></span>
</div>
<div class="row">
	<label for="name">电话</label>
	<input size="50" type="text" class="text" name="phone" value="<?php echo $company->phone?>" />
	<span class="error"><?php echo $errors['phone']?></span>
</div>
<div class="row">
	<label for="name">网址</label>
	<input size="50" type="text" class="text" name="url" value="<?php echo $company->url?>" />
	<span class="error"><?php echo $errors['url']?></span>
</div>
<div class="row">
	<label for="tag">领域标签</label>
	<input size="20" type="text" class="text" value="" id="new-tag" /> 
	<a href="javascript:;" id="add-tag">添加</a>
</div>	

<div class="tag row">
	<label for="">标签</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a href="javascript:;" class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?><img src="<?php echo IMAGE_HOME?>/delete.png"></a>	
	<?php 
		}
	}
	?>
	<input type="hidden" name="new_tag" />
	<input type="hidden" name="old_tag" />
</div>
<div class="hot-tag row">
	<label for="">热门标签</label>
	<?php 
	if(is_array($most_common_tags)){
		foreach($most_common_tags as $tag){
	?>
		<a href="javascript:;" count="<?php echo $tag['count']?>" tagid="<?php echo $tag['id']?>" id="tag_<?php echo $tag['id']?>"><?php echo $tag['name']?></a>	
	<?php 
		}
	}
	?>
</div>

</div>	<!--end for edit-left-->
<div class="edit-right">
	
	<div class="row">
		<label for="name">头像</label>
		<input type="file" name="image" />
		<?php if($company->image){?>
		<img width="250" src="<?php img($company->image)?>" />
		<?php }?>
	</div>

</div>	<!--end for edit-right-->
		
<div class="row">
	<label for="name">公司简介</label><br/><br/>
	<textarea class="ckeditor" name="description" rows="10" cols="80"><?php echo $company->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
</div>

<div class="row">
	<label for="name">营业执照</label>
	<input type="file" name="license" />
	<?php if($company->license){?>
	<a href="<?php download($company->license)?>">点击下载</a>
	<?php }?>
</div>

<div class="row">
	<input type="submit" value="修改" class="btn fl" />
	<a href="<?php echo $home.'/myself'?>" class="back-btn">返回</a>
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