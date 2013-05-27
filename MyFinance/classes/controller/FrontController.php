<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/controller/UserController.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/controller/RevenueTypeController.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/controller/ExpenseTypeController.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/controller/LaunchController.php");

/**
 * Front Controller class.
 * 
 * @author Josivan Silva
 *
 */
class FrontController {
	/*
	 * static property to hold singleton instance.
	 */
	private static $instance = false;
	private $controller;
	private $action;
	
	/**
	 * constructor
	 * private so only getInstance() method can instantiate
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Default singleton.
	 * 
	 * @return void
	 */
	public static function getInstance () {
		if (!FrontController::$instance) {
			FrontController::$instance = new FrontController();
		}
		return FrontController::$instance;
	}

	public function getController () {
		return $this->controller;		
	}
	public function setController ($controller) {
		$this->controller = $controller;
    }
    
	public function getAction () {
		return $this->action;		
	}
	public function setAction ($action) {
		$this->action = $action;
    }
    
    /**
	 * Routes to the controller and correspondent action.
	 * 
	 * @return void
	 */
    public function route () {
    	$controller = NULL;
    	// gets the controller e action
    	$controllerName = $this->controller;
    	$actionName     = $this->action;
    	// instantiate the controller
    	$controller = $controllerName::getInstance();
    	// invoking the specified action
    	$controller->{$actionName}();
    }
	
}
// begin - front controller initialization logic

$controller = $_REQUEST['controller'];
$action     = $_REQUEST['action'];

// instantiate the front controller
$frontController = FrontController::getInstance();
// setting the controller name and action
$frontController->setController ($controller);
$frontController->setAction ($action);
// routing to the correspondent controller and action
$frontController->route ();

// end - front controller initialization logic

?>