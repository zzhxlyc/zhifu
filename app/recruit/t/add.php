<h2>添加求职/兼职信息</h2>

<form action="" method="post">

<div class="row">
	<label for="title">标题：</label>
	<input class="text wide" type="text" name="title" value="<?php echo $recruit->title?>" />
	<span class="error"><?php echo $errors['title']?></span>
</div>
<div class="row">
	<label for="tag">擅长领域</label>
	<input size="20" type="text" class="text" value="" id="new-tag" /> 
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
	<input type="hidden" name="new_tag" />
	<input type="hidden" name="old_tag" />
</div>
<div class="row">
	<label for="des">描述：</label>
	<textarea name="description" class="text"><?php echo $recruit->description?></textarea>
	<span class="error"><?php echo $errors['description']?></span>
</div>
<?php if(is_expert($User)){?>
<div class="row">空闲时间：(点击选择空闲时间，为选表示面谈)</div>
<div class="row clearfix">

	<div class="choose-time">
	<?php 
		$array_day = array('上午', '下午', '晚上');
		for($i = 0;$i < 3;$i++){
			$array = array('周日','周一','周二','周三','周四','周五','周六');
			for($d = 0;$d < 7;$d++){
				$class = '';
				if($recruit->days[$d][$i] == 1){
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
<?php }?>
<div class="row">
	<input type="hidden" name="available" />
	<input type="submit" value="发布" class="btn fl">
	<a href="<?php echo $home?>" class="back-btn">返回</a>
</div>	

</form>

<script type="text/javascript">
$(document).ready(function(){
	
	timeChooseEventInit();
	tagEventInit();
	
});	
	
</script>