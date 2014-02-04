<?php

class config {
	
	/**
	 * Directory configuration
	 */
	const php_dir = '/../php';
	const app_dir = '/../php/app';
	const controllers_dir = '/../php/app/controllers';
	const models_dir = '/../php/app/models';
	const views_dir = '/../php/app/views';
	const styles_dir = '/../php/app/styles';
	const libraries_dir = '/../php/php-libraries';
	const logs_dir = '/../php/logs';
	
	/**
	 * Routes configuration
	 */
	const routes_file = '/../php/app/routes/routes.php';
	const routes_errors_file = '/../php/app/routes/errors.php';
	
	/**
	 * Environment (DEVELOPMENT | PRODUCTION)
	 * IMPORTANT! If using 'PRODUCTION' make sure to disable public access to "/frontend" folder
	 */
	const env = 'DEVELOPMENT';
	
	/**
	 * Force URL's to be lowercase
	 */
	const force_lowercase_urls = TRUE;
	
	/**
	 * Session Name (no spaces)
	 * Enter something unique so that your project's session doesn't collide with other projects
	 */
	const soarin_session_name = 'ENTER_SOMETHING_UNIQUE_HERE!';
	
	/**
	 * Session autoload
	 */
	const session_autoload = true;
	
	/**
	 * Session Type (files|redis)
	 * Default is 'files'
	 */
	const soarin_session_save_handler = 'files';
	
	/**
	 * Redis Protocol
	 * Default is 'tcp'
	 */
	const redis_protocol = 'tcp';
	
	/**
	 * Redis Hostname
	 * Default is 'localhost'
	 */
	const redis_host = 'localhost';
	
	/**
	 * Redis Connection Port
	 * Default is '6379'
	 */
	const redis_port = '6379';
	
	/**
	 * Redis Database
	 * Default is '1'
	 */
	const redis_session_db = '1';
	
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