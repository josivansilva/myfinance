<?php 
	
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/ExpenseTypeBO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/ExpenseTypeDAOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/LaunchDAOImpl.php");

class ExpenseTypeBOImpl implements ExpenseTypeBO {
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
		if (!ExpenseTypeBOImpl::$instance) {
			ExpenseTypeBOImpl::$instance = new ExpenseTypeBOImpl();
		}
		return ExpenseTypeBOImpl::$instance;
	}
	
	public function insert (ExpenseTypeVO $expenseTypeVO) {
		$expenseTypeDAO = NULL;
		$expenseTypeDAO = ExpenseTypeDAOImpl::getInstance();
		$expenseTypeVO  = $expenseTypeDAO->insert ($expenseTypeVO);
		return $expenseTypeVO;
	}
		
	public function update (ExpenseTypeVO $expenseTypeVO) {
		$updatedRows    = NULL;
		$expenseTypeDAO = NULL;
		$expenseTypeDAO = ExpenseTypeDAOImpl::getInstance();
		$updatedRows    = $expenseTypeDAO->update ($expenseTypeVO);
		return $updatedRows;
	}
	
	public function delete (ExpenseTypeVO $expenseTypeVO) {
		$updatedRows    = NULL;
		$expenseTypeDAO = NULL;
		$launchDAO      = NULL;
		$expenseTypeDAO = ExpenseTypeDAOImpl::getInstance();
		$launchDAO      = LaunchDAOImpl::getInstance();
		// locating the launches associated to the expense type
		// in order to delete them
		$idExpenseType = $expenseTypeVO->getID_EXPENSE_TYPE();
		$launchVO = new LaunchVO();
		$launchVO->setID_EXPENSE_TYPE ($idExpenseType);
		$launchVOArr = $expenseTypeDAO->findByLaunch ($launchVO);
		foreach ($launchVOArr as $launchVO) {
			$launchDAO->delete ($launchVO);
		}
		$updatedRows = $expenseTypeDAO->delete ($expenseTypeVO);
		return $updatedRows;
	}
	
	public function find (Pagination $pagination) {
		$expenseTypeDAO = NULL;
		$expenseTypeDAO = ExpenseTypeDAOImpl::getInstance ();
		return $expenseTypeDAO->find ($pagination);
	}
	
	public function findAll () {
		$expenseTypeDAO = NULL;
		$expenseTypeDAO = ExpenseTypeDAOImpl::getInstance ();
		return $expenseTypeDAO->findAll ();
	}
	
	public function findRowCount () {
		$rowCount = NULL;
		$expenseTypeDAO = ExpenseTypeDAOImpl::getInstance ();
		$rowCount = $expenseTypeDAO->findRowCount ();
		return $rowCount;
	}
	
	public function findById (ExpenseTypeVO $expenseTypeVO) {
		$expenseTypeDAO = NULL;
		$expenseTypeDAO = ExpenseTypeDAOImpl::getInstance ();
		return $expenseTypeDAO->findById ($expenseTypeVO);
	}
		
}

?>