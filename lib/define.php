<?php

if (!defined('DS')) {
	define('DS', '/');
}

//-----------------------DIR-------------------------
define('WEBROOT_DIR', ROOT_DIR.'/webroot');
define('CONF_DIR', ROOT_DIR.'/conf');


define('APP_DIR', ROOT_DIR.'/app');

define('LIB_DIR', APP_DIR.'/lib');
define('LIB_UTIL_DIR', APP_DIR.'/util');
define('MODEL_DIR', APP_DIR.'/model');
define('VIEW_DIR', APP_DIR.'/view');
define('LAYOUT_DIR', VIEW_DIR.'/layout');
define('MODULE_DIR', VIEW_DIR.'/module');

define('CORE_DIR', ROOT_DIR.'/lib');
define('CORE_LIB_DIR', CORE_DIR.'/lib');
define('CORE_M_DIR', CORE_DIR.'/model');
define('CORE_V_DIR', CORE_DIR.'/view');
define('CORE_C_DIR', CORE_DIR.'/controller');
define('CORE_CORE_DIR', CORE_DIR.'/core');
define('CORE_UTIL_DIR', CORE_DIR.'/util');

// ------------------------URL-----------------------
include(ROOT_DIR.'/lib/util/Config.php');
$CONF = new Config();
define('ROOT_URL', $CONF->get('WEB_URL_ROOT'));

define('JS_HOME', ROOT_URL.'/js');
define('CSS_HOME', ROOT_URL.'/css');
define('IMAGE_HOME', ROOT_URL.'/images');

// ------------------------Config-----------------------
date_default_timezone_set('Asia/Shanghai');
define('IP', $_SERVER['REMOTE_ADDR']);
define('TIMESTAMP', time());
define('DATETIME', date('Y-m-d H:i:s', TIMESTAMP));

define('DEBUG', $CONF->get('DEBUG'));
define('LOG', $CONF->get('LOG'));