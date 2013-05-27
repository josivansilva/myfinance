<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/RevenueTypeBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/ExpenseTypeBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/LaunchBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/LaunchVO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/controller/AbstractController.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/util/Util.php");

/**
 * Launch Controller class.
 * 
 * @author Josivan Silva
 *
 */
class LaunchController extends AbstractController {
	/*
	 * static property to hold singleton instance.
	 */
	private static $instance = false;
	private $launchBO;
	private $revenueTypeBO;
	private $expenseTypeBO;
	private $revenueTotal = 0;
	private $expenseTotal = 0;
	
	public function __construct() {}	
		
	/**
	 * Default singleton.
	 * 
	 * @return void
	 */
	public static function getInstance () {
		if (!LaunchController::$instance) {
			LaunchController::$instance = new LaunchController();
		}
		return LaunchController::$instance;
	}
			
	/**
	 * Finds launches given an specified filter (month and year).
	 * 
	 * @return void
	 */
	public function findLaunchByFilter() {
		$month = $_REQUEST['month'];
		$year  = $_REQUEST['year'];				
		$this->renderRevenueTypeTable ($month, $year);
		$this->renderExpenseTypeTable ($month, $year);
	}	
	
	/**
	 * Inserts or updates a new launch.
	 * 
	 * @return void
	 */
	public function updateLaunch() {		
		$idLaunch           = $_REQUEST['idLaunch'];
		$typeLaunch         = $_REQUEST['typeLaunch'];
		$idRevenueOrExpense = $_REQUEST['idRevenueOrExpense'];
		$nmLaunch           = $_REQUEST['nmLaunch'];
		$vlrLaunch          = $_REQUEST['vlrLaunch'];
		$status             = $_REQUEST['status'];		
		$this->launchBO = LaunchBOImpl::getInstance();
		$launchVO = new LaunchVO();
		$launchVO->setID_LAUNCH ($idLaunch);
		session_start();
		$idUser = $_SESSION['loggedUser']->getID_USER();
		$launchVO->setID_USER ($idUser);
		if ($typeLaunch == "revenueType") {
			$launchVO->setID_REVENUE_TYPE ($idRevenueOrExpense);
		} else if ($typeLaunch == "expenseType") {
			$launchVO->setID_EXPENSE_TYPE ($idRevenueOrExpense);
		}
		$launchVO->setNM_LAUNCH ($nmLaunch);
		$launchVO->setVLR_LAUNCH ($vlrLaunch);
		if ($status == "true") {
			$launchVO->setSTATUS ('P'); // pago
		} else {
			$launchVO->setSTATUS ('N'); // não pago
		}
		if ($idLaunch != NULL && $idLaunch > 0) {
			$rowCount = $this->launchBO->update ($launchVO);
			echo $rowCount;
		} else {
			//0000-00-00 00:00:00
			date_default_timezone_set("America/Sao_Paulo");
			$currentDate = date ('Y/m/d h:i:s a', time());
			$launchVO->setDT_CREATION ($currentDate);
			$launchVO = $this->launchBO->insert ($launchVO);
			echo $launchVO->getID_LAUNCH ();
		}
	}
	
	/**
	 * Loads a launch.
	 * 
	 * @return void
	 */
	public function loadLaunch() {
		$idLaunch = $_REQUEST['id'];
		$launchVO = new LaunchVO();
		$launchVO->setID_LAUNCH ($idLaunch);
		$launchBO = LaunchBOImpl::getInstance();
		$newLaunchVO = $launchBO->findById ($launchVO);
		echo $newLaunchVO->getID_LAUNCH()
			 . "," . $newLaunchVO->getID_REVENUE_TYPE()
			 . "," . $newLaunchVO->getID_EXPENSE_TYPE()
			 . "," . $newLaunchVO->getNM_LAUNCH()
			 . "," . $newLaunchVO->getVLR_LAUNCH()
			 . "," . $newLaunchVO->getSTATUS();
	}	
	
	/**
	 * Deletes a launch.
	 * 
	 * @return void
	 */
	public function deleteLaunch() {
		$idLaunch = $_REQUEST['id'];
		$launchVO = new LaunchVO();
		$launchVO->setID_LAUNCH ($idLaunch);
		$this->launchBO = LaunchBOImpl::getInstance(); 
		$countRows = $this->launchBO->delete ($launchVO);
		echo $countRows;
	}
	
	/**
	 * Renders the revenue type HTML table.
	 * 
	 * @return void
	 */
	public function renderRevenueTypeTable ($month, $year) {
		$this->revenueTypeBO = RevenueTypeBOImpl::getInstance();
		$revenueTypeArr = $this->revenueTypeBO->findAll();
		if (!isset($_SESSION['loggedUser'])){
			session_start();
		}
		echo "<table id=\"launchTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
		echo "	<thead>";
		echo "		<tr>";
		echo "			<td width=\"210px\">receitas</td>";
		echo "			<td width=\"95px\">previstas</td>";
		echo "			<td width=\"65px\">status</td>";
		echo "		</tr>";
		echo "	</thead>";
		foreach ($revenueTypeArr as $key => $revenueType) {
			echo "<tr class=\"tr-sub-header\">";
			echo "	<td width=\"210px\">";
			echo 		$revenueType->getNM_REVENUE_TYPE();
			echo "	</td>";
			echo "	<td width=\"95px\">";
			echo "      ";
			echo "	</td>";
			echo "	<td width=\"65px\">";
			echo "      ";
			echo "	</td>";
			echo "</tr>";			
			$idRevenueType = $revenueType->getID_REVENUE_TYPE();
			$idUser = $_SESSION['loggedUser']->getID_USER();
			$startDate = Util::getStartDate ($month, $year);
			$this->launchBO = LaunchBOImpl::getInstance();
			$launchVO = new LaunchVO();
			$launchVO->setID_REVENUE_TYPE ($idRevenueType);			
			$launchVO->setID_USER ($idUser);
			$launchVO->setDT_CREATION ($startDate);						
			$launchArr = $this->launchBO->findByFilter ($launchVO);			
			foreach ($launchArr as $key => $launch) {				
				echo "<tr onmouseover=\"changeBackgroundColor(this, '#ced2d4');\" onmouseout=\"changeBackgroundColor(this, '#e0e3e5');\" style=\"cursor: pointer;\" >";
				echo "	<td id=" . $launch->getID_LAUNCH() . " width=\"210px\">";
				echo "		<div id=\"container-table-item-label\">" . $launch->getNM_LAUNCH() . "</div>";
				echo "		<div id=\"container-table-item-icon-delete\" title=\"Excluir Registro\">";
				echo "			<a href=\"javascript:remove ('" . $launch->getID_LAUNCH() . "');\">";
				echo "				<img id=\"img-icon-delete\" src=\"resources/images/icon_delete.png\" onmouseover=\"javascript:changeImageSrc(this, 'icon_delete_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'icon_delete.png');\" border=\"0\" />";
				echo "			</a>";
				echo "		</div>";
				echo "	</td>";
				echo "	<td id=" . $launch->getID_LAUNCH() . " width=\"95px\">";
				echo 		$launch->getVLR_LAUNCH();
				echo "	</td>";
				echo "	<td id=" . $launch->getID_LAUNCH() . " class=\"td-status\" width=\"65px\">";
				echo 		$launch->getSTATUS();
				echo "	</td>";
				echo "</tr>";				
				$this->revenueTotal = $this->revenueTotal + $launch->getVLR_LAUNCH();
			}
		}		
		$vlrRevenueTotal = number_format ($this->revenueTotal, 2, '.', '');		
		echo "<tr class=\"tr-total\">";
		echo "	<td width=\"210px\">";
		echo "      Total receitas";
		echo "	</td>";
		echo "	<td width=\"95px\">";		 
		echo 		$vlrRevenueTotal;
		echo "	</td>";
		echo "	<td width=\"65px\">";
		echo "      ";
		echo "	</td>";
		echo "</tr>";
		
		echo "</table>";
	}
	
	/**
	 * Renders the expense type HTML table.
	 * 
	 * @return void
	 */
	public function renderExpenseTypeTable ($month, $year) {
		$this->expenseTypeBO = ExpenseTypeBOImpl::getInstance();
		$expenseTypeArr = $this->expenseTypeBO->findAll();						
		echo "<table id=\"launchTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
		echo "	<thead>";
		echo "		<tr>";
		echo "			<td width=\"210px\">despesas</td>";
		echo "			<td width=\"95px\">previstas</td>";
		echo "			<td width=\"65px\">status</td>";
		echo "		</tr>";
		echo "	</thead>";		
		foreach ($expenseTypeArr as $key => $expenseType) {
			echo "<tr class=\"tr-sub-header\">";
			echo "	<td width=\"210px\">";
			echo 		$expenseType->getNM_EXPENSE_TYPE();
			echo "	</td>";
			echo "	<td width=\"95px\">";
			echo "      ";
			echo "	</td>";
			echo "	<td width=\"65px\">";
			echo "      ";
			echo "	</td>";
			echo "</tr>";			
			$idExpenseType = $expenseType->getID_EXPENSE_TYPE();
			$idUser = $_SESSION['loggedUser']->getID_USER();
			$startDate = Util::getStartDate ($month, $year);
			$this->launchBO = LaunchBOImpl::getInstance();
			$launchVO = new LaunchVO();
			$launchVO->setID_EXPENSE_TYPE ($idExpenseType);			
			$launchVO->setID_USER ($idUser);
			$launchVO->setDT_CREATION ($startDate);
			$launchArr = $this->launchBO->findByFilter ($launchVO);			
			foreach ($launchArr as $key => $launch) {				
				echo "<tr onmouseover=\"changeBackgroundColor(this, '#ced2d4');\" onmouseout=\"changeBackgroundColor(this, '#e0e3e5');\" style=\"cursor: pointer;\" >";
				echo "	<td id=" . $launch->getID_LAUNCH() . " width=\"210px\">";
				echo "		<div id=\"container-table-item-label\">" . $launch->getNM_LAUNCH() . "</div>";
				echo "		<div id=\"container-table-item-icon-delete\" title=\"Excluir Registro\">";
				echo "			<a href=\"javascript:remove ('" . $launch->getID_LAUNCH() . "');\">";
				echo "				<img id=\"img-icon-delete\" src=\"resources/images/icon_delete.png\" onmouseover=\"javascript:changeImageSrc(this, 'icon_delete_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'icon_delete.png');\" border=\"0\" />";
				echo "			</a>";
				echo "		</div>";
				echo "	</td>";
				echo "	<td id=" . $launch->getID_LAUNCH() . " width=\"95px\">";
				echo 		$launch->getVLR_LAUNCH();
				echo "	</td>";
				echo "	<td id=" . $launch->getID_LAUNCH() . " class=\"td-status\" width=\"65px\">";
				echo 		$launch->getSTATUS();
				echo "	</td>";
				echo "</tr>";				
				$this->expenseTotal = $this->expenseTotal + $launch->getVLR_LAUNCH();
			}
		}		
		$vlrExpenseTotal = number_format ($this->expenseTotal, 2, '.', '');
		echo "<tr class=\"tr-total\">";
		echo "	<td width=\"210px\">";
		echo "      Total despesas";
		echo "	</td>";
		echo "	<td width=\"95px\">";		
		echo 		$vlrExpenseTotal;
		echo "	</td>";
		echo "	<td width=\"65px\">";
		echo "      ";
		echo "	</td>";
		echo "</tr>";		
		$total = $this->revenueTotal - $this->expenseTotal;
		$total = number_format ($total, 2, '.', '');
		$statusClassname = NULL;
		if ($total > 0) {
			$statusClassname = "status-positive";	
		} else if ($total < 0) {
			$statusClassname = "status-negative";
		}		
		echo "<tr class=\"tr-total\">";
		echo "	<td width=\"210px\">";
		echo "      Saldo";
		echo "	</td>";
		echo "	<td width=\"95px\" class=\"" . $statusClassname . "\">";
		echo 		$total;
		echo "	</td>";
		echo "	<td width=\"65px\">";
		echo "      ";
		echo "	</td>";
		echo "</tr>";		
		echo "</table>";
	}
	
	/**
	 * Renders the HTML from the select Revenue or Expense.
	 * 
	 * @return void
	 */
	public function renderSelectRevenueOrExpense () {
		$typeLaunch                 = $_REQUEST['typeLaunch'];
		$idRevenueTypeOrExpenseType = $_REQUEST['idSelected'];
		if ($typeLaunch == "revenueType") {
			$this->renderSelectRevenueType ($idRevenueTypeOrExpenseType);
		} else if ($typeLaunch == "expenseType") {
			$this->renderSelectExpenseType ($idRevenueTypeOrExpenseType);
		}
	}
	
	/**
	 * Renders the HTML from the select Revenue Type.
	 * 
	 * @return void
	 */
	private function renderSelectRevenueType ($idRevenueTypeOrExpenseType) {
		$this->revenueTypeBO = RevenueTypeBOImpl::getInstance();
		$arr = $this->revenueTypeBO->findAll ();
		echo "<select id=\"revenueOrExpense\" name=\"revenueOrExpense\">";
		echo "	<option value=\"\">tipos de receita</option>";
		foreach ($arr as $key => $revenueType) {
			if ($idRevenueTypeOrExpenseType == $revenueType->getID_REVENUE_TYPE()) {
				echo "<option value=" . $revenueType->getID_REVENUE_TYPE(). " selected=\"selected\">" . $revenueType->getNM_REVENUE_TYPE(). "</option>";
			} else {
				echo "<option value=" . $revenueType->getID_REVENUE_TYPE(). ">" . $revenueType->getNM_REVENUE_TYPE(). "</option>";
			}
		}
		echo "</select>";
	}
	
	/**
	 * Renders the HTML from the select Expense Type.
	 * 
	 * @return void
	 */
	private function renderSelectExpenseType ($idRevenueTypeOrExpenseType) {
		$this->expenseTypeBO = ExpenseTypeBOImpl::getInstance();
		$arr = $this->expenseTypeBO->findAll ();
		echo "<select id=\"revenueOrExpense\" name=\"revenueOrExpense\">";
		echo "<option value=\"\">tipos de despesa</option>";
		foreach ($arr as $key => $expenseType) {
			if ($idRevenueTypeOrExpenseType == $expenseType->getID_EXPENSE_TYPE()) {
				echo "<option value=" . $expenseType->getID_EXPENSE_TYPE(). " selected=\"selected\">" . $expenseType->getNM_EXPENSE_TYPE(). "</option>";
			} else {
				echo "<option value=" . $expenseType->getID_EXPENSE_TYPE(). ">" . $expenseType->getNM_EXPENSE_TYPE(). "</option>";
			}
		}
		echo "</select>";
	}
	
}

?>