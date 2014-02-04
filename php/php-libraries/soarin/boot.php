<?php

// configuration file
include ('config.php');

// paths
$doc_root = rtrim($_SERVER['DOCUMENT_ROOT'],'/');
define('SOARIN', realpath(__DIR__));
define('PHP', realpath($doc_root . config::php_dir));
define('APP',realpath($doc_root . config::app_dir));
define('CONTROLLERS',realpath($doc_root . config::controllers_dir));
define('MODELS',realpath($doc_root . config::models_dir));
define('VIEWS',realpath($doc_root . config::views_dir));
define('STYLES',realpath($doc_root . config::styles_dir));
define('LIBRARIES',realpath($doc_root . config::libraries_dir));
define('LOGS',realpath($doc_root . config::logs_dir));
define('ROUTES_FILE',realpath($doc_root . config::routes_file));
define('ROUTES_ERRORS_FILE',realpath($doc_root . config::routes_errors_file));

// urls
include (SOARIN . '/core/url.php');

// autoloader
include (SOARIN . '/core/autoloader.php');

// sessions
include (SOARIN . '/core/sessions.php');

// router
include (SOARIN . '/router/router.php');
