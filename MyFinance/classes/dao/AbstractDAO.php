<?php

require_once("DAOOperations.php");

/**
 * Abstract class for all DAO domain objects.
 * 
 * @author Josivan Silva
 *
 */
abstract class AbstractDAO implements DAOOperations {
	/**
	 * Constant that defines the database type.
	 */
	const DB_TYPE = "mysql";
	/**
	 * Constant that defines the host name.
	 */
	const HOST = "localhost";
	/**
	 * Constant that defines the port number.
	 */
	const PORT = "3306";
	/**
	 * Constant that defines the database user name.
	 */
	const DB_USER = "josivansilva";
	/**
	 * Constant that defines the database user password.
	 */
	const DB_PWD  = "123456";
	/**
	 * Constant that defines the database name.
	 */
	const DB_NAME = "josivansilva";
	
	public function getDbType() {
		return self::DB_TYPE;
	}
	public function getHost() {
		return self::HOST;
	}
	public function getPort() {
		return self::PORT;
	}
	public function getDbUser() {
		return self::DB_USER;
	}
	public function getDbPwd(){
		return self::DB_PWD;
	}
	public function getDbName() {
		return self::DB_NAME;
	}
	
	private function __construct(){}
	
	public function __destruct() {
		$this->disconnect();
		foreach ($this as $key => $value) {
			unset ($this->$key);
        }
	}
	
	public function connect(){
		try {
			$this->connection = new PDO ($this->getDbType().":host=".$this->getHost().";port=".$this->getPort().";dbname=".$this->getDbName(), $this->getDbUser(), $this->getDbPwd());
		} catch (PDOException $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}		
		return ($this->connection);
	}
	
	public function disconnect() {
		$this->connection = null;
	}
	
	public function insertDb ($sql) {
		$connection = $this->connect ();
		try {
			$stmt = $connection->prepare ($sql);
			$stmt->execute ();
			$rs = $connection->lastInsertId() or die (print_r($stmt->errorInfo(), true));			
			//$rs = $connection->lastInsertId();
		} catch (Exception $e) {
			die (print_r($stmt->errorInfo(), true));
		}
		$this->__destruct();
		return $rs;
    }    
    
	public function queryDb ($sql) {
    	$connection = $this->connect();
		try {
			$stmt = $connection->prepare ($sql);
			$stmt->execute ();
			$rowCount = $stmt->rowCount();
		} catch (Exception $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}
		$this->__destruct();
		return $rowCount;
    }
    
	public function selectDb ($sql, $class = null){
		$connection = $this->connect();
		try {
			$stmt = $connection->prepare ($sql);
			$stmt->execute ();
			if (isset ($class)) {
				$rs = $stmt->fetchAll (PDO::FETCH_CLASS, $class);								
			} else {
				$rs = $stmt->fetchAll (PDO::FETCH_OBJ);
			}	
		} catch (Exception $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}		
		$this->__destruct();
		return $rs;
    }
    
    public function rowCount ($sql) {
    	$stmt = NULL;
		$connection = $this->connect();
		try {
			if ($stmt = $connection->query ($sql)) {
				$rowCount = $stmt->fetchColumn();
			} else {
				$rowCount = 0;
			}
		} catch (Exception $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}
		$this->__destruct();
		return $rowCount;
    } 
    
}

?>