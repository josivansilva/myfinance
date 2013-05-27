<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/ExpenseTypeBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/ExpenseTypeVO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/util/Pagination.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/controller/AbstractController.php");

/**
 * Expense Type Controller class.
 * 
 * @author Josivan Silva
 *
 */
class ExpenseTypeController extends AbstractController {
	/*
	 * static property to hold singleton instance.
	 */
	private static $instance = false;
	private $expenseTypeBO;
	
	public function __construct() {}	
		
	/**
	 * Default singleton.
	 * 
	 * @return void
	 */
	public static function getInstance () {
		if (!ExpenseTypeController::$instance) {
			ExpenseTypeController::$instance = new ExpenseTypeController();
		}
		return ExpenseTypeController::$instance;
	}
			
	/**
	 * Inserts or updates a new expense type.
	 * 
	 * @return void
	 */
	public function updateExpenseType() {
		$id            = $_REQUEST['id'];
		$nmExpenseType = $_REQUEST['nmExpenseType'];
		$expenseTypeVO = new ExpenseTypeVO();
		$expenseTypeVO->setID_EXPENSE_TYPE ($id);
		$expenseTypeVO->setNM_EXPENSE_TYPE ($nmExpenseType);
		$expenseTypeBO = ExpenseTypeBOImpl::getInstance();
		if ($id != NULL && $id > 0) {
			$rowCount = $expenseTypeBO->update ($expenseTypeVO);
			echo $rowCount;
		} else {
			$newExpenseTypeVO = $expenseTypeBO->insert ($expenseTypeVO);
			echo $newExpenseTypeVO->getID_EXPENSE_TYPE ();
		}
	}
	
	/**
	 * Loads an expense type.
	 * 
	 * @return void
	 */
	public function loadExpenseType() {
		$idExpenseType = $_REQUEST['id'];				
		$expenseTypeVO = new ExpenseTypeVO();
		$expenseTypeVO->setID_EXPENSE_TYPE ($idExpenseType);
		$expenseTypeBO = ExpenseTypeBOImpl::getInstance();
		$newExpenseTypeVO = $expenseTypeBO->findById ($expenseTypeVO);
		echo $newExpenseTypeVO->getID_EXPENSE_TYPE () 
			 . "," . $newExpenseTypeVO->getNM_EXPENSE_TYPE();
	}
	
	/**
	 * Deletes an expense type.
	 * 
	 * @return void
	 */
	public function deleteExpenseType() {
		$idExpenseType = $_REQUEST['id'];
		$expenseTypeVO = new ExpenseTypeVO();
		$expenseTypeVO->setID_EXPENSE_TYPE ($idExpenseType);
		$expenseTypeBO = ExpenseTypeBOImpl::getInstance();
		$countRows = $expenseTypeBO->delete ($expenseTypeVO);
		echo $countRows;
	}
	
	/**
	 * Renders the user HTML table.
	 * 
	 * @return void
	 */
	public function renderTable() {
		$arr = $this->find();
		echo "<table id=\"expenseTypeTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
		echo "	<thead>";
		echo "		<tr>";
		echo "			<td>id</td>";
		echo "			<td>nome tipo de despesa</td>";
		echo "		</tr>";
		echo "	</thead>";
		foreach ($arr as $key => $expenseType) {
			echo "<tr onmouseover=\"changeBackgroundColor(this, '#ced2d4');\" onmouseout=\"changeBackgroundColor(this, '#e0e3e5');\" style=\"cursor: pointer;\">";
			echo "	<td id=" . $expenseType->getID_EXPENSE_TYPE() . ">";
			echo "		<div id=\"container-table-item-label\">" . $expenseType->getID_EXPENSE_TYPE() . "</div>";
			echo "		<div id=\"container-table-item-icon-delete\" title=\"Excluir Registro\">";
			echo "			<a href=\"javascript:remove ('" . $expenseType->getID_EXPENSE_TYPE() . "');\">";
			echo "				<img id=\"img-icon-delete\" src=\"resources/images/icon_delete.png\" onmouseover=\"javascript:changeImageSrc(this, 'icon_delete_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'icon_delete.png');\" border=\"0\" />";
			echo "			</a>";
			echo "		</div>";
			echo "	</td>";
			echo "	<td id=" . $expenseType->getID_EXPENSE_TYPE() . ">";
			echo 		$expenseType->getNM_EXPENSE_TYPE();
			echo "	</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	/**
	 * Finds all the expense types.
	 * 
	 * @return $arr array of expense types.
	 */
	private function find () {		
		$expenseTypeBO = ExpenseTypeBOImpl::getInstance();
		$this->configPagination ();
		$pagination = $_REQUEST['pagination'];		
		$arr = $expenseTypeBO->find ($pagination);
		return $arr;
	}
	
	/**
	 * Configures the pagination.
	 * 
	 * @return void
	 */
	private function configPagination () {
		$expenseTypeBO = ExpenseTypeBOImpl::getInstance();
		$pageNumber = $_REQUEST['pageNumber'];
		if (!isset($_REQUEST['pagination'])) {
			$rows = $expenseTypeBO->findRowCount ();
			$pageRows = 8;
			$pagination = new Pagination();
			$pagination->setROWS ($rows);
			$pagination->setPAGE_ROWS ($pageRows);
			$_REQUEST['pagination'] = $pagination;
		}
		$_REQUEST['pagination']->setPAGE_NUM ($pageNumber);
	}
	
	/**
	 * Renders the pagination.
	 * 
	 * @return void
	 */
	public function renderPagination () {		
		$this->configPagination ();
		$pagination = $_REQUEST['pagination'];
		$this->renderTableNavigation ($pagination);
	}
		
}

?>