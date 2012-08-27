<h2>添加求职信息</h2>

<div class="row">
	<label for="title">标题：</label>
	<?php echo $recruit->title?>
</div>
<div class="row">
	<label for="name">状态</label>
	<?php echo $recruit->get_status()?>
</div>
<div class="row">
	<label for="des">描述：</label>
	<?php echo $recruit->description?>
</div>
<div class="row clearfix">
	<label for="available">时间：</label>
	<div class="choose-time no-margin">
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
	<input type="button" value="修改" class="btn fl" onclick="location.href='<?php echo $home.'/edit?id='.$recruit->id?>'">
	<a href="<?php echo $home?>" class="back-btn">返回</a>
</div>	
