<?php 
	if($error){
		output_error($error, $home);
	}
	else{
?>
<form action="<?php echo ADMIN_COMPANY_HOME.'/verify'?>" method="post" >
<table>
<tr>
	<td>企业名</td>
	<td>
		<?php echo $company->name?>
	</td>
</tr>
<tr>
	<td>邮箱</td>
	<td>
		<?php echo $company->email?>
	</td>
</tr>
<tr>
	<td>电话</td>
	<td>
		<?php echo $company->phone?>
	</td>
</tr>
<tr>
	<td>网址</td>
	<td>
		<?php echo $company->url?>
	</td>
</tr>
<tr>
	<td>描述</td>
	<td>
		<div>
		<?php echo $company->description?>
		</div>
	</td>
</tr>
<tr>
	<td>营业执照</td>
	<td><a href="<?php echo UPLOAD_HOME.'/'.$company->license?>">点击下载</a></td>
</tr>
<tr>
	<td></td>
	<td>
		<?php if($company->verified == 0){?>
		<input type="submit" value="审核通过" />
		<?php }?>
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
		<?php echo $HTML->hidden('id', $company->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>