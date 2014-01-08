<?php

// process URL
if (config::force_trailing_slash || config::force_lower_case) {

	// start of url protocol
	$url = 'http';

	// add s for https protocol?
	if (@$_SERVER["HTTPS"] == "on") {

		$url .= "s";

	}

	// add colon slash slash for end of URL's protocol
	$url .= "://";

	/**
	 * Build URI section of URL (Ex: www.domain.com:8080 )
	 */

	// add full uri to domain
	$url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

	// Save parsed URL
	$parsed_url = parse_url($url);

	// force trailing slash
	if (config::force_trailing_slash) {

		// no trailing slash?
		if (substr($parsed_url['path'], -1) != '/') {

			// build full path with trailing slash
			$new_path = $parsed_url['path'] . '/';
			if (@$parsed_url['query']) {
				$new_path .= '?' . $parsed_url['query'];
			}

			// redirect header to properly slashed path
			header('Location: ' . $new_path);
			exit ;

		}

	}

	// force lowercase
	if (config::force_lower_case) {

		// upper case alphabetical?
		if (preg_match('/[A-Z]/', $parsed_url['path'])) {

			// build full path
			$new_path = $parsed_url['path'];
			if (@$parsed_url['query']) {
				$new_path .= '?' . $parsed_url['query'];
			}

			// lower case full path
			$new_path = strtolower($new_path);

			// redirect header to properly cased path
			header('Location: ' . $new_path);
			exit ;

		}

	}

}
