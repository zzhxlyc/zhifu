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
		
			<?php include($TEMPLATE_PAGE); ?>
			
		<div class="footer">
			<div class="footer_inner">
			     <p>
					<span class="fl">版权所有 © </span>
					<span class="fr"><a href="#" target="_blank" class="a_first">关于我们</a>| <a href="#" target="_blank" class="a_first">联系我们</a>|<a href="#" class="a_last">服务条款</a>  </span></p>
		</div>


		</div>
	</div>
</body>
</html>
