
<form action="<?php echo $home.'/delete'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="30">选择</td>
		<td>日志</td>
		<td width="140">时间</td>
		<td width="100">IP</td>
		<td width="50">等级</td>
		<td width="50">操作</td>
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
		<td><?php echo $o->action?></td>
		<td><?php echo $o->time?></td>
		<td><?php echo $o->ip?></td>
		<td><?php echo $o->get_type()?></td>
		<td class="operate">
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

