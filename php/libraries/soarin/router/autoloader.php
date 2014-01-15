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
	
	// Zaphpa
	$zaphpa_path = __DIR__ . '/zaphpa/plugins/' . $input_classname . '.class.php';
	
	if (file_exists($zaphpa_path)) {
		require_once ($zaphpa_path);
		return;
	}
	
	// Application
	$project_controllers = APP . '/' . str_replace('_', '/', $input_classname) . '.php';
	$project_controllers_c = APP . '/' . str_replace('_', '/', lcfirst($input_classname)) . '.php';
	
	if (file_exists($project_controllers)) {
		require_once ($project_controllers);
		return;
	} else if (file_exists($project_controllers_c)) {
		require_once ($project_controllers_c);
		return;
	}
	
	// Soarin library
	$soarin_classes = SOARIN . '/classes/' . str_replace('_', '/', $input_classname) . '.php';
	
	if (file_exists($soarin_classes)) {
		require_once ($soarin_classes);
		return;
	}
	
	// PHP Libraries
	$libraries_path = LIBRARIES . '/' . $input_classname . '.php';
	
	if (file_exists($libraries_path)) {
		require_once ($libraries_path);
		return;
	}
	
	// File not found
	header("Content-Type: application/json;", TRUE, 404);
	$out = array("error" => "File not found for class $input_classname");
	die(json_encode($out));
	
}