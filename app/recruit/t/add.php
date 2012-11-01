<h2>发布招聘信息</h2>
<div class="filter clearfix">
	<div class="order">
		<?php if(is_company($User)){?>
		<a class="current">发布招聘信息</a>
		<?php }?>
		<?php if(is_expert($User)){?>
		<a href="<?php echo APPLY_HOME.'/add'?>">发布求职信息</a>
		<?php }?>
	</div>
</div><!--end for filter-->

<form action="" method="post">

<div class="row">
	<label for="title">职位名称</label>
	<input class="text wide" type="text" name="title" value="<?php echo $recruit->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="title">招聘人数</label>
	<input class="text" type="text" name="num" value="<?php echo $recruit->num?>" />
	<span class="error"><?php echo $errors['num']?></span>
</div>
<div class="row">
	<label for="title">招聘对象</label>
	<input type="radio" name="identity" value="1" <?php $HTML->checked(1, $recruit->identity)?> /> 领域专家
	<input type="radio" name="identity" value="2" <?php $HTML->checked(2, $recruit->identity)?>/> 社会人才
	<input type="radio" name="identity" value="3" <?php $HTML->checked(3, $recruit->identity)?>/> 在校学生
	<input type="radio" name="identity" value="4" <?php $HTML->checked(4, $recruit->identity)?>/> 不限
	<span class="error"><?php echo $errors['identity']?></span>
</div>
<div class="row">
	<label for="title">专业要求</label>
	<input class="text wide" type="text" name="specialty" value="<?php echo $recruit->specialty?>" />
	<span class="error"><?php echo $errors['specialty']?></span>
</div>
<div class="row">
	<label for="area">工作地区</label>
	<input class="text wide" type="text" name="area" value="<?php echo $recruit->area?>" />
	<span class="error"><?php echo $errors['area']?></span>
</div>
<div class="row">
	<label for="degree">学历要求</label>
	<select name="degree">
		<option value="">选择学历</option>
		<option value="1" <?php $HTML->selected(1, $recruit->degree)?>>专科</option>
		<option value="2" <?php $HTML->selected(2, $recruit->degree)?>>本科</option>
		<option value="3" <?php $HTML->selected(3, $recruit->degree)?>>研究生</option>
		<option value="4" <?php $HTML->selected(4, $recruit->degree)?>>不限</option>
	</select>
	<span class="error"><?php echo $errors['degree']?></span>
</div>
<div class="row">
	<label for="pay">薪资待遇</label>
	<input class="text" type="text" name="pay" value="<?php echo $recruit->pay?>" />
	<span class="error"><?php echo $errors['pay']?></span>
</div>
<div class="row">
	<label for="age">年龄要求</label>
	<input class="text" type="text" name="age" value="<?php echo $recruit->age?>" />
	<span class="error"><?php echo $errors['age']?></span>
</div>
<div class="row">
	<label for="eatroom">提供食宿</label>
	<input type="radio" name="eatroom" value="1" <?php $HTML->checked(1, $recruit->eatroom)?>/> 是
	<input type="radio" name="eatroom" value="2" <?php $HTML->checked(2, $recruit->eatroom)?>/> 否
	<span class="error"><?php echo $errors['eatroom']?></span>
</div>
<div class="row">
	<label for="des">职位描述</label>
	<textarea name="description" class="text"><?php echo $recruit->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
</div>
<div class="row">
	<input type="submit" value="发布" class="btn fl">
	<a href="<?php echo $home?>" class="back-btn">返回</a>
</div>	

</form>
