<?php

/**
 * Interface that defines the default operations for the database.
 * 
 * @author Josivan Silva
 *
 */
interface DAOOperations {
	
	/**
	 * Connects to the database.
	 */
	public function connect ();
	
	/**
	 * Disconnects from the database.
	 */
	public function disconnect ();
	
	/**
	 * Inserts a new record into the database.
	 *
	 * @param $sql the sql query.
	 * 
	 * @return the last record id inserted. 
	 */
	public function insertDb ($sql);
	
	/**
	 * Returns the number of rows affected by the last SQL statement.
	 * 
	 * @param $sql the sql query.
	 */
	public function queryDb ($sql);
	
	/**
	 * Selects a list of records from the database. 
	 * 
	 * @param $sql the sql query.
	 * @param $class the class used to query the result.
	 */
	public function selectDb ($sql, $class = null);
	
	/**
	 * Returns the number of rows affected by a SELECT statement. 
	 * 
	 * @param $sql the sql query.
	 */
	public function rowCount ($sql);
	
}

?>