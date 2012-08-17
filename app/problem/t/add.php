<div class="filter clearfix">
	<div class="order">
		<a href="#" class="current" id="normal-add">技术难题</a>
		<a href="#" id="simple-add">简洁发布</a>
	
	</div>

</div><!--end for filter-->

<div class="add-problem">
	<h2>发布企业技术难题</h2>
	<div class="row">
		<label for="">难题名称</label>
		<input class="text wide" type="text" name="title" value="" />
		
	</div>
	<div class="row">
		<label for="cat">所属行业</label>

		<select name="cat">
		</select>
		<span class="error"></span>


		<select name="subcat">
		</select>
		<span class="error"></span>
	</div>
	
	<div class="row">
		<label for="">地区</label>
		<div class="province_city"></div>
	</div>	
	
	
	<div class="row">
		<label for="budget">预算</label>
			<input size="20" type="text" class="text" name="budget" value="" />万元
			<span class="error"></span>
	</div>
	<div class="row">
		<label for="deadline">截止日期</label>
			<input size="20" type="text" name="deadline" class="datepicker" value="" readonly="readonly" />
			<span class="error"></span>
	</div>

	<div class="row">
		<label for="tag">领域标签</label>
		<input size="20" type="text" value="" id="new-tag" /> <a href="javascript:;" id="add-tag">添加</a>
	</div>	

	<div class="tag row">
		<label for="">标签</label>
	<a href="javascript:;" class="old" count="" tagid="1" id="tag_1">机械<img src="<?php echo ROOT_URL?>/images/delete.png"></a>
	</div>
	<div class="hot-tag row">
		<label for="">热门标签</label>
		<a href="javascript:;" count="7" tagid="8" id="tag_8">西安</a>
		<input type="hidden" name="new_tag" />
		<input type="hidden" name="old_tag" />
	</div>



	<div class="row">
		<label for="">详细描述</label><br/><br/>
		<textarea class="ckeditor" name="description" rows="10" cols="80"></textarea>
		<span class="error"></span>
	</div>

	<div class="row">
		<label for="">附件</label>
	
		<a target="_blank" href="#">点击下载</a>

	</div>
	<div class="row">
		<label for="">修改附件</label>
		<input type="file" name="file" />
		<span class="error"></span>
	</div>


	<div class="row">
		<input type="submit" value="发布" class="btn fl">
		<a href="<?php echo $home?>" class="back-btn">返回</a>
	</div>
	
	
	
	
</div><!--end for add-problem-->

<div class="add-simple-problem">
	<h2>发布企业技术难题</h2>
	
	<div class="row">
		<label for="">难题名称</label>
		<input class="text wide" type="text" name="title" value="" />
		
	</div>
	<div class="row">
		<label for="des">简单描述</label>
		<textarea name="description" class="text"><?php echo $recruit->description?></textarea>
		<span class="error"><?php echo $errors['description']?></span>
	</div>
	<div class="row">
		<label for="">电话</label>
		<input class="text narrow" type="text" name="title" value="" />
	</div>
	<div class="row">
		<label for="">邮箱</label>
		<input class="text narrow" type="text" name="title" value="" />
	</div>
	
	<div class="row">
		<input type="hidden" name="available" />
		<input type="submit" value="发布" class="btn fl">
		<a href="<?php echo $home?>" class="back-btn">返回</a>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function($){
	
	dateEventInit();
	provinceEventInit();	
	catEventInit();
	tagEventInit();
	
	$('#normal-add').click(function(){
		$(this).parent().children().removeClass('current');
		$(this).addClass('current');
		$('.add-problem').show();
		$('.add-simple-problem').hide();
	});
	
	$('#simple-add').click(function(){
		$(this).parent().children().removeClass('current');
		$(this).addClass('current');
		$('.add-problem').hide();
		$('.add-simple-problem').show();
	});
	
	
});	
</script>