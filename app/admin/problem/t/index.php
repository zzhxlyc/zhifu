
<form action="<?php echo $home.'/delete'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="30">选择</td>
		<td>难题名称</td>
		<td width="80">发布人</td>
		<td width="80">状态</td>
		<td width="60">金额</td>
		<td width="140">日期</td>
		<td width="180">操作</td>
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
		<td>
			<a href="<?php echo $home.'/edit?id='.$o->id?>"><?php echo $o->title?></a>
			<?php if($o->verify == 0){?>
				<a href="<?php echo $home.'/verify?id='.$o->id?>"><font color="red">审核</font></a>
			<?php }?>
		</td>
		<td><a target="_blank" href="<?php echo get_author_link($o->company, BelongType::COMPANY)?>"><?php echo $o->username?></a></td>
		<td><?php echo $o->get_status()?></td>
		<td><?php echo $o->budget?>万</td>
		<td><?php echo $o->time?></td>
		<td class="operate">
			<a target="_blank" href="<?php echo ADMIN_SOLUTION_HOME.'/index?pid='.$o->id?>">查看竞标</a>
			<a href="<?php echo $home.'/comment?pid='.$o->id?>">回复</a>
			<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
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

