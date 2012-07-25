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
	</select>
	<span class="error"><?php echo $errors['cat']?></span>
	
	
	<select name="subcat">
	</select>
	<input type="hidden" name="cat" value="<?php echo $problem->cat?>" />
	<input type="hidden" name="subcat" value="<?php echo $problem->subcat?>" />
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
	<input size="20" type="text" value="" id="new-tag" /> <a href="javascript:;" id="add-tag">添加</a>
</div>	

	<div class="tag row">
		<label for="">标签</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a href="javascript:;" class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?><img src="../../images/delete.png"></a>	
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
	</div>
	<input type="hidden" name="new_tag" />
	<input type="hidden" name="old_tag" />



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

//-->
</script>


<script type="text/javascript">

$(document).ready(function($){
	var province=$('input[name=province]').val();
	var city=$('input[name=city]').val();
	var district=$('input[name=district]').val();
	
	var cat=$('input[name=cat]').val();
	var subcat=$('input[name=subcat]').val();
	
	
		
	$(".province_city").province_city_county(province,city,district); 
	
	$( ".datepicker" ).datepicker({
		dateFormat:"yy-mm-dd"
		
	});
	
	//cat从初始化
	var cathtml='';
	$.each(catList, function(i, t) {
		cathtml+='<option value="'+t.id+'">'+t.n+'</option>';
	});
	$('select[name=cat]').append(cathtml);	
	
	
	//subcat联动处理
	$('select[name=cat]').change(function(){
		$('select[name=subcat]').children().remove();
		var catId=$('select[name=cat]').val();
		var subCatList=catList[catId].c;
		var subCatHtml='';
		$.each(subCatList, function(i, t) {
			subCatHtml+='<option value="'+t.id+'">'+t.name+'</option>';
		});
		
		$('select[name=subcat]').append(subCatHtml);	

	});
	//默认值
	$('select[name=cat]').val(cat);	
	var oldSubCatHtml='';
	$.each(catList[cat].c, function(i, t) {
		oldSubCatHtml+='<option value="'+t.id+'">'+t.name+'</option>';
	});
	
	$('select[name=subcat]').append(oldSubCatHtml);	
	$('select[name=subcat]').val(subcat);
	setOldTagId();
	
	
	
	
	//old_tag赋值
	function setOldTagId(){
		var oldtagId='';
		$('.tag .old').each(function(){
			oldtagId+= $(this).attr('tagid')+',';

		});
		oldtagId=oldtagId.substring(0,oldtagId.length-1);

		$('input[name=old_tag]').val(oldtagId);
	}
	
	function setNewTagId(){
		var newtagId='';
		$('.tag .new').each(function(){
		
			newtagId+= $(this).text()+',';
		

		});
		newtagId=newtagId.substring(0,newtagId.length-1);

		$('input[name=new_tag]').val(newtagId);
		
	};
	
	function addNewTag(newtag){
		$('.tag').append('<a href="javascript:;" class="new">'+newtag+'<img src="../../images/delete.png"></a>');
		
		setNewTagId();
		$('.tag .new').click(function(){
			$(this).remove();
			setNewTagId();
		});
	}
	
	
	$('#add-tag').click(function(){
		var newtag=$('#new-tag').val();
		addNewTag(newtag);
			
	});
	
	
	$('.hot-tag a').click(function(){
		var newtag=$(this).text();
		addNewTag(newtag);
		
	});
	

	$('.tag .old').click(function(){
		$(this).remove();
		setOldTagId();
	});
	
	

	
	
	
	
	
	
	
	
	

});	


	
	
</script>