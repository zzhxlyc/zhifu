<?php 
	foreach($list as $l){
		print_r($l);
	}
?>

<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>选择</td>
		<td>难题名称</td>
		<td>发布人</td>
		<td>日期</td>
		<td>类型</td>
		<td>状态</td>
		<td>金额</td>
		<td>操作</td>
	</tr>
	<tr>
		<td><input type="checkbox" /></td>
		<td><a href="">难题名称</a></td>
		<td>发布人</td>
		<td>日期</td>
		<td>类型</td>
		<td>状态</td>
		<td>金额</td>
		<td class="operate"><a href="#">编辑</a><a href="#">删除</a></td>
	</tr>
	<tr class="even">
		<td><input type="checkbox" /></td>
		<td><a href="">难题名称</a></td>
		<td>发布人</td>
		<td>日期</td>
		<td>类型</td>
		<td>状态</td>
		<td>金额</td>
		<td class="operate"><a href="#">编辑</a><a href="#">删除</a></td>
	</tr>
</table>

<a href="#" class="batch-del">批量删除</a>


