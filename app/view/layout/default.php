<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<?php $view->charset(); ?>
<?php $view->title(); ?>
<?php $view->fetch_meta(); ?>
<?php $view->icon(); ?>
<?php $view->css('style'); ?>
<?php $view->fetch_css(); ?>
<script>
	window.ROOT_URL = '<?php echo ROOT_URL?>';
	window.IMAGE_HOME = '<?php echo IMAGE_HOME?>';
</script>
<?php $view->js('common'); ?>
<?php $view->fetch_js(); ?>
</head>
<body>
	<div id="container">
	
		<?php include(LAYOUT_DIR.'/default/head.php'); ?>
	
		<div class="wrapper">
			<div class="main">
				
				<?php include($TEMPLATE_PAGE); ?>
			</div>
		</div>
		
		<?php include(LAYOUT_DIR.'/default/foot.php'); ?>
		
	</div>
</body>
</html>
