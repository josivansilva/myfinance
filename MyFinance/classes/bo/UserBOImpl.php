<?php 
	
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/UserBO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/UserDAOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/util/Pagination.php");

class UserBOImpl implements UserBO {
	/*
	 * static property to hold singleton instance.
	 */
	private static $instance = false;
		
	/**
	 * constructor
	 * private so only getInstance() method can instantiate
	 * @return void
	 */
	private function __construct() {}	
		
	public static function getInstance () {
		if (!UserBOImpl::$instance) {
			UserBOImpl::$instance = new UserBOImpl();
		}
		return UserBOImpl::$instance;
	}
	
	public function insert (UserVO $userVO) {
		$userDAO = UserDAOImpl::getInstance();
		$userVO  = $userDAO->insert ($userVO);
		return $userVO;
	}
		
	public function update (UserVO $userVO) {
		$updatedRows = NULL;
		$userDAO     = UserDAOImpl::getInstance();
		$updatedRows = $userDAO->update ($userVO);
		return $updatedRows;
	}
	
	public function delete (UserVO $userVO) {
		$updatedRows = NULL;
		$userDAO     = UserDAOImpl::getInstance();
		$updatedRows = $userDAO->delete ($userVO);
		return $updatedRows;
	}
	
	public function find (Pagination $pagination) {
		$userDAO = NULL;
		$userDAO = UserDAOImpl::getInstance ();
		return $userDAO->find ($pagination);
	}
	
	public function findRowCount () {
		$rowCount = NULL;
		$userDAO  = UserDAOImpl::getInstance ();
		$rowCount = $userDAO->findRowCount ();
		return $rowCount;
	}
	
	public function findById (UserVO $userVO) {
		$userDAO = NULL;
		$userDAO = UserDAOImpl::getInstance ();
		return $userDAO->findById ($userVO);
	}
	
	public function findByUsername (UserVO $userVO) {
		$userDAO = NULL;
		$userDAO = UserDAOImpl::getInstance ();
		return $userDAO->findByUsername ($userVO);
	}
	
	public function doLogin (UserVO $userVO) {
		$rowCount = NULL;
		$userDAO  = UserDAOImpl::getInstance ();
		$rowCount = $userDAO->doLogin ($userVO);
		return $rowCount;
	}
		
}

?>