
<form action="<?php echo $home.'/delcomm'?>" method="post">
<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td width="30">选择</td>
		<td>内容</td>
		<td width="100">发布人</td>
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
		<td><a href="<?php echo $home.'/edit?id='.$o->id?>"><?php echo subString($o->content, 500)?></a></td>
		<td><a target="_blank" href="<?php echo get_author_link($o->user, $o->user_type)?>"><?php echo $o->username?></a></td>
		<td><?php echo $o->time?></td>
		<td class="operate">
			<a href="<?php echo $home.'/delcomm?vid='.$o->object.'&id='.$o->id?>">删除</a>
		</td>
	</tr>
	<?php 
		}
	?>
</table>

<input type="hidden" name="vid" value="<?php echo $_GET['id']?>" />
<input type="submit" value="批量删除" />
<a href="<?php echo ADMIN_VIDEO_HOME?>">返回</a>
</form>

<div class="page-nav">
	<?php Pager::output_pager_list($page_list);?>
</div>

