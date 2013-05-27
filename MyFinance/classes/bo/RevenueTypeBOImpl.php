<?php 
	
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/RevenueTypeBO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/RevenueTypeDAOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/LaunchDAOImpl.php");

class RevenueTypeBOImpl implements RevenueTypeBO {
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
		if (!RevenueTypeBOImpl::$instance) {
			RevenueTypeBOImpl::$instance = new RevenueTypeBOImpl();
		}
		return RevenueTypeBOImpl::$instance;
	}
	
	public function insert (RevenueTypeVO $revenueTypeVO) {
		$revenueTypeDAO = NULL;
		$revenueTypeDAO = RevenueTypeDAOImpl::getInstance();
		$revenueTypeVO  = $revenueTypeDAO->insert ($revenueTypeVO);
		return $revenueTypeVO;
	}
		
	public function update (RevenueTypeVO $revenueTypeVO) {
		$updatedRows    = NULL;
		$revenueTypeDAO = NULL;
		$revenueTypeDAO = RevenueTypeDAOImpl::getInstance();
		$updatedRows    = $revenueTypeDAO->update ($revenueTypeVO);
		return $updatedRows;
	}
	
	public function delete (RevenueTypeVO $revenueTypeVO) {
		$updatedRows    = NULL;
		$revenueTypeDAO = NULL;
		$launchDAO      = NULL;
		$revenueTypeDAO = RevenueTypeDAOImpl::getInstance();
		$launchDAO      = LaunchDAOImpl::getInstance();
		// locating the launches associated to the revenue type
		// in order to delete them
		$idRevenueType = $revenueTypeVO->getID_REVENUE_TYPE();
		$launchVO = new LaunchVO();
		$launchVO->setID_REVENUE_TYPE ($idRevenueType);
		$launchVOArr = $revenueTypeDAO->findByLaunch ($launchVO);
		foreach ($launchVOArr as $launchVO) {
			$launchDAO->delete ($launchVO);
		}
		$updatedRows = $revenueTypeDAO->delete ($revenueTypeVO);
		return $updatedRows;
	}
	
	public function find (Pagination $pagination) {
		$revenueTypeDAO = NULL;
		$revenueTypeDAO = RevenueTypeDAOImpl::getInstance ();
		return $revenueTypeDAO->find ($pagination);
	}
	
	public function findAll () {
		$revenueTypeDAO = NULL;
		$revenueTypeDAO = RevenueTypeDAOImpl::getInstance ();
		return $revenueTypeDAO->findAll ();
	}
	
	public function findRowCount () {
		$rowCount = NULL;
		$revenueTypeDAO = RevenueTypeDAOImpl::getInstance ();
		$rowCount = $revenueTypeDAO->findRowCount ();
		return $rowCount;
	}
	
	public function findById (RevenueTypeVO $revenueTypeVO) {
		$revenueTypeDAO = NULL;
		$revenueTypeDAO = RevenueTypeDAOImpl::getInstance ();
		return $revenueTypeDAO->findById ($revenueTypeVO);
	}	
		
}

?>