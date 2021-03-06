<div class="filter clearfix">
	<div class="order">
		<a href="#" <?php $HTML->if_current($type == 0)?> id="normal-add">详细发布</a>
		<a href="#" <?php $HTML->if_current($type == 1)?> id="simple-add">简洁发布</a>
	
	</div>

</div><!--end for filter-->

<form action="" method="post" <?php $HTML->file_form_need()?>>

<h2>发布技术难题</h2>

<div>
	<input type="hidden" name="cat" value="<?php echo $problem->cat?>" />
	<input type="hidden" name="subcat" value="<?php echo $problem->subcat?>" />
	<input type="hidden" name="province" value="<?php echo $problem->province?>" />
	<input type="hidden" name="city" value="<?php echo $problem->city?>" />
	<input type="hidden" name="district" value="<?php echo $problem->district?>" />
	<input type="hidden" name="province2" value="<?php echo $problem->province2?>" />
	<input type="hidden" name="city2" value="<?php echo $problem->city2?>" />
	<input type="hidden" name="district2" value="<?php echo $problem->district2?>" />
</div>

<div class="row">
	<label for="">难题名称</label>
	<input class="text" size="55" type="text" name="title" value="<?php echo $problem->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>

<div class="row">
	<label for="cat">所属行业</label>
	<select name="cat">
		<option value="-1">选择行业</option>
	</select>
	<span class="error"><?php echo $errors['cat']?></span>
	<select name="subcat">
		<option value="-1">选择行业</option>
	</select>
	<span class="error"><?php echo $errors['subcat']?></span>
</div>

<div class="row">
	<label for="">公司名</label>
	<input class="text" size="50" type="text" name="name" value="<?php echo $problem->name?>" />
	<span class="error"><?php echo $errors['name']?></span>
</div>

<div class="row">
	<label for="">联系人姓名</label>
	<input class="text" size="20" type="text" name="contact" value="<?php echo $problem->contact?>" />
	<span class="error"><?php echo $errors['contact']?></span>
</div>

<div class="row">
	<label for="">联系方式</label>
	<input class="text" size="20" type="text" name="phone" value="<?php echo $problem->phone?>" />
	<span class="error"><?php echo $errors['phone']?></span>
	<span>填入手机号或电话号码</span>
</div>

<div class="row">
	<label for="budget">预算</label>
	<input size="20" type="text" class="text" name="budget" value="<?php echo $problem->budget?>" />万元
	<span class="error"><?php echo $errors['budget']?></span>
</div>
 
<div class="add-problem">

	
	<div class="row">
		<label for="">所在地区</label>
		<div class="province_city"></div>
	</div>
	
	<div class="row">
		<label for="">面向地区</label>
		<div class="province_city2"></div>
	</div>
	
	<div class="row">
		<label for="deadline">截止日期</label>
		<input size="20" type="text" name="deadline" class="datepicker text" value="<?php echo get_date($problem->deadline)?>" readonly="readonly" />
		<span class="error"><?php echo $errors['deadline']?></span>
	</div>

	<div class="row">
		<label for="tag">领域标签</label>
		<input size="20" type="text" value="" class="text" id="new-tag" /> 
		<a href="javascript:;" id="add-tag">添加</a>
	</div>	

	<div class="tag row">
		<label for="">标签</label>
		<?php 
			if(is_array($tag_list)){
				foreach($tag_list as $tag){
		?>
		<a href="javascript:;" class="old" count="<?php echo $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?><img src="<?php echo ROOT_URL?>/images/delete.png"></a>
		<?php 
				}
			}
		?>
	</div>
	
	<div class="hot-tag row">
		<label for="">热门标签</label>
		<?php 
		if(is_array($most_common_tags)){
			foreach($most_common_tags as $tag){
		?>
			<a href="javascript:;" count="<?php echo $tag['count']?>" tagid="<?php echo $tag['id']?>" id="tag_<?php echo $tag['id']?>"><?php echo $tag['name']?></a>	
		<?php 
			}
		}
		?>
		<input type="hidden" name="new_tag" />
		<input type="hidden" name="old_tag" />
	</div>
	
	<div class="row">
		<label for="">上传图片</label>
		<input type="file" name="image" />
		<span class="error"><?php echo $errors['image']?></span>
	</div>

	<div class="row">
		<label for="">详细描述</label><span class="error"><?php echo $errors['description']?></span><br/><br/>
		<textarea class="ckeditor" name="description" rows="10" cols="80"><?php echo $problem->description?></textarea>
	</div>

	<div class="row">
		<label for="">附件</label>
		<input type="file" name="file" />
		<span class="error"><?php echo $errors['file']?></span>
		<span>附件最大20M</span>
	</div>

</div><!--end for add-problem-->

<div class="add-simple-problem">
	<div class="row">
		<label for="desc">简单描述</label>
		<textarea name="desc" class="text"><?php echo $recruit->description?></textarea>
		<span class="error"><?php echo $errors['description']?></span>
	</div>
</div>

<div class="row">
	<input type="hidden" id="type" name="type" value="<?php echo $type?>" /> <!-- 1 for simple, 0 not -->
	<input type="submit" value="发布" class="btn fl">
	<!-- <a href="<?php echo $home?>" class="back-btn">返回</a> -->
</div>

</form>

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
$(document).ready(function(){

	if($("#type").val() == '1'){
		$('.add-problem').hide();
		$('.add-simple-problem').show();
	}
	
	$('#normal-add').click(function(){
		$(this).parent().children().removeClass('current');
		$(this).addClass('current');
		$('.add-problem').show();
		$('.add-simple-problem').hide();
		$('#type').val('0');
	});
	
	$('#simple-add').click(function(){
		$(this).parent().children().removeClass('current');
		$(this).addClass('current');
		$('.add-problem').hide();
		$('.add-simple-problem').show();
		$('#type').val('1');
	});
	
	dateEventInit();
	provinceEventInit();	
	tagEventInit();
	catEventInitNormal();
});	
</script>