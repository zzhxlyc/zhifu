<?php 
	if($error){
		output_error($error);
	}
	else{
?>

<form action="" method="post" >
	
<div class="row">
	<label for="name">难题名称</label>
	<?php echo $problem->title?>
</div>

<div class="row always-show">
	<label for="">电话</label>
	<?php echo $problem->phone?>
</div>
<div class="row always-show">
	<label for="">手机</label>
	<?php echo $problem->mobile?>
</div>
<div class="row always-show">
	<label for="">邮箱</label>
	<?php echo $problem->email?>
</div>

<div class="row">
	<label for="cat">所属行业</label>
	<?php echo $problem->catname?> <?php echo $problem->subcatname?>
</div>

<div class="row">
	<label for="">地区</label>
	<?php output_pcd($problem);?>
</div>	


<div class="row">
	<label for="budget">预算</label>
	<?php echo $problem->budget?>万元
</div>


<div class="row">
	<label for="deadline">截止日期</label>
	<?php output_deadline($o->deadline)?>
</div>

<div class="tag row">
	<label for="">领域标签</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?></a>	
	<?php 
		}
	}
	?>
</div>

<div class="row">
	<label for="">详细描述</label>
	<?php echo $problem->description?>
</div>

<div class="row">
	<label for="">图片</label>
	<?php if($problem->image){?>
	<img width="400" src="<?php echo UPLOAD_HOME."/$problem->image"?>" />
	<?php }else{?>
	还没有图片
	<?php }?>
</div>

<div class="row">
	<label for="">附件</label>
	<?php if($problem->file){?>
	<a target="_blank" href="<?php echo UPLOAD_HOME."/$problem->file"?>">点击下载</a>
	<?php }else{?>
	还没有附件
	<?php }?>
</div>


<div class="row">
	<input type="submit" value="审核通过" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<?php echo $HTML->hidden('id', $problem->id)?>
</div>

</form>

<div>
	<input type="hidden" name="cat" value="<?php echo $problem->cat?>" />
	<input type="hidden" name="subcat" value="<?php echo $problem->subcat?>" />
	<input type="hidden" name="province" value="<?php echo $problem->province?>" />
	<input type="hidden" name="city" value="<?php echo $problem->city?>" />
	<input type="hidden" name="district" value="<?php echo $problem->district?>" />
</div>

<script type="text/javascript">
<!--
var catList = {<?php 
	$l = array();
	foreach($cat_array as $id => $cat){
		$c = array();
		foreach($cat['c'] as $iid => $subcat){
			$n = $subcat['name'];
			$c[] = "{'id':$iid, 'name':'$n'}";
		}
		$l[] = sprintf("\n%d:{'id':%d, 'n':'%s', 'c':[%s]}", 
						$id, $id, $cat['name'], join(',', $c));
	}
	echo join(',', $l)."\n";
?>
};

//-->
</script>


<script type="text/javascript">
$(document).ready(function($){
	
	provinceEventInit();	
	catEventInit();
	
	
});	
</script>

<?php 
	}
?>

