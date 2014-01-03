<?php

class Controllers_Soarin_Soarin {
	
	public function read($req, $res) {
		
		$info = new Models_Soarin_Info();
		$site_name = $info->site_name();
		
		include(PATH_VIEWS . '/soarin/index.php');
		
	}
	
}