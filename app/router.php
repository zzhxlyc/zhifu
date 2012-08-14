<?php
/*
 * $router->add('/home', array('C'=>'UserController', 
 * 								'M'=>'index',
 * 								'module'=>'folder_name',
 * 								'prefix'=>'/'));
 */
$router->add('/', array('C'=>'ProblemController', 'M'=>'index'));
$router->add('/init', array('C'=>'InitController', 'M'=>'index'));
$router->add('/test', array('C'=>'InitController', 'M'=>'test'));

$router->add_prefix('/admin', 'admin');
include('admin/router.php');