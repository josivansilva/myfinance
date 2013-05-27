<?php

require_once ("RevenueTypeDAO.php");
require_once ("AbstractDAO.php");

class RevenueTypeDAOImpl extends AbstractDAO implements RevenueTypeDAO {
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
		if (!RevenueTypeDAOImpl::$instance) {
			RevenueTypeDAOImpl::$instance = new RevenueTypeDAOImpl();
		}
		return RevenueTypeDAOImpl::$instance;
	}
	
	public function insert (RevenueTypeVO $revenueTypeVO) {
		$sql = "INSERT INTO REVENUE_TYPE (NM_REVENUE_TYPE) 
				VALUES ('".$revenueTypeVO->getNM_REVENUE_TYPE()."')";
		$revenueTypeId = $this->insertDb ($sql);
		$revenueTypeVO->setID_REVENUE_TYPE ($revenueTypeId);
		return $revenueTypeVO;
    }
    
	public function update (RevenueTypeVO $revenueTypeVO) {
		$sql = "UPDATE REVENUE_TYPE SET NM_REVENUE_TYPE='".$revenueTypeVO->getNM_REVENUE_TYPE()."' WHERE ID_REVENUE_TYPE = ".$revenueTypeVO->getID_REVENUE_TYPE();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }    
    
	public function delete (RevenueTypeVO $revenueTypeVO) {
		$sql = "DELETE FROM REVENUE_TYPE WHERE ID_REVENUE_TYPE = ".$revenueTypeVO->getID_REVENUE_TYPE();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }

	public function find (Pagination $pagination) {
		$sql = "SELECT ID_REVENUE_TYPE, NM_REVENUE_TYPE FROM REVENUE_TYPE ORDER BY ID_REVENUE_TYPE LIMIT " . $pagination->getLIMIT();
		return $this->selectDB ($sql, 'RevenueTypeVO');
	}
	
	public function findByLaunch (LaunchVO $launchVO) {
		$sql = "SELECT ID_LAUNCH, ID_USER, ID_REVENUE_TYPE, ID_EXPENSE_TYPE, NM_LAUNCH, VLR_LAUNCH, STATUS, DT_CREATION FROM LAUNCH WHERE ID_REVENUE_TYPE = " . $launchVO->getID_REVENUE_TYPE();
		return $this->selectDB ($sql, 'LaunchVO');
	}
	
	public function findAll () {
		$sql = "SELECT ID_REVENUE_TYPE, NM_REVENUE_TYPE FROM REVENUE_TYPE ORDER BY ID_REVENUE_TYPE";
		return $this->selectDB ($sql, 'RevenueTypeVO');
	}
	
	public function findRowCount () {
		$sql = "SELECT COUNT(*) FROM REVENUE_TYPE";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
	
	public function findById (RevenueTypeVO $revenueTypeVO) {
		$sql = "SELECT ID_REVENUE_TYPE, NM_REVENUE_TYPE FROM REVENUE_TYPE WHERE ID_REVENUE_TYPE = " . $revenueTypeVO->getID_REVENUE_TYPE();
		$arr = $this->selectDB ($sql, 'RevenueTypeVO');
		$newRevenueType = $arr[0];
		return $newRevenueType;
	}
    
}

?>