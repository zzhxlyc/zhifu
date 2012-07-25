<?php 
	if($error){
		echo $error;
	}
	else{
?>

<form action="" method="post" <?php $HTML->file_form_need()?> >
	
<div class="row">
	<label for="name">难题名称</label>
	<input size="100" type="text" name="title" value="<?php echo $problem->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>	
<div class="row">
	<label for="cat">所属行业</label>
	
	<select name="cat">
		<option value="">选择行业</option>
	</select>
	<span class="error"><?php echo $errors['cat']?></span>
	
	
	<select name="subcat">
		<option value="">选择行业</option>
	</select>
	<span class="error"><?php echo $errors['subcat']?></span>
</div>

<div class="row">
	<label for="">地区</label>
	<div class="province_city"></div>
	<input type="hidden" name="province" value="<?php echo $problem->province?>" />
	<input type="hidden" name="city" value="<?php echo $problem->city?>" />
	<input type="hidden" name="district" value="<?php echo $problem->district?>" />
</div>	


<div class="row">
	<label for="budget">预算</label>
		<input size="20" type="text" name="budget" value="<?php echo $problem->budget?>" />万元
		<span class="error"><?php echo $errors['budget']?></span>
</div>


<div class="row">
	<label for="deadline">截止日期</label>
		<input size="20" type="text" name="deadline" class="datepicker" value="<?php echo $problem->deadline?>" readonly="readonly" />
		<span class="error"><?php echo $errors['deadline']?></span>
</div>

<div class="row">
	<label for="tag">领域标签</label>
	<input size="20" type="text" value="" /> <a href="#">添加</a>
	<div>标签：
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<span count="<?php $tag->count?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?></span>	
	<?php 
		}
	}
	?>
	</div>
	<div>热门标签：
	<?php 
	if(is_array($most_common_tags)){
		foreach($most_common_tags as $tag){
	?>
		<span count="<?php echo $tag['count']?>" id="tag_<?php echo $tag['id']?>"><?php echo $tag['name']?></span>	
	<?php 
		}
	}
	?>
	</div>
	<input type="hidden" name="new_tag" />
	<input type="hidden" name="old_tag" />
</div>


<div class="row">
	<label for="">详细描述</label>
	<textarea name="description" rows="10" cols="80"><?php echo $problem->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
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
	<label for="">修改附件</label>
	<input type="file" name="file" />
	<span class="error"><?php echo $errors['file']?></span>
</div>


<div class="row">
	<input type="submit" value="修改" />
	<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	<?php echo $HTML->hidden('id', $problem->id)?>
</div>

</form>
<?php 
	}
?>

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
<?php 
if($problem->cat > 0){
	echo "set_cat($problem->cat);\n";
}
if($problem->subcat > 0){
	echo "set_subcat($problem->subcat);\n";
}	
?>
//-->
</script>


<script type="text/javascript">


$(document).ready(function($){
	$(".province_city").province_city_county(); 
	$( ".datepicker" ).datepicker({
		dateFormat:"yy-mm-dd"
		
	});
	
	var cathtml='';
	$.each(catList, function(i, t) {
		cathtml+='<option value="'+t.id+'">'+t.n+'</option>';
	});

	$('select[name=cat]').append(cathtml);	

	$('select[name=cat]').change(function(){
		$('select[name=subcat]').children().empty();
		//var catId=$('select[name=cat]').val();
		//var subCatList=catList.


	});

	

});	


	
	
</script>