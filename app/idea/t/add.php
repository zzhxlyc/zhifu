
<form action="" method="post" <?php $HTML->file_form_need()?>>

<h2>发布创意悬赏</h2>

<div class="row">
	<label for="">名称</label>
	<input class="text wide" type="text" name="title" value="<?php echo $idea->title?>" />
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
	<label for="budget">预算</label>
	<input size="20" type="text" class="text" name="budget" value="<?php echo $idea->budget?>" />万元
	<span class="error"><?php echo $errors['budget']?></span>
</div>

<div class="row">
	<label for="deadline">截止日期</label>
	<input size="20" type="text" name="deadline" class="datepicker" value="<?php echo get_date($idea->deadline)?>" readonly="readonly" />
	<span class="error"><?php echo $errors['deadline']?></span>
</div>

<div class="row">
	<label for="tag">领域标签</label>
	<input size="20" type="text" value="" id="new-tag" /> 
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
	<label for="">一等奖</label>
	<input size="10" type="text" name="one" value="<?php echo $idea->one?>" />名
	<span class="error"><?php echo $errors['one']?></span>
	<input size="10" type="text" name="one_m" value="<?php echo $idea->one_m?>" />万
	<span class="error"><?php echo $errors['one_m']?></span>
</div>

<div class="row">
	<label for="">二等奖</label>
	<input size="10" type="text" name="two" value="<?php echo $idea->two?>" />名
	<span class="error"><?php echo $errors['two']?></span>
	<input size="10" type="text" name="two_m" value="<?php echo $idea->two_m?>" />万
	<span class="error"><?php echo $errors['two_m']?></span>
</div>

<div class="row">
	<label for="">三等奖</label>
	<input size="10" type="text" name="three" value="<?php echo $idea->three?>" />名
	<span class="error"><?php echo $errors['three']?></span>
	<input size="10" type="text" name="three_m" value="<?php echo $idea->three_m?>" />万
	<span class="error"><?php echo $errors['three_m']?></span>
</div>

<div class="row">
	<label for="">详细描述</label><span class="error"><?php echo $errors['description']?></span><br/><br/>
	<textarea class="ckeditor" name="description" rows="10" cols="80"><?php echo $idea->description?></textarea>
</div>

<div class="row">
	<label for="">图像</label>
	<input type="file" name="image" />
	<span class="error"><?php echo $errors['image']?></span>
</div>

<div class="row">
	<label for="">附件</label>
	<input type="file" name="file" />
	<span class="error"><?php echo $errors['file']?></span>
</div>

<div class="row">
	<input type="hidden" name="cat" value="<?php echo $idea->cat?>" />
	<input type="hidden" name="subcat" value="<?php echo $idea->subcat?>" />
	<input type="submit" value="发布" class="btn fl">
	<a href="<?php echo $home?>" class="back-btn">返回</a>
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
$(document).ready(function($){
	dateEventInit();
	tagEventInit();
	catEventInitNormal();
});	
</script>