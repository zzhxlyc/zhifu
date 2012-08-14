
<form action="<?php echo $home.'/delete'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="30">选择</td>
		<td>姓名</td>
		<td width="90">注册时间</td>
		<td width="150">邮箱</td>
		<td width="50">状态</td>
		<td width="150">操作</td>
	</tr>
	<?php 
		$i = 0;
		foreach($list as $o){
			$i++;
			$tr_class = '';
			if($i % 2 == 0) $tr_class = 'class="even"';
	?>
	<tr <?php echo $tr_class?>>
		<td><input name="id[]" type="checkbox" value="<?php echo $o->id?>" /></td>
		<td><a href="<?php echo $home.'/edit?id='.$o->id?>"><?php echo $o->name?></a></td>
		<td><?php echo get_date($o->time)?></td>
		<td><?php echo $o->email?></td>
		<td><?php echo $o->status()?></td>
		<td class="operate">
			<a target="_blank" href="<?php echo ADMIN_SOLUTION_HOME.'/index?eid='.$o->id?>">查看竞标</a>
			<a href="<?php echo $home.'/show?id='.$o->id?>">查看</a>
			<a href="<?php echo $home.'/delete?id='.$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
		}
	?>
</table>

<input type="submit" value="批量删除" />
</form>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>
