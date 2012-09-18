
<form action="<?php echo $home.'/deletecomm'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="30">选择</td>
		<td width="100">用户账号</td>
		<td width="150">用户名</td>
		<td>回复内容</td>
		<td width="140">日期</td>
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
		<td><?php echo $o->username?></td>
		<td><?php echo $o->author?></td>
		<td><?php echo $o->content?></td>
		<td><?php echo $o->time?></td>
		<td class="operate">
			<a href="<?php echo $home."/deletecomm?pid=$pid&id=$o->id"?>">删除</a>
		</td>
	</tr>
	<?php 
		}
	?>
</table>

<input type="submit" value="批量删除" />
<input type="hidden" name="pid" value="<?php echo $pid?>" />
<a href="<?php echo $home?>">返回</a>
</form>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

