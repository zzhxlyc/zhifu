
<form action="<?php echo $home.'/delete'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="30">选择</td>
		<td>文章标题</td>
		<td width="140">日期</td>
		<td width="100">操作</td>
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
		<td><a href="<?php echo $home.'/edit?id='.$o->id?>"><?php echo $o->title?></a></td>
		<td><?php echo $o->time?></td>
		<td class="operate">
			<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
			<a href="<?php echo $home.'/delete?id='.$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
		}
	?>
</table>

<input type="submit" value="批量删除" />
<a href="<?php echo $home.'/add'?>">添加文章</a>
</form>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

