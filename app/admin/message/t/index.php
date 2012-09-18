
<form action="<?php echo $home.'/delete'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="30">选择</td>
		<td>标题</td>
		<td width="120">发送用户</td>
		<td width="120">接受用户</td>
		<td width="100">操作</td>
	</tr>
	<?php 
		$i = 0;
		if(is_array($list)){
		foreach($list as $o){
			$i++;
			$tr_class = '';
			if($i % 2 == 0) $tr_class = 'class="even"';
	?>
	<tr <?php echo $tr_class?>>
		<td><input name="id[]" type="checkbox" value="<?php echo $o->id?>" /></td>
		<td><a href="<?php echo $home.'/edit?id='.$o->id?>"><?php echo $o->title?></a></td>
		<td><?php echo $o->from_name?>（<?php echo BelongType::to_string($o->from_type)?>）</td>
		<td><?php echo $o->to_name?>（<?php echo BelongType::to_string($o->to_type)?>）</td>
		<td class="operate">
			<a href="<?php echo $home.'/edit?id='.$o->id?>">编辑</a>
			<a href="<?php echo $home.'/delete?p=1&id='.$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
		}
		}
	?>
</table>

<input type="submit" value="批量删除" />
<a href="<?php echo $home.'/send'?>">发送站内信</a>
</form>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

