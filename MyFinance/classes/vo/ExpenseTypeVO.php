<?php

/**
 * ExpenseTypeVO value object class.
 * 
 * @author Josivan Silva
 *
 */
class ExpenseTypeVO {

	private $ID_EXPENSE_TYPE;
	private $NM_EXPENSE_TYPE;
		
	public function __construct () {}
	
	public function getID_EXPENSE_TYPE () {
		return $this->ID_EXPENSE_TYPE;
	}
	public function setID_EXPENSE_TYPE ($ID_EXPENSE_TYPE) {
		$this->ID_EXPENSE_TYPE = $ID_EXPENSE_TYPE;
    }
	public function getNM_EXPENSE_TYPE () {
		return $this->NM_EXPENSE_TYPE;
	}
	public function setNM_EXPENSE_TYPE ($NM_EXPENSE_TYPE) {
		$this->NM_EXPENSE_TYPE = $NM_EXPENSE_TYPE;
    }
}

?>