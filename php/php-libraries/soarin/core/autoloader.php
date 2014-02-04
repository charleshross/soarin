<?php

// Register given function as __autoload() implementation
spl_autoload_register('soarin_autoloader');

// Soarin autoload function
function soarin_autoloader($input_classname) {

	// Performance optimization
	static $already_checked = array();
	if (array_key_exists($input_classname, $already_checked)) {
		return;
	}
	$already_checked[$input_classname] = true;
	
	$input_classname = preg_replace('/controllers\b/i','controllers',$input_classname);
	$input_classname = preg_replace('/models\b/i','models',$input_classname);
	$input_classname = str_replace("\\","/",$input_classname);
	
	// Zaphpa
	$zaphpa_path = SOARIN . '/router/zaphpa/plugins/' . $input_classname . '.class.php';
	
	if (file_exists($zaphpa_path)) {
		require_once ($zaphpa_path);
		return;
	}
	
	// App
	$soarin_controller = APP . '/' . $input_classname . '.php';
	
	if (file_exists($soarin_controller)) {
		require_once ($soarin_controller);
		return;
	}
	
	// Soarin
	$soarin_classes = SOARIN . '/core/' . $input_classname . '.php';
	
	if (file_exists($soarin_classes)) {
		require_once ($soarin_classes);
		return;
	}
	
	// File not found
	header("Content-Type: application/json;", TRUE, 404);
	$out = array("error" => "File not found for class $input_classname");
	die(json_encode($out));
	
}