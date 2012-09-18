
<form action="" method="post" <?php $HTML->file_form_need()?> >
<div class="edit-left">

<div class="row">
	<label for="name">专利名称</label>
	<input size="50" type="text" name="title" value="<?php echo $patent->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>

<div class="row">
	<label for="name">专利号</label>
	<input size="50" type="text" name="pid" value="<?php echo $patent->pid?>" />
	<span class="error"><?php echo $errors['pid']?></span>
</div>

<div class="row">
	<label for="name">电话</label>
	<input size="50" type="text" name="phone" value="<?php echo $patent->phone?>" />
	<span class="error"><?php echo $errors['phone']?></span>
</div>

<div class="row">
	<label for="name">移动电话</label>
	<input size="50" type="text" name="mobile" value="<?php echo $patent->mobile?>" />
	<span class="error"><?php echo $errors['mobile']?></span>
</div>

<div class="row">
	<label for="name">邮箱</label>
	<input size="50" type="text" name="email" value="<?php echo $patent->email?>" />
	<span class="error"><?php echo $errors['email']?></span>
</div>

<div class="row">
	<label for="name">价格</label>
	<input size="10" type="text" name="budget" value="<?php echo $patent->budget?>" /> 万元
	<span class="error"><?php echo $errors['budget']?></span>
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
		<a href="javascript:;" class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>">
			<?php echo $tag->name?><img src="<?php echo IMAGE_HOME?>/delete.png"></a>	
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
	<label for="name">相关网站</label>
	<input size="60" type="text" name="url" value="<?php echo $patent->url?>" />
	<span class="error"><?php echo $errors['url']?></span>
</div>

<div class="row">
	<label for="name">适用分类</label>
	<select name="app">
		<option value="">未划分</option>
		<option value="1" <?php $HTML->selected(1, $patent->app)?>>高新技术</option>
		<option value="2" <?php $HTML->selected(2, $patent->app)?>>可产业化</option>
		<option value="3" <?php $HTML->selected(3, $patent->app)?>>小本创业</option>
		<option value="4" <?php $HTML->selected(4, $patent->app)?>>社会公益</option>
		<option value="5" <?php $HTML->selected(5, $patent->app)?>>民间秘方</option>
	</select>
	<span class="error"><?php echo $errors['app']?></span>
</div>

<div class="row">
	<label for="name">技术成熟度</label>
	<select name="skill">
		<option value="">请选择</option>
		<option value="1" <?php $HTML->selected(1, $patent->skill)?>>构想阶段</option>
		<option value="2" <?php $HTML->selected(2, $patent->skill)?>>图纸阶段</option>
		<option value="3" <?php $HTML->selected(3, $patent->skill)?>>成功案例</option>
		<option value="4" <?php $HTML->selected(4, $patent->skill)?>>批量推广</option>
		<option value="5" <?php $HTML->selected(5, $patent->skill)?>>研发成功</option>
	</select>
	<span class="error"><?php echo $errors['skill']?></span>
</div>

<div class="row">
	<label for="name">专利类型</label>
	<select name="kind">
		<option value="">请选择</option>
		<option value="1" <?php $HTML->selected(1, $patent->kind)?>>发明</option>
		<option value="2" <?php $HTML->selected(2, $patent->kind)?>>外观</option>
		<option value="3" <?php $HTML->selected(3, $patent->kind)?>>未申请专利</option>
	</select>
	<span class="error"><?php echo $errors['kind']?></span>
</div>

<div class="row">
	<label for="name">有无样品</label>
	<input type="radio" name="example" value="1" <?php $HTML->checked(1, $patent->example)?> /> 无
	<input type="radio" name="example" value="2" <?php $HTML->checked(2, $patent->example)?> /> 有
	<input type="radio" name="example" value="3" <?php $HTML->checked(3, $patent->example)?> /> 正在制作
	<span class="error"><?php echo $errors['skill']?></span>
</div>

<div class="row">
	<label for="name">转让方式</label>
	<input type="radio" name="transfer" value="1" <?php $HTML->checked(1, $patent->transfer)?> /> 完全转让
	<input type="radio" name="transfer" value="2" <?php $HTML->checked(2, $patent->transfer)?> /> 许可转让
	<input type="radio" name="transfer" value="3" <?php $HTML->checked(3, $patent->transfer)?> /> 合作生产
	<input type="radio" name="transfer" value="4" <?php $HTML->checked(4, $patent->transfer)?> /> 接受投资
	<span class="error"><?php echo $errors['transfer']?></span>
</div>

<div class="row">
	<label for="name">所有人性质</label>
	<input type="radio" name="owner" value="1" <?php $HTML->checked(1, $patent->owner)?> /> 个人
	<input type="radio" name="owner" value="2" <?php $HTML->checked(2, $patent->owner)?> /> 企业
	<input type="radio" name="owner" value="3" <?php $HTML->checked(3, $patent->owner)?> /> 科研单位
	<input type="radio" name="owner" value="4" <?php $HTML->checked(4, $patent->owner)?> /> 大专院校
	<span class="error"><?php echo $errors['owner']?></span>
</div>

</div>	<!--end for edit-left-->
<div class="edit-right">

	<?php if($patent->image){?>
	<div class="row">
		<label for="">图像</label>
		<img alt="" src="<?php img($patent->image)?>">
	</div>
	<?php }?>

	<div class="row">
		<label for="">修改图像</label>
		<input type="file" name="image" />
		<span class="error"><?php echo $errors['image']?></span>
	</div>
	
</div>	<!--end for edit-right-->
	
<div class="row">
	<label for="">详细描述</label><span class="error"><?php echo $errors['description']?></span><br/><br/>
	<textarea class="ckeditor" name="description" rows="10" cols="80"><?php echo $patent->description?></textarea>
</div>

<?php if($patent->file){?>
<div class="row">
	<label for="">附件</label>
	<a target="_blank" href="<?php echo UPLOAD_HOME."/$patent->file"?>">点击下载</a>
</div>
<?php }?>

<div class="row">
	<label for="">修改附件</label>
	<input type="file" name="file" />
	<span class="error"><?php echo $errors['file']?></span>
</div>


<div class="row">
	<input type="submit" value="保存" />
	<a href="<?php echo $home?>">返回</a>
</div>

</form>

<div>
	<input type="hidden" name="cat" value="<?php echo $patent->cat?>" />
	<input type="hidden" name="subcat" value="<?php echo $patent->subcat?>" />
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
	
	tagEventInit();
	catEventInit();
	
	
});	
</script>
