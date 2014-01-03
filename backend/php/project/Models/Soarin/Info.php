<?php

class Models_Soarin_Info {
	
	public $info = array();
	
	public function __construct() {
		
		$this->info['site_name'] = config::project_name;
		
	}
	
	public function site_name() {
		
		return $this->info['site_name'];
		
	}
	
}
