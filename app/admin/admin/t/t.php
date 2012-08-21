
	<?php 
		if($request->get_module() == 'admin' && $request->get_method() == 'pswd'){
			include(ADMIN_DIR.'/view/sidebar7.php');
		}
		else if(!$is_login){
			include(ADMIN_DIR.'/view/sidebar2.php');
		}
	?>

<div class="main-content">
	<?php 
		include($view->get_template());
	?>
</div>