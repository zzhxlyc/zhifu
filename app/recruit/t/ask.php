<h2>添加求职信息</h2>
<div class="row">
	<label for="">领域：</label>
	<input type="text" name="" class="text" />
</div>
<div class="row">
	<label for="des">描述：</label>
	<textarea name="des" id="" class="text" ></textarea>
</div>
<div class="row">空闲时间：(点击选择空闲时间，为选表示面谈)</div>
<div class="row clearfix">

	<div class="choose-time">
			<span class="day0 selected">
			周日上午</span>
			<span class="day1 ">
			周一上午</span>
			<span class="day2 ">
			周二上午</span>
			<span class="day3 ">
			周三上午</span>
			<span class="day4 ">
			周四上午</span>
			<span class="day5 ">
			周五上午</span>
			<span class="day6 ">
			周六上午</span>

			<span class="day0 selected">
			周日下午</span>
			<span class="day1 ">
			周一下午</span>
			<span class="day2 ">
			周二下午</span>
			<span class="day3 ">
			周三下午</span>
			<span class="day4 ">
			周四下午</span>
			<span class="day5 ">
			周五下午</span>
			<span class="day6 ">
			周六下午</span>

			<span class="day0 ">
			周日晚上</span>
			<span class="day1 ">
			周一晚上</span>
			<span class="day2 ">
			周二晚上</span>
			<span class="day3 ">
			周三晚上</span>
			<span class="day4 ">
			周四晚上</span>
			<span class="day5 ">
			周五晚上</span>
			<span class="day6 ">
			周六晚上</span>

	</div><!--end for choose-time-->
</div>
<div class="row">
	<input type="button" value="提交" class="btn" />
</div>



<script type="text/javascript">
$(document).ready(function(){
	
	timeChooseEventInit();
	
	
});	
	
</script>