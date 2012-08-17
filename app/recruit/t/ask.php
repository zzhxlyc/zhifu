<h2>添加求职信息</h2>

<form action="" method="post">

<div class="row">
	<label for="title">标题：</label>
	<input size="80" type="text" name="title" value="<?php echo $recruit->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="des">描述：</label>
	<textarea name="description" class="text"><?php echo $recruit->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
</div>
<div class="row">空闲时间：(点击选择空闲时间，为选表示面谈)</div>
<div class="row clearfix">

	<div class="choose-time">
	<?php 
		$array_day = array('上午', '下午', '晚上');
		for($i = 0;$i < 3;$i++){
			$array = array('周日','周一','周二','周三','周四','周五','周六');
			for($d = 0;$d < 7;$d++){
				$class = '';
				if($recruit->days[$d][$i] == 1){
					$class = 'selected';
				}
	?>
	<span class="day<?php echo $d;?> <?php echo $class?>"><?php echo $array[$d].$array_day[$i];?></span>
	<?php 
			}
		}
	?>
	</div>
	<span class="error"><?php echo $errors['available']?></span>
</div>
<div class="row">
	<input type="hidden" name="available" />
	<input type="submit" value="保存" class="btn">
	<input type="button" value="返回" class="btn" onclick="location.href='<?php echo $home?>'">
</div>	

</form>

<script type="text/javascript">
$(document).ready(function(){
	
	timeChooseEventInit();
	
	
});	
	
</script>