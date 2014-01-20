<?php

class config {
	
	/**
	 * Environment (DEVELOPMENT | PRODUCTION)
	 * IMPORTANT! If using 'PRODUCTION' make sure to disable public access to "/frontend" folder
	 */
	const env = 'DEVELOPMENT';
	
	/**
	 * Force URL's to end in slash
	 */
	const force_trailing_slash = TRUE;
	
	/**
	 * Force URL's to be lowercase
	 */
	const force_lower_case = TRUE;
	
	/**
	 * Session Name (no spaces)
	 * Enter something unique so that your project's session doesn't collide with other projects
	 */
	const soarin_session_name = '';
	
	/**
	 * Session Type (files|redis)
	 * Default is 'files'
	 */
	const soarin_session_save_handler = 'files';
	
	/**
	 * Redis Protocol
	 * Default is 'tcp'
	 */
	const redis_protocol = '';
	
	/**
	 * Redis Hostname
	 * Default is 'localhost'
	 */
	const redis_host = '';
	
	/**
	 * Redis Connection Port
	 * Default is '6379'
	 */
	const redis_port = '';
	
	/**
	 * Redis Database
	 * Default is '1'
	 */
	const redis_session_db = '';
	
	/**
	 * 	Session Path Override
	 * 	Leave blank to let Soarin handle this, or enter value to override the redis protocol/host/port/db configs above
	 */
	const soarin_session_save_path = '';
	
	/**
	 * PDO SQL Driver (mysql | pgsql)
	 */
	const pdo_sql_driver = 'mysql';
	
	/**
	 * SQL Hostname to Database (Ex: localhost)
	 */
	const db_hostname = 'localhost';
	
	/**
	 * SQL Database
	 */
	const db_database = '';
	
	/**
	 * SQL Database Username
	 */
	const db_username = '';
	
	/**
	 * SQL Database Password
	 */
	const db_password = '';
	
	/**
	 * Error logging reports
	 * 
	 * 0 = PRODUCTION (log no errors)
	 * 1 = FATAL only
	 * 2 = ERROR & FATAL
	 * 3 = WARN & ERROR & FATAL
	 * 4 = NOTICE & WARN & ERROR & FATAL
	 */
	const log_error_level = 4;
	
	/**
	 * Timezone for error log timestamp to be displayed in
	 */
	const error_timezone = 'UTC';
	
}