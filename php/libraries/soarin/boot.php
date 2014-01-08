<?php

/**
 * Configuration
 * 
 * You can leave these blank if you are using the default directory structure.
 * 
 */

// Application folder
$application_folder = '';

// PHP Libraries folder
$libraries_folder = '';

/**
 * Setting paths
 * 
 */

// Soarin library path
define('PATH_SOARIN',__DIR__);

// PHP library path
if (!empty($libraries_folder)) {
	define('PATH_LIBRARIES',$libraries_folder);
} else {
	define('PATH_LIBRARIES',dirname(PATH_SOARIN));
}

// Application path
if (!empty($application_folder)) {
	define('PATH_APP',$application_folder);
} else {
	define('PATH_APP',dirname(PATH_LIBRARIES) . '/app');
}

// Models path
define('PATH_MODELS',PATH_APP.'/models');

// Views path
define('PATH_VIEWS',PATH_APP.'/views');

// Styles path
define('PATH_STYLES',PATH_APP.'/styles');

/**
 * Booting
 * 
 */

// Autoloader
include(PATH_SOARIN.'/router/autoloader.php');

// Config
require_once (PATH_APP . '/config/config.php');

// URL filter
include (PATH_SOARIN.'/router/url.php');

// Router
include(PATH_SOARIN.'/router/router.php');
