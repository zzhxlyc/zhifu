<?php 
	if($error){
		output_error($error, $home);
	}
	else{
?>
<form action="<?php echo ADMIN_EXPERT_HOME.'/verify'?>" method="post" >
<table>
<tr>
	<td>企业名</td>
	<td>
		<?php echo $expert->name?>
	</td>
</tr>
<tr>
	<td>邮箱</td>
	<td>
		<?php echo $expert->email?>
	</td>
</tr>
<tr>
	<td>电话</td>
	<td>
		<?php echo $expert->phone?>
	</td>
</tr>
<tr>
	<td>网址</td>
	<td>
		<?php echo $expert->url?>
	</td>
</tr>
<tr>
	<td>描述</td>
	<td>
		<div>
		<?php echo $expert->description?>
		</div>
	</td>
</tr>
<tr>
	<td>头像</td>
	<td>
		<?php if($expert->image){?>
			<img src="<?php echo UPLOAD_HOME.'/'.$expert->image?>" />
		<?php }?>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<?php if($expert->verified == 0){?>
		<input type="submit" value="审核通过" />
		<?php }?>
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>'" />
		<?php echo $HTML->hidden('id', $expert->id)?>
	</td>
</tr>
</table>
</form>
<?php 
	}
?>