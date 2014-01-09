<?php

// Zaphpa router library
include (__DIR__ . '/zaphpa/zaphpa.lib.php');

// Start zaphpa router
$router = new Zaphpa_Router();

// Project rules
include (APP . '/config/routes.php');

// Route attempt
try {

	$router -> route();

}

// Route failed
catch (Zaphpa_InvalidPathException $ex) {

	include(APP . '/config/errors.php');

}