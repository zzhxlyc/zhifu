<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<form action="<?php echo $home.'/edit?id='.$recruit->id?>" method="post" >
<div class="row">
	<label for="name">发起用户</label>
	<?php echo BelongType::to_string($recruit->type)?> ：
		<?php echo $recruit->author?>
</div>
<div class="row">
	<label for="name">状态</label>
	<select name="status">
		<option value="1" <?php $HTML->selected($recruit->status, 1)?>>有效</option>
		<option value="0" <?php $HTML->selected($recruit->status, 0)?>>关闭</option>
	</select>
</div>
<div class="row">
	<label for="name">描述</label>
	<textarea name="description" rows="10" cols="80"><?php echo $recruit->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
</div>
<div class="row">
	<label for="name">时间</label>
	<div class="choose-time">
	<?php 
		if(is_array($recruit->days)){
			$array_day = array('上午', '下午', '晚上');
			for($i = 0;$i < 3;$i++){
				$array = array('周日','周一','周二','周三','周四','周五','周六');
				for($d = 0;$d < 7;$d++){
					$class = '';
					if($recruit->days[$d][$i] == 1){
						$class = 'selected';
					}
	?>
	<span class="day<?php echo $d;?> <?php echo $class?>">
		<?php echo $array[$d].$array_day[$i];?></span>
	<?php 
				}
	?>
		
	<?php 
			}
		}
	?>
	</div>
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

<script type="text/javascript">
$(document).ready(function(){
	
	timeChooseEventInit();
	
	
});	
	
</script>
