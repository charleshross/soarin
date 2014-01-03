<?php

class config {
	
	// Environment (DEVELOPMENT | PRODUCTION)
	// IMPORTANT! If using 'PRODUCTION' make sure to disable public access to "/frontend" folder
	const env = 'DEVELOPMENT';
	
	// Force URL's to end in slash '/'
	const force_trailing_slash = TRUE;
	
	// Force URL's to be lowercase
	const force_lower_case = TRUE;
	
}