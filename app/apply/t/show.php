<h2>求职信息</h2>

<div class="row">
	<label for="title">发布者</label>
	<a target="_blank" href="<?php echo get_author_link($apply->belong, $apply->type)?>"><?php output_username($apply, 2)?></a>
</div>

<div class="row">
	<label for="title">职位名称</label>
	<?php echo $apply->title?>
</div>
<div class="row">
	<label for="identity">我的身份</label>
	<?php output_identity($apply->identity)?>
</div>
<div class="row">
	<label for="name">姓名</label>
	<?php echo $apply->name?>
</div>
<div class="row">
	<label for="sex">性别</label>
	<?php output_sex($apply->sex)?>
</div>
<div class="row">
	<label for="age">年龄</label>
	<?php echo $apply->age?>
</div>
<div class="row">
	<label for="mobile">手机</label>
	<?php echo $apply->mobile?>
</div>
<div class="row">
	<label for="email">电子邮箱</label>
	<?php echo $apply->email?>
</div>
<div class="row">
	<label for="address">居住地</label>
	<?php echo $apply->address?>
</div>
<div class="row">
	<label for="area">求职区域</label>
	<?php echo $apply->area?>
</div>
<div class="row">
	<label for="degree">最高学历</label>
	<?php output_degree($apply->degree)?>
</div>
<div class="row">
	<label for="year">行业经验</label>
	<?php echo $apply->year?> 年
</div>
<div class="row">
	<label for="title">项目经历</label>
	<?php echo $apply->description?>
</div>
<div class="row">
	<label for="title">自我评价</label>
	<?php echo $apply->evaluate?>
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
				if($apply->days[$d][$i] == 1){
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
	<?php if($User->id == $apply->belong && $User->get_type() == $apply->type){?>
	<input type="button" value="修改" class="btn fl" onclick="location.href='<?php echo $home.'/edit?id='.$apply->id?>'">
	<?php }?>
	<a href="<?php echo $home?>" class="back-btn">返回</a>
</div>	
