<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">求职招聘</a>
</div>

<div class="filter clearfix">
	<div class="order">
		<form action="" method="get">
		<select name="fromday" onchange="this.form.submit()">
			<option value="" <?php $HTML->selected($_GET['fromday'], '')?>>全部时间</option>
			<option value="3days" <?php $HTML->selected($_GET['fromday'], '3days')?>>三天以内</option>
			<option value="week" <?php $HTML->selected($_GET['fromday'], 'week')?>>一周以内</option>
		</select>
		</form>
		<a href="<?php echo RECRUIT_HOME?>" <?php $HTML->if_current($request->get_module() == 'recruit')?>>招聘</a>
		<a href="<?php echo $home?>" <?php $HTML->if_current($request->get_module() == 'apply')?>>求职</a>
		
	</div>
	<?php if(is_expert($User)){?>
	<a href="<?php echo APPLY_HOME.'/add'?>" class="job-btn btn">发布求职</a>
	<?php }?>
	<?php if(is_company($User)){?>
	<a href="<?php echo RECRUIT_HOME.'/add'?>" class="job-btn btn">发布招聘</a>
	<?php }?>
</div>

<div class="list job">
	<table>
			<tr class="top">
				<th>职位名称</th>
				<th>我的身份</th>
				<th>求职区域</th>
				<th>性别</th>
				<th>姓名</th>
				<th>发布时间</th>				
			</tr>
	
	<?php 
		if(is_array($list)){
			foreach($list as $o){
	?>
		<tr>
			<td><a href="<?php echo $home.'/show?id='.$o->id?>"><?php echo $o->title?></a></td>
			<td><?php output_identity($o->identity)?></td>
			<td><?php echo $o->area?></td>
			<td><?php output_sex($o->sex)?></td>
			<td><a target="_blank" href="<?php echo get_author_link($o->belong, $o->type)?>">
				<?php if($o->author){ echo $o->author;}else{echo $o->username;}?>
			</a></td>
			<td><?php echo $o->time?></td>
		</tr>
	<?php 
			}
		}
	?>
		</table>
</div>

<div class="page-wrapper">
	<?php output_page_list($links);?>
</div>

