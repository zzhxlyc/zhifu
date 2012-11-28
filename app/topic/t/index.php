<div class="top_link">
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">话题</a>
</div>

<div class="topic-list">
	<h3>最新话题<a href="<?php echo $home.'/add'?>" class="fr btn">发表话题</a></h3>
	<table>
		<tr class="top">
			<td width="60%">话题</td>
			<td width="13%">作者</td>
			<td width="7%">回应</td>
			<td width="20%">最后回应</td>				
		</tr>
		<?php 
			if(is_array($list)){
				foreach($list as $o){
		?>
		<tr>
			<td><a href="<?php echo $home.'/detail?id='.$o->id?>"><?php echo $o->title?></a></td>
			<td><a href="<?php echo get_author_link($o->belong, $o->type)?>"><?php echo $o->username?></a></td>
			<td><?php echo $o->comments?></td>
			<td><?php echo $o->time?></td>					
		</tr>
		<?php 
				}
			}
		?>
	</table>
	
	<div class="page-wrapper">
		<?php output_page_list($links);?>
	</div>
	
</div><!--end for topic-list-->

<div class="hot-topic-list">
	<h3>热门话题</h3>
	<?php 
		if(is_array($hot_list)){
			foreach($hot_list as $o){
	?>
	<div class="item"><a href="<?php echo $home.'/detail?id='.$o->id?>"><?php echo $o->title?></a></div>
	<?php 
			}
		}
	?>
	
</div>
<div class="clear"></div>
