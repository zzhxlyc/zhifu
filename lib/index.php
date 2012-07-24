<?php 

include(ROOT_DIR.'/lib/define.php');
if(file_exists(APP_DIR.'/define.php')){
	include(APP_DIR.'/define.php');
}
include(CORE_DIR.'/include.php');
include(CORE_DIR.'/init.php');
if(file_exists(APP_DIR.'/init.php')){
	include(APP_DIR.'/init.php');
}

$view = new View();
$request = new Request();
$response = new Response($view);
$router = new Router();
include(APP_DIR.'/router.php');
$dispatcher = new Dispatcher($request, $response, $router, $view);

if(!DEBUG){
	error_reporting(0);
	set_error_handler('error_handler');
}

$controller = $dispatcher->dispatch();
if($controller){
	extract($controller->get_vars());
}

$response->send();
$TEMPLATE_DIR = $view->get_template_dir();
$TEMPLATE_PAGE = $view->get_template();
$HTML = new HTMLHelper();
if($TEMPLATE_DIR && file_exists($TEMPLATE_DIR.'/t.php')){
	$TEMPLATE_PAGE = $TEMPLATE_DIR.'/t.php';
	include($view->get_layout_file());
}
else if($TEMPLATE_PAGE && file_exists($TEMPLATE_PAGE)){
	include($view->get_layout_file());
}

if(DEBUG && $view->layout != 'ajax'){
	$sql_list = &$DB->sql_dump();
	foreach($sql_list as $sql){
		echo "<p>$sql</p>";
	}
	foreach($ERROR->error_list as $error){
		$e = $error['error'];
		echo "<p>$e</p>";
	}
	foreach($ERROR->warning_list as $warning){
		$e = $warning['warning'];
		echo "<p>$e</p>";
	}
}
