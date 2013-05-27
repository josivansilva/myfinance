<?php

require_once ("LaunchDAO.php");
require_once ("AbstractDAO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/util/Util.php");

class LaunchDAOImpl extends AbstractDAO implements LaunchDAO {
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
		if (!LaunchDAOImpl::$instance) {
			LaunchDAOImpl::$instance = new LaunchDAOImpl();
		}
		return LaunchDAOImpl::$instance;
	}
	
	public function insert (LaunchVO $launchVO) {
		$idRevenueType = 0;
		$idExpenseType = 0;
		if ($launchVO->getID_REVENUE_TYPE() > 0) {
			$idRevenueType = $launchVO->getID_REVENUE_TYPE();
		} else if ($launchVO->getID_EXPENSE_TYPE() > 0) {
			$idExpenseType = $launchVO->getID_EXPENSE_TYPE();
		}
		$sql = "INSERT INTO LAUNCH (ID_USER, ID_REVENUE_TYPE, ID_EXPENSE_TYPE, NM_LAUNCH, VLR_LAUNCH, STATUS, DT_CREATION) 
				VALUES ("
						.$launchVO->getID_USER().","
						.$idRevenueType.","
						.$idExpenseType.",'"
						.$launchVO->getNM_LAUNCH()."',"
						.$launchVO->getVLR_LAUNCH().",'"
						.$launchVO->getSTATUS()."','"
						.$launchVO->getDT_CREATION()."')";
		$launchId = $this->insertDb ($sql);
		$launchVO->setID_LAUNCH ($launchId);
		return $launchVO;
    }
    
	public function update (LaunchVO $launchVO) {
		$idRevenueType = 0;
		$idExpenseType = 0;
		if ($launchVO->getID_REVENUE_TYPE() > 0) {
			$idRevenueType = $launchVO->getID_REVENUE_TYPE();
		} else if ($launchVO->getID_EXPENSE_TYPE() > 0) {
			$idExpenseType = $launchVO->getID_EXPENSE_TYPE();
		}
		if ($launchVO->getSTATUS() == "PAGO") {
			$status = "P";	
		} else {
			$status = "N";
		}		
		$sql = "UPDATE LAUNCH " 
			   	."SET ID_USER     = ".$launchVO->getID_USER().", "
			   	."ID_REVENUE_TYPE = ".$idRevenueType.", "
			   	."ID_EXPENSE_TYPE = ".$idExpenseType.", "
			   	."NM_LAUNCH       = '".$launchVO->getNM_LAUNCH()."', "
			   	."VLR_LAUNCH      = '".$launchVO->getVLR_LAUNCH()."', "
			   	."STATUS          = '".$status."' "
			   	."WHERE ID_LAUNCH = ".$launchVO->getID_LAUNCH();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }    
    
	public function delete (LaunchVO $launchVO) {
		$sql = "DELETE FROM LAUNCH WHERE ID_LAUNCH = ".$launchVO->getID_LAUNCH();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }
    
    public function findById (LaunchVO $launchVO) {
    	$sql = "SELECT ID_LAUNCH, ID_USER, ID_REVENUE_TYPE, ID_EXPENSE_TYPE, NM_LAUNCH, VLR_LAUNCH, STATUS, DT_CREATION FROM LAUNCH WHERE ID_LAUNCH = " . $launchVO->getID_LAUNCH();
    	$arr = $this->selectDB ($sql, 'LaunchVO');
		$newLaunchVO = $arr[0];
		return $newLaunchVO;
    }

	public function find (Pagination $pagination) {
		$sql = "SELECT ID_LAUNCH, ID_USER, ID_REVENUE_TYPE, ID_EXPENSE_TYPE, NM_LAUNCH, VLR_LAUNCH, STATUS, DT_CREATION FROM LAUNCH ORDER BY ID_LAUNCH LIMIT " . $pagination->getLIMIT();
		return $this->selectDB ($sql, 'LaunchVO');
	}
	
	public function findByFilter (LaunchVO $launchVO) {
		$whereClause = NULL;
		$startDate   = NULL; 
		$endDate     = NULL;		 
		$startDate = $launchVO->getDT_CREATION();
		$endDate   = Util::getEndDate ($startDate);		
		$whereClause = " WHERE ID_USER = " . $launchVO->getID_USER();		
		if ($launchVO->getID_REVENUE_TYPE() > 0) {
			$whereClause .= " AND ID_REVENUE_TYPE = " . $launchVO->getID_REVENUE_TYPE() . " ";
		} else if ($launchVO->getID_EXPENSE_TYPE () > 0) {
			$whereClause .= " AND ID_EXPENSE_TYPE = " . $launchVO->getID_EXPENSE_TYPE() . " ";
		}		
		$whereClause .= "AND DT_CREATION >= '" . $startDate . "' AND DT_CREATION < '" . $endDate . "' ";		
		$sql = "SELECT ID_LAUNCH, " 
			   . "ID_USER, "
			   . "ID_REVENUE_TYPE," 
			   . "ID_EXPENSE_TYPE, "
			   . "NM_LAUNCH, "
			   . "VLR_LAUNCH," 
			   . "STATUS, "
			   . "DT_CREATION " 
			   . "FROM LAUNCH "
			   . $whereClause 
			   . "ORDER BY ID_LAUNCH";
		return $this->selectDB ($sql, 'LaunchVO');
	}
	
	public function findRowCount () {
		$sql = "SELECT COUNT(*) FROM LAUNCH";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
    
}

?>