<?php

/**
 * Configuration
 *
 * You can leave these blank if you are using the default directory structure.
 * Providing the path here can save 10ms to load time.
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
define('SOARIN', __DIR__);

// PHP library path
if (!empty($libraries_folder)) {
	define('LIBRARIES', $libraries_folder);
} else {
	define('LIBRARIES', dirname(SOARIN));
}

// Application path
if (!empty($application_folder)) {
	define('APP', $application_folder);
} else {
	define('APP', dirname(LIBRARIES) . '/app');
}

// Models path
define('MODELS', APP . '/models');

// Views path
define('VIEWS', APP . '/views');

// Styles path
define('STYLES', APP . '/styles');

// Detect iPad
if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
	define('IS_IPAD', TRUE);
} else {
	define('IS_IPAD', FALSE);
}

/**
 * Booting
 *
 */

// Autoloader
include (SOARIN . '/router/autoloader.php');

// Config
require_once (APP . '/config/config.php');

// Sessions
include (SOARIN . '/router/sessions.php');

// URL filter
include (SOARIN . '/router/url.php');

// Router
include (SOARIN . '/router/router.php');
