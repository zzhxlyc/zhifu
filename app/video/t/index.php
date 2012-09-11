
<div class="section new-video">
	<h3>最新视频</h3>
	<div class="list clearfix">
<?php 
	if(is_array($list)){
		foreach($list as $o){
			$title = subString($o->title, 10);
?>
		<div class="item">
			<div class="pic">
				<a target="_blank" href="<?php echo $home.'/url?id='.$o->id?>">
					<img src="<?php img($o->image, $o->default_image())?>" alt="" width="160" height="120"/>
				</a>
			</div>
			<div class="des">
				<a target="_blank" href="<?php echo $home.'/url?id='.$o->id?>">
					<?php echo $title?>
				</a>
			</div>
			<div class="des">
				<?php echo get_date($o->time)?> 点击 ：<?php echo intval($o->click)?>
			</div>
		</div>

<?php 
		}
	}
?>
	</div><!--end for list-->
	
	<div class="page-wrapper">
		<?php output_page_list($links);?>
	</div>
	
</div><!--end for new-video-->



<div class="section hot-video">
	<h3>最热视频</h3>
	<div class="list clearfix">
<?php 
	if(is_array($hot_list)){
		foreach($hot_list as $o){
			$title = subString($o->title, 10);
?>
		<div class="item">
			<div class="pic">
				<a target="_blank" href="<?php echo $home.'/url?id='.$o->id?>">
					<img src="<?php img($o->image, $o->default_image())?>" alt="" width="160" height="120"/>
				</a>
			</div>
			<div class="des">
				<a target="_blank" href="<?php echo $home.'/url?id='.$o->id?>">
					<?php echo $title?>
				</a>
			</div>
			<div class="des">
				<?php echo get_date($o->time)?> 点击 ：<?php echo intval($o->click)?>
			</div>
		</div>
<?php 
		}
	}
?>		
		
	</div><!--end for list-->
	
	
</div><!--end for hot-video-->

<div class="clear"></div>
