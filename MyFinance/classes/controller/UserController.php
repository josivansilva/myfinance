<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/UserBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/UserVO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/util/Pagination.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/controller/AbstractController.php");

/**
 * User Controller class.
 * 
 * @author Josivan Silva
 *
 */
class UserController extends AbstractController {
	/*
	 * static property to hold singleton instance.
	 */
	private static $instance = false;
	private $userBO;
	
	public function __construct() {}	
		
	/**
	 * Default singleton.
	 * 
	 * @return void
	 */
	public static function getInstance () {
		if (!UserController::$instance) {
			UserController::$instance = new UserController();
		}
		return UserController::$instance;
	}
			
	/**
	 * Performs the form user login.
	 * 
	 * @return void
	 */
	public function doLogin () {
		$username = NULL;
		$pwd      = NULL;
		$isLogged = 0;		
		$username = $_REQUEST['username'];
		$pwd      =	$_REQUEST['pwd'];		
		$userVO = new UserVO();
		$userVO->setUSERNAME ($username);
		$userVO->setPWD ($pwd);		
		$userBO = UserBOImpl::getInstance();		
		$isLogged = $userBO->doLogin ($userVO);		
		$isLogged = intval ($isLogged);		
		if ($isLogged == 1) {
			$loggedUser = $userBO->findByUsername ($userVO);
			session_start();
			$_SESSION['loggedUser'] = $loggedUser;
		}
		echo $isLogged;
	}
	
	/**
	 * Inserts or updates a new user.
	 * 
	 * @return void
	 */
	public function updateUser() {
		$id        = $_REQUEST['id'];
		$username  = $_REQUEST['username'];
		$pwd       = $_REQUEST['pwd'];
		$email     = $_REQUEST['email'];
		$roleAdmin = $_REQUEST['roleAdmin'];		
		$userVO = new UserVO();
		$userVO->setID_USER ($id);
		$userVO->setUSERNAME ($username);
		$userVO->setPWD ($pwd);
		$userVO->setEMAIL ($email);
		$userVO->setROLE_ADMIN ($roleAdmin);		
		$userBO = UserBOImpl::getInstance();
		if ($id != NULL && $id > 0) {
			$rowCount = $userBO->update ($userVO);
			echo $rowCount;
		} else {
			$newUserVO = $userBO->insert ($userVO);
			echo $newUserVO->getID_USER ();
		}
	}
	
	/**
	 * Loads an user.
	 * 
	 * @return void
	 */
	public function loadUser() {
		$idUser = $_REQUEST['id'];				
		$userVO = new UserVO();
		$userVO->setID_USER ($idUser);				
		$userBO = UserBOImpl::getInstance();		
		$newUserVO = $userBO->findById ($userVO);		
		echo $newUserVO->getID_USER () 
			 . "," . $newUserVO->getUSERNAME ()
			 . "," . $newUserVO->getEMAIL ()
			 . "," . $newUserVO->getROLE_ADMIN();
	}
	
	/**
	 * Deletes an user.
	 * 
	 * @return void
	 */
	public function deleteUser() {
		$idUser = $_REQUEST['id'];				
		$userVO = new UserVO();
		$userVO->setID_USER ($idUser);				
		$userBO = UserBOImpl::getInstance();		
		$countRows = $userBO->delete ($userVO);		
		echo $countRows;
	}
	
	/**
	 * Renders the user HTML table.
	 * 
	 * @return void
	 */
	public function renderTable() {
		$arr = $this->find();
		echo "<table id=\"userTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
		echo "	<thead>";
		echo "		<tr>";
		echo "			<td>nome do usu&aacute;rio</td>";
		echo "			<td>admin</td>";
		echo "			<td>email</td>";
		echo "		</tr>";
		echo "	</thead>";
		foreach ($arr as $key => $user) {
			echo "<tr onmouseover=\"changeBackgroundColor(this, '#ced2d4');\" onmouseout=\"changeBackgroundColor(this, '#e0e3e5');\" style=\"cursor: pointer;\">";
			echo "	<td id=" . $user->getID_USER() . ">";
			echo "		<div id=\"container-table-item-label\">" . $user->getUSERNAME() . "</div>";
			echo "		<div id=\"container-table-item-icon-delete\" title=\"Excluir Registro\">";
			echo "			<a href=\"javascript:remove ('" . $user->getID_USER() . "');\">";
			echo "				<img id=\"img-icon-delete\" src=\"resources/images/icon_delete.png\" onmouseover=\"javascript:changeImageSrc(this, 'icon_delete_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'icon_delete.png');\" border=\"0\" />";
			echo "			</a>";
			echo "		</div>";
			echo "	</td>";
			echo "	<td id=" . $user->getID_USER() . ">";
			echo "		<div id=\"container-table-item-icon-admin\" title=\"Usu&aacute;rio Administrador\">";
			if ($user->getROLE_ADMIN() == "1") {		
				echo "			<a href=\"#\">";
				echo "				<img id=\"img-icon-admin\" src=\"resources/images/icon_admin.png\" onmouseover=\"javascript:changeImageSrc(this, 'icon_admin_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'icon_admin.png');\" border=\"0\" />";
				echo "			</a>";
			}
			echo "		</div>";
			echo "	</td>";
			echo "	<td id=" . $user->getID_USER() . ">";
			echo 		$user->getEMAIL();
			echo "	</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	/**
	 * Finds all the users.
	 * 
	 * @return $arr array of users.
	 */
	public function find () {		
		$userBO = UserBOImpl::getInstance();
		$this->configPagination ();
		$pagination = $_REQUEST['pagination'];		
		$arr = $userBO->find ($pagination);
		return $arr;
	}
	
	/**
	 * Configures the pagination.
	 * 
	 * @return void
	 */
	public function configPagination () {
		$userBO = UserBOImpl::getInstance();
		$pageNumber = $_REQUEST['pageNumber'];
		if (!isset($_REQUEST['pagination'])) {		
			$rows = $userBO->findRowCount ();					
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