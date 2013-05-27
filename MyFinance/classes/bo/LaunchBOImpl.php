<?php 
	
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/LaunchBO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/RevenueTypeDAOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/ExpenseTypeDAOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/LaunchDAOImpl.php");

class LaunchBOImpl implements LaunchBO {
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
		if (!LaunchBOImpl::$instance) {
			LaunchBOImpl::$instance = new LaunchBOImpl();
		}
		return LaunchBOImpl::$instance;
	}
	
	public function insert (LaunchVO $launchVO) {
		$launchDAO = LaunchDAOImpl::getInstance();
		$launchVO  = $launchDAO->insert ($launchVO);
		return $launchVO;
	}
		
	public function update (LaunchVO $launchVO) {
		$updatedRows = NULL;
		$launchDAO   = LaunchDAOImpl::getInstance();
		$updatedRows = $launchDAO->update ($launchVO);
		return $updatedRows;
	}
	
	public function delete (LaunchVO $launchVO) {
		$updatedRows = NULL;
		$launchDAO   = LaunchDAOImpl::getInstance();
		$updatedRows = $launchDAO->delete ($launchVO);
		return $updatedRows;
	}
	
	public function find (Pagination $pagination) {
		$launchDAO = NULL;
		$launchDAO = LaunchDAOImpl::getInstance ();
		return $launchDAO->find ($pagination);
	}
	
	public function findByFilter (LaunchVO $launchVO) {
		$launchDAO = NULL;
		$launchDAO = LaunchDAOImpl::getInstance ();
		return $launchDAO->findByFilter ($launchVO);
	}
	
	public function findRowCount () {
		$rowCount = NULL;
		$launchDAO = LaunchDAOImpl::getInstance ();
		$rowCount = $launchDAO->findRowCount ();
		return $rowCount;
	}
	
	public function findById (LaunchVO $launchVO) {
		$launchDAO = NULL;
		$launchDAO = LaunchDAOImpl::getInstance ();
		return $launchDAO->findById ($launchVO);
	}
		
}

?>