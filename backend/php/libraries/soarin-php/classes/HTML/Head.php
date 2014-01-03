<?php

class HTML_Head {

	public $frontend_folder = null;

	// info
	public $title = null;
	public $icon = array();
	
	// scripts
	public $js = array();
	public $css = array();
	public $less = array();

	public function __construct($frontend_folder) {

		$this -> frontend_folder = $frontend_folder;

		// Libraries JSON
		$libs_file = file_get_contents(PATH_FRONTEND . '/libraries/libraries.json');
		$libs = json_decode($libs_file, true);

		// Frontend libraries selected
		$frontend_libs_file = file_get_contents(PATH_FRONTEND . '/' . $frontend_folder . '/libraries.json');
		$frontend_libs = json_decode($frontend_libs_file, true);

		if ($frontend_libs == NULL) {
			throw new Exception('/frontend/'.$frontend_folder.'/library.json error');
		}

		$this -> load_libs($libs, $frontend_libs);

	}

	public function load_libs($libs, $frontend_libs) {

		$frontend_folder = $this -> frontend_folder;

		$js = $this -> js;
		$css = $this -> css;
		$less = $this -> less;

		if (config::env == 'DEVELOPMENT') {

			// JSON library load
			foreach ($frontend_libs['libraries'] as $key => $value) {

				if ($libs[$key]) {

					//print_r ($libs[$key]);

					if ($libs[$key]['autoload']['development'] == 1) {

						if (!empty($libs[$key]['js'])) {
							$js = array_merge($js, $libs[$key]['js']);
						}

						if (!empty($libs[$key]['css'])) {
							$css = array_merge($css, $libs[$key]['css']);
						}

					}

				}

			}

			// Maser LESS fiLE
			if (is_file(PATH_FRONTEND . '/' . $frontend_folder . '/less/index.less')) {

				$less[] = '/' . $frontend_folder . '/less/index.less';

			}

			// Maser CSS fiLE
			if (is_file(PATH_FRONTEND . '/' . $frontend_folder . '/css/index.css')) {

				$less[] = '/' . $frontend_folder . '/css/index.css';

			}

		} else if (config::env == 'PRODUCTION') {

			// library css
			if (IS_FILE(PATH_PUBLIC . '/' . $frontend_folder . '/libraries/libraries.css')) {
				$css[] = '/'.$frontend_folder.'/libraries/libraries.css';
			}

			// frontend css
			//if (IS_FILE(PATH_PUBLIC . '/' . $frontend_folder . '/css/master.css')) {
			//	$css[] = '/' . $frontend_folder . '/css/master.css';
			//}

			// library js
			if (IS_FILE(PATH_PUBLIC . '/' . $frontend_folder . '/libraries/libraries.js')) {
				$js[] = '/'.$frontend_folder.'/libraries/libraries.js';
			}

		}

		$this -> js = $js;
		$this -> css = $css;
		$this -> less = $less;

	}

	public function title($title) {

		$this -> title = $title;

	}

	public function js($js) {

		$this -> js[] = '/' . $this -> frontend_folder . '/js/' . $js;

	}

	public function less($less) {
		
		if (config::env == 'DEVELOPMENT') {
		
			$this -> less[] = '/' . $this -> frontend_folder . '/less/' . $less;
		
		}
		
		else if (config::env == 'PRODUCTION') {
			
			$this -> less[] = '/' . $this -> frontend_folder . '/css/' . $less . '.css';
			
		}
	}
	
	public function css($css) {

		$this -> css[] = '/' . $this -> frontend_folder . '/css/' . $css;

	}

	public function load_less() {

		$less = $this -> less;

		foreach ($less as $key => $value) {

			if (config::env == 'DEVELOPMENT') {

				$value = '/frontend' . $value;
				
				echo "<link rel='stylesheet/less' type='text/css' href='" . $value . "'> \n";
				
			} else if (config::env == 'PRODUCTION') {
				
				echo "<link rel='stylesheet' type='text/css' href='" . $value . "'> \n";
				
			}

			

		}

	}

	public function load_css() {

		$css = $this -> css;

		foreach ($css as $key => $value) {

			if (config::env == 'DEVELOPMENT') {

				$value = '/frontend' . $value;

			}

			echo "<link rel='stylesheet' type='text/css' href='" . $value . "'> \n";

		}

	}

	public function load_js() {

		$js = $this -> js;

		foreach ($js as $key => $value) {

			if (config::env == 'DEVELOPMENT') {

				$value = '/frontend' . $value;

			}

			echo "<script src='" . $value . "'></script> \n";

		}

	}
	
	public function icon($icon) {
		
		$this -> icon[] = '/' . $this -> frontend_folder . '/images/' . $icon;
		
	}
	
	public function load_favicon() {
		
		$icon = $this->icon;
		
		if (!empty($icon)) {
			
			$extension = pathinfo($icon[0], PATHINFO_EXTENSION);
			
			if (config::env == 'DEVELOPMENT') {

				$value = '/frontend' . $icon[0];
				
				echo "<link rel='icon' type='image/{$extension}' href='{$value}' /> \n";

			} else if (config::env == 'PRODUCTION') {
				
				$value = $icon[0];
				
				echo "<link rel='icon' type='image/{$extension}' href='{$value}' /> \n";
				
			}
			
		}
		
	}
	
	public function output() {

		$title = $this -> title;

		// HTML5 Doctype
		echo "<!DOCTYPE html> \n";

		// HTML tag
		echo "<html> \n";

		// Head tag start
		echo "<head> \n";

		// Title
		if ($title) {

			echo "<title>{$title}</title> \n";

		}
		
		// Favicon
		$this -> load_favicon();
		
		// CSS
		$this -> load_css();

		// LESS
		$this -> load_less();

		// JS
		$this -> load_js();

		// Head tag end
		echo "</head> \n";

	}

}
