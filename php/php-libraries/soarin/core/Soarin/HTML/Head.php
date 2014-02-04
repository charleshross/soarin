<?php
namespace Soarin\HTML {
	use \config as config;
	class Head {

		// meta
		public $title = null;
		public $icon = array();

		// styles
		public $js = array();
		public $css = array();
		public $less = array();
		public $inline = array();

		public function __construct($autoload = true) {

			// Autoload libraries
			if ($autoload == true) {
				$this -> autoload_libraries();
			}

		}

		// Autoload libraries
		public function autoload_libraries() {

			// DEVELOPMENT autoload
			if (config::env == 'DEVELOPMENT') {

				// JSON file locations
				$json_autoload = STYLES . '/autoload.json';
				$json_libraries = STYLES . '/libraries/libraries.json';

				// Autoload JSON Check
				if (!is_file($json_autoload)) {

					echo "Error: '/styles/autoload.json' file missing, halting.";
					exit ;

				}

				// Libraries JSON Check
				if (!is_file($json_libraries)) {

					echo "Error: '/styles/libraries/libraries.json' file missing, halting.";
					exit ;

				}

				// Decoding JSON
				$json_autoload = json_decode(file_get_contents($json_autoload), true);
				$json_libraries = json_decode(file_get_contents($json_libraries), true);

				// autoload.json
				if (!empty($json_autoload['libraries'])) {

					// loop autoload.json
					foreach ($json_autoload['libraries'] as $key => $value) {

						// default?
						if ($value == 'default') {

							// library selected
							$library = $json_libraries[$key];

							// autoload for development?
							if ($library['autoload']['development'] == 1) {

								// CSS
								if (!empty($library['css'])) {

									foreach ($library['css'] as $key => $value) {

										$this -> css[$value] = $value;

									}

								}

								// JS
								if (!empty($library['js'])) {

									foreach ($library['js'] as $key => $value) {

										$this -> js[$value] = $value;

									}

								}

							}

						}

					}

				}

			}

			// PRODUCTION autoload
			else if (config::env == 'PRODUCTION') {

				if (!is_dir(WEB . '/styles/')) {

					echo "Error: Failure loading production files, did you run the grunt script? <a href='https://github.com/charleshross/soarin#readme'>Soarin README file</a>";
					exit ;

				}

				$this -> css['/styles/libraries/libraries.css'] = '/styles/libraries/libraries.css';
				$this -> js['/styles/libraries/libraries.js'] = '/styles/libraries/libraries.js';

			}

		}

		// Inserting
		public function title($title) {

			$this -> title = $title;

		}

		public function icon($path) {

			$this -> icon = $path;

		}

		public function css($path) {

			$this -> css[$path] = $path;

		}

		public function less($path) {

			$this -> less[$path] = $path;

		}

		public function js($path) {

			$this -> js[$path] = $path;

		}

		public function inline($code) {
			
			$this -> inline[] = $code;
			
		}

		public function file_check($path) {

			if (!is_file(APP . $path)) {

				echo "Error: Failure autoloading library files, '" . APP . $path . "' does not exist, halting.";
				exit ;

			}

		}

		// Rendering
		public function render_title() {

			$title = $this -> title;

			if (!empty($title)) {

				echo "<title>{$title}</title> \n";

			}

		}

		public function render_favicon() {

			$icon = $this -> icon;

			if (!empty($icon)) {

				if (config::env == 'DEVELOPMENT') {

					$this -> file_check($icon);

				}

				$extension = pathinfo($icon[0], PATHINFO_EXTENSION);

				echo "<link rel='icon' type='image/{$extension}' href='{$icon}' /> \n";

			}

		}

		public function render_css() {

			$css = $this -> css;

			if (!empty($css)) {

				foreach ($css as $key => $value) {

					if (config::env == 'DEVELOPMENT') {

						$this -> file_check($value);

					}

					echo "<link rel='stylesheet' type='text/css' href='" . $value . "'> \n";

				}

			}

		}

		public function render_less() {

			$less = $this -> less;

			if (!empty($less)) {

				foreach ($less as $key => $value) {

					if (config::env == 'DEVELOPMENT') {

						$this -> file_check($value);

						echo "<link rel='stylesheet/less' type='text/css' href='" . $value . "'> \n";

					}

					if (config::env == 'PRODUCTION') {

						$value .= '.css';

						echo "<link rel='stylesheet' type='text/css' href='" . $value . "'> \n";

					}

				}

			}

		}

		public function render_js() {

			$js = $this -> js;

			if (!empty($js)) {

				foreach ($js as $key => $value) {

					if (config::env == 'DEVELOPMENT') {

						$this -> file_check($value);

					}

					echo "<script src='" . $value . "'></script> \n";

				}

			}

		}

		public function render_inline() {

			$inline = $this -> inline;
			
			if (!empty($inline)) {

				foreach ($inline as $key => $value) {

					echo $value;

				}

			}

		}

		public function output() {

			// HTML5 Doctype
			echo "<!DOCTYPE html> \n";

			// HTML tag
			echo "<html> \n";

			// Head tag start
			echo "<head> \n";

			// Title
			$this -> render_title();

			// Favicon
			$this -> render_favicon();

			// CSS
			$this -> render_css();

			// LESS
			$this -> render_less();

			// JS
			$this -> render_js();

			// INLINE
			$this -> render_inline();

			// Head tag end
			echo "</head> \n";

		}

	}
}