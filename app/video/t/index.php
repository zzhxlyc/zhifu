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
			<div class="pic"><img src="<?php img($o->image)?>" alt="" width="150" height="120"/></div>
			<div class="des"><?php echo $o->title?></div>
		</div>

<?php 
		}
	}
?>
	</div><!--end for list-->
</div><!--end for new-video-->



<div class="section hot-video">
	<h3>最热视频</h3>
	<div class="list clearfix">
		<div class="item">
			<div class="pic"><img src="http://zjuhpp.com/demo/wp-content/uploads/2012/02/hero.jpg" alt="" width="150" height="120"/></div>
			<div class="des">xxxx</div>
		</div>
		
		
	</div><!--end for list-->
	
	
</div><!--end for hot-video-->

<div class="clear"></div>
