<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/RevenueTypeBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/RevenueTypeVO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/util/Pagination.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/controller/AbstractController.php");

/**
 * Revenue Type Controller class.
 * 
 * @author Josivan Silva
 *
 */
class RevenueTypeController extends AbstractController {
	/*
	 * static property to hold singleton instance.
	 */
	private static $instance = false;
	private $revenueTypeBO;
	
	public function __construct() {}	
		
	/**
	 * Default singleton.
	 * 
	 * @return void
	 */
	public static function getInstance () {
		if (!RevenueTypeController::$instance) {
			RevenueTypeController::$instance = new RevenueTypeController();
		}
		return RevenueTypeController::$instance;
	}
			
	/**
	 * Inserts or updates a new revenue type.
	 * 
	 * @return void
	 */
	public function updateRevenueType() {
		$id            = $_REQUEST['id'];
		$nmRevenueType = $_REQUEST['nmRevenueType'];
		$revenueTypeVO = new RevenueTypeVO();
		$revenueTypeVO->setID_REVENUE_TYPE ($id);
		$revenueTypeVO->setNM_REVENUE_TYPE ($nmRevenueType);
		$revenueTypeBO = RevenueTypeBOImpl::getInstance();
		if ($id != NULL && $id > 0) {
			$rowCount = $revenueTypeBO->update ($revenueTypeVO);
			echo $rowCount;
		} else {
			$newRevenueTypeVO = $revenueTypeBO->insert ($revenueTypeVO);
			echo $newRevenueTypeVO->getID_REVENUE_TYPE ();
		}
	}
	
	/**
	 * Loads a revenue type.
	 * 
	 * @return void
	 */
	public function loadRevenueType() {
		$idRevenueType = $_REQUEST['id'];				
		$revenueTypeVO = new RevenueTypeVO();
		$revenueTypeVO->setID_REVENUE_TYPE ($idRevenueType);
		$revenueTypeBO = RevenueTypeBOImpl::getInstance();
		$newRevenueTypeVO = $revenueTypeBO->findById ($revenueTypeVO);
		echo $newRevenueTypeVO->getID_REVENUE_TYPE () 
			 . "," . $newRevenueTypeVO->getNM_REVENUE_TYPE();
	}
	
	/**
	 * Deletes a revenue type.
	 * 
	 * @return void
	 */
	public function deleteRevenueType() {
		$idRevenueType = $_REQUEST['id'];
		$revenueTypeVO = new RevenueTypeVO();
		$revenueTypeVO->setID_REVENUE_TYPE ($idRevenueType);
		$revenueTypeBO = RevenueTypeBOImpl::getInstance();
		$countRows = $revenueTypeBO->delete ($revenueTypeVO);
		echo $countRows;
	}
	
	/**
	 * Renders the user HTML table.
	 * 
	 * @return void
	 */
	public function renderTable() {
		$arr = $this->find();
		echo "<table id=\"revenueTypeTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
		echo "	<thead>";
		echo "		<tr>";
		echo "			<td>id</td>";
		echo "			<td>nome tipo de receita</td>";
		echo "		</tr>";
		echo "	</thead>";
		foreach ($arr as $key => $revenueType) {
			echo "<tr onmouseover=\"changeBackgroundColor(this, '#ced2d4');\" onmouseout=\"changeBackgroundColor(this, '#e0e3e5');\" style=\"cursor: pointer;\">";
			echo "	<td id=" . $revenueType->getID_REVENUE_TYPE() . ">";
			echo "		<div id=\"container-table-item-label\">" . $revenueType->getID_REVENUE_TYPE() . "</div>";
			echo "		<div id=\"container-table-item-icon-delete\" title=\"Excluir Registro\">";
			echo "			<a href=\"javascript:remove ('" . $revenueType->getID_REVENUE_TYPE() . "');\">";
			echo "				<img id=\"img-icon-delete\" src=\"resources/images/icon_delete.png\" onmouseover=\"javascript:changeImageSrc(this, 'icon_delete_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'icon_delete.png');\" border=\"0\" />";
			echo "			</a>";
			echo "		</div>";
			echo "	</td>";
			echo "	<td id=" . $revenueType->getID_REVENUE_TYPE() . ">";
			echo 		$revenueType->getNM_REVENUE_TYPE();
			echo "	</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	/**
	 * Finds all the revenue types.
	 * 
	 * @return $arr array of revenue types.
	 */
	private function find () {		
		$revenueTypeBO = RevenueTypeBOImpl::getInstance();
		$this->configPagination ();
		$pagination = $_REQUEST['pagination'];		
		$arr = $revenueTypeBO->find ($pagination);
		return $arr;
	}
	
	/**
	 * Configures the pagination.
	 * 
	 * @return void
	 */
	private function configPagination () {
		$revenueTypeBO = RevenueTypeBOImpl::getInstance();
		$pageNumber = $_REQUEST['pageNumber'];
		if (!isset($_REQUEST['pagination'])) {
			$rows = $revenueTypeBO->findRowCount ();
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