<div class="sidebar">

	<div class="detail-profile">
		<img src="<?php img($Problem->image, $Problem->default_image())?>" 
			alt="<?php echo $Problem->title?>" width="180" height="135"/>
		<p><?php echo $Problem->title?></p>
		<p>金额：<span class="price"><?php output_money($Problem->budget)?>万元</span></p>
		<?php if(!empty($Problem->cat_name)){?>
		<p>类别：<?php echo $Problem->cat_name?> <?php echo $Problem->subcat_name?></p>
		<?php }?>
		<?php if(!empty($Problem->province)){?>
		<p>所在地区：<?php output_pcd($Problem)?></p>
		<?php }?>
		<?php if(!empty($Problem->province2)){?>
		<p>面向地区：<?php output_pcd2($Problem)?></p>
		<?php }?>
		<p>发布时间：<?php echo get_date($Problem->time)?></p>
		<p>最后修改时间：<?php echo get_date($Problem->lastmodify)?></p>
		<?php if(isset($Problem->deadline)){?>
		<p><?php output_deadline($Problem->deadline)?></p>
		<?php }?>
	</div><!--end for detail-profile-->
	
	<div class="side-section">
		<div class="title">发起者</div>
		<div class="content">
			<a href="<?php echo COMPANY_HOME.'/profile?id='.$Problem->company?>">
				<?php output_username($Problem, 2)?></a>
		</div>
	</div><!--end for tag-->
	
	<div class="side-section">
		<div class="title">领域标签</div>
		<div class="content">
			<?php foreach($tags as $tag){?>
			<span class="item"><?php echo $tag->name?></span>
			<?php }?>
		</div>
	</div>
	
	<?php if(is_company_object($User, $Problem, false) || $solver){?>
	<div class="side-section">
		<div class="title">操作</div>
		<div class="content">
		<?php if($Problem->status == 1){?>
			<a href="javascript:void(0)" class="problem_finish">停止提交竞标方案</a>
		<?php }else if($Problem->status == 2){?>
			<a href="javascript:void(0)" class="problem_done">选定中标方案</a>
		<?php }else if($Problem->status == 3 || $solver){?>
		<a href="<?php echo $home.'/score?id='.$Problem->id?>">评分</a>
		<?php }?>
		</div>
	</div>
	<?php }?>
	
</div><!--end for sidebar-->

<?php if(is_company_object($User, $Problem)){?>
<script type="text/javascript">
<!--
$(".problem_finish").click(function (){
	var problem = $("#object").val();
	$.ajax({
		type: "POST",
		url: window.ROOT_URL + "/problem/finish",
		data: "problem="+problem,
		success: function(msg){
			if(msg == '0'){
				location.href = window.ROOT_URL + "/problem/detail?id=" + problem;
			}
			else{
				alert(msg);
			}
		}
	});
});
$(".problem_done").click(function (){
	var problem = $("#object").val();
	$.ajax({
		type: "POST",
		url: window.ROOT_URL + "/problem/done",
		data: "problem="+problem,
		success: function(msg){
			if(msg == '0'){
				location.href = window.ROOT_URL + "/problem/detail?id=" + problem;
			}
			else{
				alert(msg);
			}
		}
	});
});
</script>
<?php }?>