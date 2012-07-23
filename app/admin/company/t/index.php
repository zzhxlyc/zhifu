<?php 
	foreach($list as $l){
		print_r($l);
	}
?>

<table class="normal-table" cellspacing="0" cellpadding="0">
	<tr class="top">
		<td>选择</td>
		<td>企业名称</td>
		<td>行业</td>
		<td>注册时间</td>
		<td>难题总金额</td>
		<td>购买专利总金额</td>
		<td>电话</td>
		<td>邮箱</td>
		<td>操作</td>
	</tr>
	<tr>
		<td><input type="checkbox" /></td>
		<td>企业名称</td>
		<td>行业</td>
		<td>注册时间</td>
		<td>难题总金额</td>
		<td>购买专利总金额</td>
		<td>电话</td>
		<td>邮箱</td>
		<td class="operate"><a href="#">查看</a><a href="#">编辑</a><a href="#">删除</a></td>
	</tr>
	<tr class="even">
		<td><input type="checkbox" /></td>
		<td>企业名称</td>
		<td>行业</td>
		<td>注册时间</td>
		<td>难题总金额</td>
		<td>购买专利总金额</td>
		<td>电话</td>
		<td>邮箱</td>
		<td class="operate"><a href="#">查看</a><a href="#">编辑</a><a href="#">删除</a></td>
</tr>
</table>

<a href="#" class="batch-del">批量删除</a>
