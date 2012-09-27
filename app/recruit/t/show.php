<h2>兼职/顾问信息</h2>

<div class="row">
	<label for="title">发布者</label>
	<a target="_blank" href="<?php echo get_author_link($recruit->belong, $recruit->type)?>"><?php output_username($recruit, 2)?></a>
</div>

<div class="row">
	<label for="title">职位名称</label>
	<?php echo $recruit->title?>
</div>
<div class="row">
	<label for="title">招聘人数</label>
	<?php echo $recruit->num?>
</div>
<div class="row">
	<label for="title">招聘对象</label>
	<?php output_identity($recruit->identity)?>
</div>
<div class="row">
	<label for="title">专业要求</label>
	<?php echo $recruit->specialty?>
</div>
<div class="row">
	<label for="area">工作地点</label>
	<?php echo $recruit->area?>
</div>
<div class="row">
	<label for="degree">学历要求</label>
	<?php output_degree($recruit->degree)?>
</div>
<div class="row">
	<label for="pay">薪资待遇</label>
	<?php echo $recruit->pay?>
</div>
<div class="row">
	<label for="age">年龄要求</label>
	<?php echo $recruit->age?>
</div>
<div class="row">
	<label for="eatroom">提供食宿</label>
	<?php if($recruit->eatroom == 1){echo '是';}else {echo '否';}?>
</div>
<div class="row">
	<label for="des">职位描述</label>
	<?php echo $recruit->description?>
</div>
<div class="row">
	<input type="button" value="修改" class="btn fl" onclick="location.href='<?php echo $home.'/edit?id='.$recruit->id?>'">
	<a href="<?php echo $home?>" class="back-btn">返回</a>
</div>

