<?php

namespace Soarin {
	
	class Controller {
		
		public $result = array();
		
		public function view($view = null) {
			
			if (!$view) {
				$view = preg_replace('/controllers\b/i','',str_replace("\\","/",get_class($this)));
				$view = VIEWS . $view . '.php';
			} else {
				$view = '/' . ltrim($view,'/');
			}
			
			if (is_file($view)) {
				include ($view);
			} else {
				echo "Error loading view: {$view}";
				exit;
			}
			
		}
		
	}
}