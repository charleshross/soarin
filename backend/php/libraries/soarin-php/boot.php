<?php

// Paths
$base_path = dirname($_SERVER['DOCUMENT_ROOT']);
define('PATH_BASE',$base_path);
define('PATH_PHP',$base_path.'/backend/php');
define('PATH_BACKEND',$base_path.'/backend');
define('PATH_FRONTEND',$base_path.'/frontend');
define('PATH_PUBLIC',$base_path.'/public');
define('PATH_PROJECT',PATH_PHP.'/project');
define('PATH_SOARIN',PATH_PHP.'/libraries/soarin-php');
define('PATH_MODELS',PATH_PROJECT.'/Models');
define('PATH_VIEWS',PATH_PROJECT.'/Views');

// Autoloader
include(PATH_SOARIN.'/router/autoloader.php');

// Config
require_once (PATH_PROJECT . '/config/config.php');

// URL filter
include (PATH_SOARIN.'/router/url.php');

// Router
include(PATH_SOARIN.'/router/router.php');
