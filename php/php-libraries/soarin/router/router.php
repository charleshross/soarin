<?php

// Zaphpa router library
include (SOARIN . '/router/zaphpa/zaphpa.lib.php');

// Start zaphpa router
$router = new Zaphpa_Router();

// Router rules
include (ROUTES_FILE);

// Router attempt
try {

	$router -> route();

}

// Router error
catch (Zaphpa_InvalidPathException $ex) {

	include(ROUTES_ERRORS_FILE);

}