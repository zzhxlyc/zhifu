<?php

$router->add('/', array('C'=>'AdminController', 'M'=>'login', 'prefix'=>'/admin'));
$router->add('/login', array('C'=>'AdminController', 'M'=>'login', 'prefix'=>'/admin'));
$router->add('/pswd', array('C'=>'AdminController', 'M'=>'pswd', 'prefix'=>'/admin'));