<?php

/**
 * Setting Session
 */

// File Based Sessions
if (config::soarin_session_save_handler == 'files' || config::soarin_session_save_handler == '') {

	// session type
	ini_set('session.save_handler', 'files');

	// session name
	if (config::soarin_session_name != '') {
		ini_set('session.name', config::soarin_session_name);
	}

}

// Redis Based Sessions
else if (config::soarin_session_save_handler == 'redis') {

	// session type
	ini_set('session.save_handler', 'redis');

	// Build Session Path
	if (config::soarin_session_save_path == '') {

		$session_path = '';
		$query = array();

		// Protocol
		if (config::redis_protocol == '') {
			$session_path .= 'tcp://';
		} else {
			$session_path .= config::redis_protocol . '://';
		}

		// Host
		if (config::redis_host == '') {
			$session_path .= 'localhost';
		} else {
			$session_path .= config::redis_host;
		}

		// Port
		if (config::redis_port == '') {
			$session_path .= ':6379';
		} else {
			$session_path .= ':' . config::redis_port;
		}

		// Session Name
		if (config::soarin_session_name != '') {
			$query['prefix'] = config::soarin_session_name . ":";
		}

		// Redis Database
		if (config::soarin_session_name != '') {
			$query['database'] = config::redis_session_db;
		}
		
		$session_path .= '?' . http_build_query($query);

	}

	// Override Session Path
	else {

		$session_path = config::soarin_session_save_path;

	}

	// Set Session Path
	ini_set('session.save_path', $session_path);

}

// Override Session Types
else {

	// hardcoded session type
	ini_set('session.save_handler', config::soarin_session_save_handler);

	// session name
	if (config::soarin_session_name != '') {
		ini_set('session.name', config::soarin_session_name);
	}

}

// Initiate Sessions
session_start();
session_write_close();
