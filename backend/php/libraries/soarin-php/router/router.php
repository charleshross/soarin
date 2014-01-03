<?php

// Zaphpa router library
include (__DIR__ . '/zaphpa/zaphpa.lib.php');

// Start zaphpa router
$router = new Zaphpa_Router();

// Project rules
include (PATH_PROJECT . '/config/routes.php');

// Route attempt
try {

	$router -> route();

}

// Route failed
catch (Zaphpa_InvalidPathException $ex) {

	include(PATH_PROJECT . '/config/errors.php');

}