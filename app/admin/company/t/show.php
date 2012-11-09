<?php 
	if($error){
		output_error($error, $home);
	}
	else{
?>
<form action="<?php echo ADMIN_COMPANY_HOME.'/verify'?>" method="post" >
<div class="row">
	<label for="name">企业名</label>
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
	<label for="name">手机</label>
	<?php echo $company->mobile?>
</div>
<div class="row">
	<label for="name">网址</label>
	<?php echo $company->url?>
</div>
<div class="row">
	<label for="name">难题数</label>
	<?php echo $company->problem_num?>
</div>
<!-- 
<div class="row">
	<label for="name">难题总金额</label>
	<?php echo $company->problem_budget?>
</div>
-->

<div class="row">
	<label for="name">专利数</label>
	<?php echo $company->patent_num?>
</div>
<!-- 
<div class="row">
	<label for="name">专利总金额</label>
	<?php echo $company->patent_budget?>
</div>
 -->

<div class="tag row">
	<label for="">擅长领域</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a class="old" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?></a>	
	<?php 
		}
	}
	?>
</div>
	
<div class="row">
	<label for="name">描述</label>
	<?php echo $company->description?>
</div>
<div class="row">
	<label for="name">头像</label>
	<?php if($company->image){?>
	<img src="<?php img($company->image)?>" width="200" height="150"/>
	<?php }?>
</div>
<div class="row">
	<label for="name">营业执照</label>
	<?php if($company->license){?>
	<a target="_blank" href="<?php download($company->license)?>">点击下载</a>
	<?php }?>
</div>

<div class="row">
	<?php if($company->verified == 0){?>
		<input type="submit" value="审核通过" />
	<?php }?>
		<input type="button" value="编辑" onclick="location.href='<?php echo $home."/edit?id=$company->id"?>'" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
		<?php echo $HTML->hidden('id', $company->id)?>
</div>
</form>
<?php 
	}
?>