<?php

require_once ("UserDAO.php");
require_once ("AbstractDAO.php");

class UserDAOImpl extends AbstractDAO implements UserDAO {
	/*
	 * static property do hold singleton instance.
	 */
	private static $instance = false;
	
	/**
	 * constructor
	 * private so only getInstance() method can instantiate
	 * @return void
	 */
	private function __construct() {}
		
	public static function getInstance () {
		if (!UserDAOImpl::$instance) {
			UserDAOImpl::$instance = new UserDAOImpl();
		}
		return UserDAOImpl::$instance;
	}
	
	public function insert (UserVO $userVO) {
		$sql = "INSERT INTO USER (USERNAME, PWD, EMAIL, ROLE_ADMIN) 
				VALUES ('".$userVO->getUSERNAME()."',MD5('".$userVO->getPWD()."'),'".$userVO->getEMAIL()."',".$userVO->getROLE_ADMIN().")";
		$userId = $this->insertDb ($sql);
		$userVO->setID_USER ($userId);
		return $userVO;
    }
    
    
	public function update (UserVO $userVO) {
		$sql = "UPDATE USER SET USERNAME='".$userVO->getUSERNAME()."',PWD=MD5('".$userVO->getPWD()."'),EMAIL='".$userVO->getEMAIL()."',ROLE_ADMIN=".$userVO->getROLE_ADMIN()." WHERE ID_USER = ".$userVO->getID_USER();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }    
    
	public function delete (UserVO $userVO) {
		$sql = "DELETE FROM USER WHERE ID_USER = ".$userVO->getID_USER();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }

	public function find (Pagination $pagination) {
		$sql = "SELECT ID_USER, USERNAME, EMAIL, ROLE_ADMIN FROM USER ORDER BY ID_USER LIMIT " . $pagination->getLIMIT();			
		return $this->selectDB ($sql, 'UserVO');
	}
	
	public function findRowCount () {
		$sql = "SELECT COUNT(*) FROM USER";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
	
	public function findById (UserVO $userVO) {
		$sql = "SELECT ID_USER, USERNAME, EMAIL, ROLE_ADMIN FROM USER WHERE ID_USER = ".$userVO->getID_USER();
		$arr = $this->selectDB ($sql, 'UserVO');
		$newUser = $arr[0]; 
		return $newUser;
	}
	
	public function findByUsername (UserVO $userVO) {
		$sql = "SELECT ID_USER, USERNAME, EMAIL, ROLE_ADMIN FROM USER WHERE USERNAME = '".$userVO->getUSERNAME()."'";
		$arr = $this->selectDB ($sql, 'UserVO');
		$newUser = $arr[0]; 
		return $newUser;
	}
	
	public function doLogin (UserVO $userVO) {
		$sql = "SELECT COUNT(*) FROM USER WHERE USERNAME = '". $userVO->getUSERNAME() ."' AND PWD = MD5('". $userVO->getPWD() ."')";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
    
}

?>