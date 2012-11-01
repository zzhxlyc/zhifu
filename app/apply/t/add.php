<h2>发布求职信息</h2>
<div class="filter clearfix">
	<div class="order">
		<?php if(is_company($User)){?>
		<a href="<?php echo RECRUIT_HOME.'/add'?>">发布招聘信息</a>
		<?php }?>
		<?php if(is_expert($User)){?>
		<a class="current">发布求职信息</a>
		<?php }?>
	</div>
</div><!--end for filter-->

<form action="" method="post">

<div class="row">
	<label for="title">职位名称</label>
	<input class="text wide" type="text" name="title" value="<?php echo $apply->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="identity">我的身份：</label>
	<input type="radio" name="identity" value="1" <?php $HTML->checked(1, $apply->identity)?>/>领域专家
	<input type="radio" name="identity" value="2" <?php $HTML->checked(2, $apply->identity)?>/>社会人才
	<input type="radio" name="identity" value="3" <?php $HTML->checked(3, $apply->identity)?>/>在校学生
	<input type="radio" name="identity" value="4" <?php $HTML->checked(4, $apply->identity)?>/>不限
	<span class="error"><?php echo $errors['identity']?></span>
</div>
<div class="row">
	<label for="name">姓名</label>
	<input class="text" type="text" name="name" value="<?php echo $apply->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>
<div class="row">
	<label for="sex">性别</label>
	<input type="radio" name="sex" value="1" <?php $HTML->checked(1, $apply->sex)?>/> 男
	<input type="radio" name="sex" value="2" <?php $HTML->checked(2, $apply->sex)?>/> 女
	<span class="error"><?php echo $errors['sex']?></span>
</div>
<div class="row">
	<label for="age">年龄</label>
	<input class="text" type="text" name="age" value="<?php echo $apply->age?>" />
	<span class="error"><?php echo $errors['age']?></span>
</div>
<div class="row">
	<label for="mobile">手机</label>
	<input class="text" type="text" name="mobile" value="<?php echo $apply->mobile?>" />
	<span class="error"><?php echo $errors['mobile']?></span>
</div>
<div class="row">
	<label for="email">电子邮箱</label>
	<input class="text" type="text" name="email" value="<?php echo $apply->email?>" />
	<span class="error"><?php echo $errors['email']?></span>
</div>
<div class="row">
	<label for="address">居住地</label>
	<input class="text wide" type="text" name="address" value="<?php echo $apply->address?>" />
	<span class="error"><?php echo $errors['address']?></span>
</div>
<div class="row">
	<label for="area">求职区域</label>
	<input class="text wide" type="text" name="area" value="<?php echo $apply->area?>" />
	<span class="error"><?php echo $errors['area']?></span>
</div>
<div class="row">
	<label for="degree">最高学历</label>
	<select name="degree">
		<option value="">选择学历</option>
		<option value="1" <?php $HTML->selected(1, $apply->degree)?>>专科</option>
		<option value="2" <?php $HTML->selected(2, $apply->degree)?>>本科</option>
		<option value="3" <?php $HTML->selected(3, $apply->degree)?>>研究生</option>
		<option value="4" <?php $HTML->selected(4, $apply->degree)?>>不限</option>
	</select>
	<span class="error"><?php echo $errors['degree']?></span>
</div>
<div class="row">
	<label for="year">行业经验</label>
	<input class="text" type="text" name="year" value="<?php echo $apply->year?>" />年
	<span class="error"><?php echo $errors['year']?></span>
</div>
<div class="row">
	<label for="title">项目经历</label>
	<textarea name="description" class="text"><?php echo $apply->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>	
</div>
<div class="row">
	<label for="title">自我评价</label>
	<textarea name="evaluate" class="text"><?php echo $apply->evaluate?></textarea>
	<span class="error"><?php echo $errors['evaluate']?></span>	
</div>
<div class="row">
	<label for="title">空闲时间</label>
	(点击选择空闲时间)
</div>
<div class="row clearfix">

	<div class="choose-time">
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
	<input type="submit" value="发布" class="btn fl">
	<a href="<?php echo $home?>" class="back-btn">返回</a>
</div>	

</form>

<script type="text/javascript">
$(document).ready(function(){
	timeChooseEventInit();
});	
	
</script>