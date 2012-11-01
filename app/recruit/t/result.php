
<div class="list job">
	<table>
			<tr class="top">
				<th width="100">姓名</th>
				<th width="50">性别</th>
				<th>Email</th>
				<th width="120">电话</th>
				<th width="120">手机</th>
				<th width="100">简历</th>
				<th width="140">申请时间</th>				
			</tr>
	
	
	<?php 
		if(is_array($list)){
			foreach($list as $o){
	?>
		<tr>
			<td><?php echo $o->name?></td>
			<td><?php output_sex($o->sex)?></td>
			<td><?php echo $o->email?></td>
			<td><?php echo $o->phone?></td>
			<td><?php echo $o->mobile?></td>
			<td><a target="_blank" href="<?php echo $home.'/resume?item='.$o->id?>">下载简历</a></td>
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

<div class="row">
	<a href="<?php echo $home.'/show?id='.$recruit->id?>">返回</a>
</div>

