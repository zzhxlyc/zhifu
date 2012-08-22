
<form action="<?php echo $home.'/delete'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="30">选择</td>
		<td>难题</td>
		<td width="150">专家</td>
		<td width="50">状态</td>
		<td width="140">日期</td>
		<td width="100">操作</td>
	</tr>
	<?php 
		if(isset($list)){
		$i = 0;
		foreach($list as $o){
			$i++;
			$tr_class = '';
			if($i % 2 == 0) $tr_class = 'class="even"';
	?>
	<tr <?php echo $tr_class?>>
		<td><input name="id[]" type="checkbox" value="<?php echo $o->id?>" /></td>
		<td><a target="_blank" href="<?php echo ADMIN_IDEA_HOME.'/edit?id='.$o->idea?>"><?php echo $o->pname?></a></td>
		<td><a target="_blank" href="<?php echo ADMIN_EXPERT_HOME.'/show?id='.$o->expert?>"><?php echo $o->author?></a></td>
		<td><?php echo $o->get_status()?></td>
		<td><?php echo $o->time?></td>
		<td class="operate">
			<a href="<?php echo $home."/show?pid=$o->idea&eid=$o->expert"?>">查看</a>
			<a href="<?php echo $home.'/delete?id='.$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
		}
		}
	?>
</table>

<input type="submit" value="批量删除" />
</form>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

