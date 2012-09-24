<h2>添加求职/兼职信息</h2>
<div class="filter clearfix">
	<div class="order">
		<a href="javascript:;" class="current" id="add-recruit">发布招聘信息</a>
		<a href="javascript:;" id="add-apply">发布求职信息</a>
	
	</div>

</div><!--end for filter-->
<form action="" method="post">


<div class="recruit">
	
	<div class="row">
		<label for="title">职位名称：</label>
		<input class="text wide" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">招聘人数：</label>
		<input class="text" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">招聘对象：</label>
		<input type="radio" name="level" />领域专家
		<input type="radio" name="level" />社会人才
		<input type="radio" name="level" />在校学生
		<input type="radio" name="level" />不限
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">专业要求：</label>
		<input class="text wide" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	

	<div class="row">
		<label for="title">工作地点：</label>
		<div class="province_city"></div>
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">学历要求：</label>
		<select name="" id="">
			<option value="1">不限</option>
			<option value="2">本科</option>
			<option value="3">硕士</option>
			<option value="4">博士</option>
		</select>	
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">薪资待遇：</label>
		<input class="text" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">年龄要求：</label>
		<input class="text" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">是否提供食宿：</label>
		<input type="radio" name="room" value="" />是
		<input type="radio" name="room" value="" />否
		<span class="error"></span>
	</div>	
	<div class="row">
		<label for="title">职位描述：</label>
		<textarea name="description" class="text"><?php echo $recruit->description?></textarea>
		<span class="error"><?php echo $errors['description']?></span>	
	</div>
</div>


<div class="apply" style="display:none">
	<div class="row">
		<label for="title">求职职位：</label>
		<input class="text wide" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">我的身份：</label>
		<input type="radio" name="level" />领域专家
		<input type="radio" name="level" />社会人才
		<input type="radio" name="level" />在校学生
		<input type="radio" name="level" />不限
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">姓名：</label>
		<input class="text" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">性别：</label>
		<input class="text" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">年龄：</label>
		<input class="text" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">手机号：</label>
		<input class="text" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">电子邮箱：</label>
		<input class="text" type="text" name="title" value="" />
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">现居住地：</label>
		<div class="province_city2"></div>
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">求职区域：</label>
		<div class="province_city3"></div>
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">最高学历：</label>
		<select name="" id="">
			<option value="1">不限</option>
			<option value="2">本科</option>
			<option value="3">硕士</option>
			<option value="4">博士</option>
		</select>	
		<span class="error"></span>
	</div>
	
	<div class="row">
		<label for="tag">擅长领域:</label>
		<input size="20" type="text" class="text" value="" id="new-tag" /> 
		<a href="javascript:;" id="add-tag">添加</a>
	</div>	
	<div class="tag row">
		<label for="">标签:</label>
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
		<label for="title">行业经验：</label>
		<input class="text" type="text" name="title" value="" />年
		<span class="error"></span>
	</div>
	<div class="row">
		<label for="title">项目经历：</label>
		<textarea name="description" class="text"></textarea>
		<span class="error"></span>	
	</div>
	<div class="row">
		<label for="title">自我评价：</label>
		<textarea name="description" class="text"></textarea>
		<span class="error"></span>	
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
	
</div>


<div class="row">
	<input type="hidden" name="available" />
	<input type="submit" value="发布" class="btn fl">
	<a href="<?php echo $home?>" class="back-btn">返回</a>
</div>	

</form>

<script type="text/javascript">
$(document).ready(function(){
	$('#add-recruit').click(function(){
		$(this).parent().children().removeClass('current');
		$(this).addClass('current');
		$('.recruit').show();
		$('.apply').hide();
	
	});
	
	$('#add-apply').click(function(){
		$(this).parent().children().removeClass('current');
		$(this).addClass('current');
		$('.recruit').hide();
		$('.apply').show();
	
	});
	timeChooseEventInit();
	tagEventInit();
	provinceEventInit();	
	
});	
	
</script>