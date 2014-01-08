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
	 * Unique Project Name
	 */
	const project_name = 'Soarin-PHP';
	
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