<?php
/**
 * PDO static class for SQL Service
 * 
 * @package Soarin
 * @subpackage classes
 * @author Charles Ross <charleshross@gmail.com>
 * @version 0.0.1
 * 
 */

/**
 * Accepts commands from SQL for database processing
 * 
 * @package Soarin
 * @subpackage classes
 * @author Charles Ross <charleshross@gmail.com>
 * @version 0.0.1
 * 
 */

class SQL_PDO {
	
	/**
	 * Where the new database object is stored
	 * @property object $conn Instantiated database object
	 */
	public static $conn;
	
	/**
	 * Begins static class by checking to see if database object exists and if not then opens a new database connection and stores in $conn
	 * @link http://php.net/manual/en/pdo.connections.php PHP Documentation on PDO Connections
	 */
	public function __construct() {
		
		if(empty(self::$conn)) {
			
			// Attempt Connection
			try {
				$conn = new PDO(config::pdo_sql_driver.':host='.config::db_hostname.';dbname='.config::db_database.';charset=utf8', config::db_username, config::db_password);
			}
			
			// Connect Error
			catch (Exception $exception) {
				
				echo "Error: SQL Service connection failure";
				$error = new Log(1,"SQL Service connection failure");
				
				exit;
				
			}
			
			// Verbose Errors
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// Saved
			self::$conn = $conn;
			
		}
		
	}
	
	/**
	 * Returns the database connection $conn
	 * @return object
	 */
	public function get_conn() {
		
		return self::$conn;
		
	}
	
}
