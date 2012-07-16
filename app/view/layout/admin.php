<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $view->charset(); ?>
<?php $view->title(); ?>
<?php $view->fetch_meta(); ?>
<?php $view->icon(); ?>
<?php $view->css('style'); ?>
<?php $view->fetch_css(); ?>
<?php $view->js('common'); ?>
<?php $view->fetch_js(); ?>
</head>
<body>
	<div id="container">
		<?php include(LAYOUT_DIR.'/admin/head.php'); ?>
		<div id="content">

			<?php include($TEMPLATE_PAGE); ?>
			
		</div>
		<?php include(LAYOUT_DIR.'/admin/foot.php'); ?>
	</div>
</body>
</html>
