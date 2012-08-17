<div class="filter clearfix">
	
	<div class="search">
		<input type="text" class="text" />
		<input type="button" class="btn" />
	</div>

</div><!--end for filter-->

<div class="section new-video">
	<h3>最新视频</h3>
	<div class="list clearfix">
<?php 
	if(is_array($list)){
		foreach($list as $o){
?>
		<div class="item">
			<div class="pic">
				<a target="_blank" href="<?php echo $home.'/url?id='.$o->id?>">
					<img src="<?php img($o->image)?>" alt="" width="150" height="120"/>
				</a>
			</div>
			<div class="des">
				<a target="_blank" href="<?php echo $home.'/url?id='.$o->id?>">
					<?php echo $o->title?>
				</a>
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
?>
		<div class="item">
			<div class="pic">
				<a target="_blank" href="<?php echo $home.'/url?id='.$o->id?>">
					<img src="<?php img($o->image)?>" alt="" width="150" height="120"/>
				</a>
			</div>
			<div class="des">
				<a target="_blank" href="<?php echo $home.'/url?id='.$o->id?>">
					<?php echo $o->title?>
				</a>
			</div>
		</div>
<?php 
		}
	}
?>		
		
	</div><!--end for list-->
	
	
</div><!--end for hot-video-->

<div class="clear"></div>