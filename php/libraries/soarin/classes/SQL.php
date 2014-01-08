<?php
/**
 * SQL Service
 *
 * @package Soarin
 * @subpackage classes
 * @author Charles Ross <charleshross@gmail.com>
 * @version 0.0.1
 *
 */

/**
 * Sends commands to SQL_PDO for Database processing
 *
 * <b>Usage Example:</b>
 *
 * 	$sql = new Core_SQL();				// New SQL Object
 * 	$sql->begin_transaction();			// Disables Auto-Commit
 * 	$query = "							// Your SQL Query
 * 		SELECT *
 * 		FROM TABLE
 * 		WHERE USERNAME = :USERNAME
 * 	";
 * 	$statement = array (				// Prepared Statement
 * 		':USERNAME' => '$username',
 * 	);
 * 	$sql->query($query,$statement);		// Safe Uninjectable Query
 * 	$last_id = $sql->last_insert_id();	// Returns ID of last inserted row
 * 	$row_count = $sql->row_count();		// Returns result row count
 * 	$sql->commit_transaction();			// Saves database changes
 *
 *  foreach ($sql->result as $row) {
 * 		echo $row['column_name'];
 * 	}
 *
 * @package Soarin
 * @subpackage classes
 * @author Charles Ross <charleshross@gmail.com>
 * @version 0.0.1
 *
 */

class SQL {

	/**
	 * Where the database object is stored (temporarily, Core_SQL keeps the original as a static class)
	 * @property object $conn Instantiated database object
	 */
	public $conn;

	/**
	 * All SQL results are saved here
	 * @property object $result Returned result set from database query
	 */
	public $result;

	public $error = false;

	/**
	 * Instantiating this class makes sure to check if a pre-existing SQL connection is already running and if not creates a new one.
	 * @see Core_PDO
	 */
	public function __construct() {

		$pdo = new SQL_PDO();
		$this -> conn = $pdo -> get_conn();

	}

	/**
	 * Lets you run a query
	 * @param string $query Your SQL statement
	 * @param array $prepare Your binded parameters for a prepared statement in $query
	 * @link http://php.net/manual/en/pdo.query.php PDO Documentation on Querys
	 * @link http://php.net/manual/en/pdo.prepared-statements.php PDO Documentation Prepared Statements
	 */
	public function query($query, $prepare = NULL) {

		$conn = $this -> conn;

		// Query Only
		if ($prepare == NULL) {

			try {

				$result = $conn -> query($query);
				$this -> result = $result;

			} catch (PDOException $exception) {

				$this -> error = true;
				$this -> error($exception);
			}
			// Prepared Statement
		} else {

			if (!is_array($prepare)) {

				throw new Exception('\$prepare must be an array');

			}

			try {

				$result = $conn -> prepare($query);
				$result -> execute($prepare);
				$this -> result = $result;

			} catch (PDOException $exception) {

				$this -> error = true;
				$this -> error($exception);

			}

		}

	}

	public function error($exception) {

		$error_msg = $exception -> getMessage();
		$error_code = $exception -> getCode();
		$error_line = $exception -> getLine();
		$error_file = $exception -> getFile();
		$error_trace = $exception -> getTrace();
		$error_script = $error_trace[1]['args'][0];

		echo "<b>[SQL Service Error]</b>" . "<br>\r\n";
		echo "<b>Code: </b>" . $error_code . "<br>\r\n";
		echo "<b>Message: </b>" . $error_msg . "<br>\r\n";
		echo "<b>On line: </b>" . $error_line . "<br>\r\n";
		echo "<b>In file: </b>" . $error_file . "<br>\r\n";
		echo "<b>Query: </b>" . $error_script . "<br>\r\n \r\n";

		$error = new Log(2, "SQL ERROR | CODE = " . $error_code . " | MESSAGE = " . $error_msg . " | ON LINE = " . $error_line . " | IN FILE = " . $error_line . " | QUERY = " . $error_script, 'sql.log');

	}

	/**
	 * Begins a SQL Transaction (turns off auto-commit in PDO).
	 * @link http://php.net/manual/en/pdo.begintransaction.php PDO documentation on beginTransaction() method
	 */
	public function begin_transaction() {

		$this -> conn -> beginTransaction();

	}

	/**
	 * Ends an SQL Transaction and all queries to SQL are now made official
	 * @link http://php.net/manual/en/pdo.commit.php PDO documentation on commit() method
	 */
	public function commit_transaction() {

		$this -> conn -> commit();

	}

	/**
	 * Erases all of your pending commits if you began a transaction
	 * @see begin_transaction()
	 * @link http://php.net/manual/en/pdo.rollback.php PDO documentation on rollBack() method
	 */
	public function rollback_transaction() {

		$this -> conn -> rollBack();

	}

	/**
	 * Returns id of last inserted row
	 */
	public function last_insert_id() {

		return $this -> conn -> lastInsertId();

	}

	/**
	 * Returns the number of rows. Note that this has the overhead of another SQL query.
	 */
	public function row_count() {

		$conn = $this -> conn;
		$rows = $conn -> query("SELECT FOUND_ROWS()") -> fetchColumn();
		return $rows;

	}

}
