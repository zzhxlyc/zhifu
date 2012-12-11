<?php
/*
 * $router->add('/home', array('C'=>'UserController', 
 * 								'M'=>'index',
 * 								'module'=>'folder_name',
 * 								'prefix'=>'/'));
 */
$router->add('/', array('C'=>'ZhifuController', 'M'=>'index'));
$router->add('/login', array('C'=>'LoginController', 'M'=>'login'));
$router->add('/logout', array('C'=>'LoginController', 'M'=>'loginout'));
$router->add('/reset', array('C'=>'LoginController', 'M'=>'reset'));
$router->add('/captcha', array('C'=>'ZhifuController', 'M'=>'captcha'));
$router->add('/register', array('C'=>'ZhifuController', 'M'=>'register'));
$router->add('/home', array('C'=>'ZhifuController', 'M'=>'home'));
$router->add('/setting', array('C'=>'ZhifuController', 'M'=>'setting'));
$router->add('/service', array('C'=>'StaticController', 'M'=>'service'));
$router->add('/about', array('C'=>'StaticController', 'M'=>'about'));
$router->add('/contact', array('C'=>'StaticController', 'M'=>'contact'));

$router->add_prefix('/admin', 'admin');
include('admin/router.php');