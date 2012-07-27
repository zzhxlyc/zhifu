
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>标题</td>
		<td width="150">类型</td>
		<td width="100">付款方式</td>
		<td width="100">付款金额</td>
		<td width="140">付款时间</td>
	</tr>
	<?php 
		$i = 0;
		foreach($list as $o){
			$i++;
			$tr_class = '';
			if($i % 2 == 0) $tr_class = 'class="even"';
	?>
	<tr <?php echo $tr_class?>>
		<td><?php echo $o->title?></td>
		<td><?php echo $o->kind?></td>
		<td><?php echo $o->method?></td>
		<td><?php echo $o->paid?></td>
		<td><?php echo $o->time?></td>
	</tr>
	<?php 
		}
	?>
</table>


<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

