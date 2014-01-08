<?php
/**
 * Logging Service
 * 
 * @package Soarin
 * @subpackage classes
 * @author Charles Ross <charleshross@gmail.com>
 * @version 0.0.1
 * 
 */

/**
 * Logs errors in /backend/php/logs/ folder
 * 
 * <b>Usage Example:</b>	
 * 
 * 	$object = new Core_Log('WARN','Foo caused a problem','error_file.log');
 * 
 * @package Soarin
 * @subpackage classes
 * @author Charles Ross <charleshross@gmail.com>
 * @version 0.0.1
 * 
 */
class Log {
	
	/**
	 * Class is instantiated with basic error parameters
	 * @param string $level Error log level (1 FATAL, 2 ERROR, 3 WARN, 4 NOTICE)
	 * @param string $message Error message sent from malfunctioning object
	 * @param boolean $is_method Was error sent from within a method that handles errors?
	 */
	public function __construct($level,$message,$file_name = 'errors.log') {
		
		// Timestamp
		$datetime = new DateTime('now',new DateTimeZone(config::error_timezone));
		$time = $datetime->format('Y-m-d H:i:s');
		
		// Error Types
		$error_type = array(
			1 => '[FATAL]',
			2 => '[ERROR]',
			3 => '[WARN]',
			4 => '[NOTICE]',
		);
		
		// Error message entry
		$error_message = "[$time] " . $error_type[$level] . " ". $message . "\r\n";

		// Log file path to write to
		$log_filepath = PATH_APP . '/logs/' . $file_name;
		
		// Error Level Reached?
		if (config::log_error_level >= $level) {
			
			// Log Write
			$log = fopen($log_filepath, 'a');
			
			if (flock($log, LOCK_EX)) {
				
				fwrite($log, $error_message . PHP_EOL);
				fflush($log);
				flock($log, LOCK_UN);
				
			}
			
			fclose($log);
			
		}
		
	}
	
}
