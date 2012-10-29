<?php 
	if($error){
		output_error($error);
	}
	else{
?>
<h2>用户中心 <a href="<?php echo COMPANY_HOME.'/edit'?>">编辑</a>
 <a href="<?php echo COMPANY_HOME.'/pswd'?>">修改密码</a></h2>
<div class="edit-left">

<div class="row">
	<label for="name">企业名称</label>
	<?php echo $company->name?>
</div>
<div class="row">
	<label for="name">联系人</label>
	<?php echo $company->contact?>
</div>
<div class="row">
	<label for="name">邮箱</label>
	<?php echo $company->email?>
</div>
<div class="row">
	<label for="name">电话</label>
	<?php echo $company->phone?>
</div>
<div class="row">
	<label for="name">网址</label>
	<?php echo $company->url?>
</div>

<div class="tag row">
	<label for="">领域标签</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?></a>	
	<?php 
		}
	}
	?>
</div>

<div class="row">
	<label for="name">公司简介</label>
	<?php echo $company->description?>
</div>

<div class="row">
	<label for="name">营业执照</label>
	<?php if($company->license){?>
	<a href="<?php download($company->license)?>">点击下载</a>
	<?php }?>
</div>

</div>	<!--end for edit-left-->

<div class="edit-right">
	
	<div class="row">
		<label for="name">头像</label>
		<?php if($company->image){?>
		<img width="200" height="150" src="<?php img($company->image)?>" />
		<?php }?>
	</div>

</div>	<!--end for edit-right-->
		
<?php 
	}
?>