<?php

require_once ("ExpenseTypeDAO.php");
require_once ("AbstractDAO.php");

class ExpenseTypeDAOImpl extends AbstractDAO implements ExpenseTypeDAO {
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
		if (!ExpenseTypeDAOImpl::$instance) {
			ExpenseTypeDAOImpl::$instance = new ExpenseTypeDAOImpl();
		}
		return ExpenseTypeDAOImpl::$instance;
	}
	
	public function insert (ExpenseTypeVO $expenseTypeVO) {
		$sql = "INSERT INTO EXPENSE_TYPE (NM_EXPENSE_TYPE) 
				VALUES ('".$expenseTypeVO->getNM_EXPENSE_TYPE()."')";
		$expenseTypeId = $this->insertDb ($sql);
		$expenseTypeVO->setID_EXPENSE_TYPE ($expenseTypeId);
		return $expenseTypeVO;
    }
    
	public function update (ExpenseTypeVO $expenseTypeVO) {
		$sql = "UPDATE EXPENSE_TYPE SET NM_EXPENSE_TYPE='".$expenseTypeVO->getNM_EXPENSE_TYPE()."' WHERE ID_EXPENSE_TYPE = ".$expenseTypeVO->getID_EXPENSE_TYPE();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }    
    
	public function delete (ExpenseTypeVO $expenseTypeVO) {
		$sql = "DELETE FROM EXPENSE_TYPE WHERE ID_EXPENSE_TYPE = ".$expenseTypeVO->getID_EXPENSE_TYPE();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }

    public function find (Pagination $pagination) {
		$sql = "SELECT ID_EXPENSE_TYPE, NM_EXPENSE_TYPE FROM EXPENSE_TYPE ORDER BY ID_EXPENSE_TYPE LIMIT " . $pagination->getLIMIT();
		return $this->selectDB ($sql, 'ExpenseTypeVO');
	}
	
	public function findByLaunch (LaunchVO $launchVO) {
		$sql = "SELECT ID_LAUNCH, ID_USER, ID_REVENUE_TYPE, ID_EXPENSE_TYPE, NM_LAUNCH, VLR_LAUNCH, STATUS, DT_CREATION FROM LAUNCH WHERE ID_EXPENSE_TYPE = ".$launchVO->getID_EXPENSE_TYPE();
		echo $sql . "\n";
		return $this->selectDB ($sql, 'LaunchVO');
	}
	
	public function findAll () {
		$sql = "SELECT ID_EXPENSE_TYPE, NM_EXPENSE_TYPE FROM EXPENSE_TYPE ORDER BY ID_EXPENSE_TYPE";
		return $this->selectDB ($sql, 'ExpenseTypeVO');
	}
	
	public function findRowCount () {
		$sql = "SELECT COUNT(*) FROM EXPENSE_TYPE";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
	
	public function findById (ExpenseTypeVO $expenseTypeVO) {
		$sql = "SELECT ID_EXPENSE_TYPE, NM_EXPENSE_TYPE FROM EXPENSE_TYPE WHERE ID_EXPENSE_TYPE = ".$expenseTypeVO->getID_EXPENSE_TYPE();
		$arr = $this->selectDB ($sql, 'ExpenseTypeVO');
		$newExpenseTypeVO = $arr[0];
		return $newExpenseTypeVO;
	}
    
}

?>