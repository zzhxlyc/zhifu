<!DOCTYPE HTML>
<html lang="en-US">
<head>
<?php $view->charset(); ?>
<?php $view->title(); ?>
<?php $view->fetch_meta(); ?>
<?php $view->icon(); ?>
<?php $view->css('admin/style'); ?>
<?php $view->css('jquery-ui'); ?>
<?php $view->fetch_css(); ?>
<script>
	window.ROOT_URL = '<?php echo ROOT_URL?>';
	window.ADMIN_URL = '<?php echo ADMIN_HOME?>';
	window.IMAGE_HOME = '<?php echo IMAGE_HOME?>';
</script>
<?php $view->js('jquery.min'); ?>
<?php $view->js('jquery-ui.min'); ?>
<?php $view->js('common'); ?>

<?php $view->js('province_city'); ?>

<?php $view->fetch_js(); ?>
</head>
<body>
	<div id="wrapper">
		<?php include(LAYOUT_DIR.'/admin/head.php'); ?>
		<div id="main" class="clearfix">

			<?php include($TEMPLATE_PAGE); ?>
			
		</div>
		<?php include(LAYOUT_DIR.'/admin/foot.php'); ?>
	</div><!--end for wrapper-->
</body>
</html>
