<div class="filter clearfix">
	<div class="order">
		<a href="<?php echo $home.'/index'?>" <?php $HTML->if_current($_GET['type'] == '')?>>全部</a>
		<a href="<?php echo $home.'/index?type=zhaopin'?>" <?php $HTML->if_current($_GET['type'] == 'zhaopin')?>>顾问招聘</a>
		<a href="<?php echo $home.'/index?type=qiuzhi'?>" <?php $HTML->if_current($_GET['type'] == 'qiuzhi')?>>顾问求职</a>
	</div>
	<a href="<?php echo $home.'/add'?>" class="job-btn btn">我要发布</a>
</div>



<div class="list job">
	<table>
			<tr class="top">
				<th width="20%">职位名称</th>
				<th width="20%">公司名称</th>
				<th width="20%">招聘人数</th>
				<th width="20%">性别</th>
				<th width="20%">发布时间</th>				
								
			</tr>
	
	
	<?php 
		if(is_array($list)){
			foreach($list as $o){
	?>
	
		<tr>
			<td>ee</td>
			<td>ee</td>
			<td>ee</td>
			<td>ee</td>
			<td>ee</td>
		</tr>
		<!--<div class="middle">
			<h3 class="title">
				<a href="<?php //echo $home.'/show?id='.$o->id?>"><?php echo $o->title?></a>
			</h3>
			<div class="content"><?php //output_desc($o->description)?></div>						
			<div class="time"><?php //echo $o->get_status()?></div>	

		</div>-->
		
	<?php 
			}
		}
	?>
		</table>
</div>

<div class="page-wrapper">
	<?php output_page_list($links);?>
</div>

