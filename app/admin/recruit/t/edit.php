<?php 
	if($error){
		echo $error;
	}
	else{
?>
<form action="" method="post" >
<div class="row">
	<label for="name">发起用户</label>
	<?php echo BelongType::to_string($recruit->type)?> ：
		<?php echo $recruit->user_name?>
</div>
<div class="row">
	<label for="name">状态</label>
	<select name="status">
		<option value="0" <?php $HTML->selected($recruit->status, 0)?>>招聘中</option>
		<option value="1" <?php $HTML->selected($recruit->status, 1)?>>已关闭</option>
	</select>
</div>
<div class="row">
	<label for="name">时间</label>
	<?php 
		if(is_array($recruit->days)){
			for($i = 0;$i < 3;$i++){
	?>
		<div>
	<?php 
				for($d = 0;$d < 7;$d++){
	?>
	<span><?php echo '周'.$d;?></span>
	<?php 
				}
	?>
		</div>
	<?php 
			}
		}
	?>
</div>
<div class="row">
	<input type="submit" value="修改" />
	<input type="button" value="返回" onclick="location.href='<?php echo $index_page?>'" />
	<?php echo $HTML->hidden('id', $recruit->id)?>
	<?php echo $HTML->hidden('available', '')?>
</div>
</form>
<?php 
	}
?>