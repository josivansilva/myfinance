<?php

/**
 * LaunchVO value object class.
 * 
 * @author Josivan Silva
 *
 */
class LaunchVO {

	private $ID_LAUNCH;
	private $ID_USER;
	private $ID_REVENUE_TYPE;
	private $ID_EXPENSE_TYPE;
	private $NM_LAUNCH;
	private $VLR_LAUNCH;
	private $STATUS;
	private $DT_CREATION;
	
	public function __construct () {}
	
	public function getID_LAUNCH () {
		return $this->ID_LAUNCH;		
	}
	public function setID_LAUNCH ($ID_LAUNCH) {
		$this->ID_LAUNCH = $ID_LAUNCH;
    }
	public function getID_USER () {
		return $this->ID_USER;		
	}
	public function setID_USER ($ID_USER) {
		$this->ID_USER = $ID_USER;
    }
	public function getID_REVENUE_TYPE () {
		return $this->ID_REVENUE_TYPE;
	}
	public function setID_REVENUE_TYPE ($ID_REVENUE_TYPE) {
		$this->ID_REVENUE_TYPE = $ID_REVENUE_TYPE;
    }
	public function getID_EXPENSE_TYPE () {
		return $this->ID_EXPENSE_TYPE;
	}
	public function setID_EXPENSE_TYPE ($ID_EXPENSE_TYPE) {
		$this->ID_EXPENSE_TYPE = $ID_EXPENSE_TYPE;
    }
	public function getNM_LAUNCH () {
		return $this->NM_LAUNCH;
	}
	public function setNM_LAUNCH ($NM_LAUNCH) {
		$this->NM_LAUNCH = $NM_LAUNCH;
    }
	public function getVLR_LAUNCH () {
		$vlrLaunch = number_format ($this->VLR_LAUNCH, 2, '.', '');
		return $vlrLaunch;
	}
	public function setVLR_LAUNCH ($VLR_LAUNCH) {
		$this->VLR_LAUNCH = $VLR_LAUNCH;
    }
	public function getSTATUS () {
		if ($this->STATUS == "P") {
			return "PAGO";
		} else if ($this->STATUS == "N") {
			return "";
		}
	}
	public function setSTATUS ($STATUS) {
		$this->STATUS = $STATUS;
    }
	public function getDT_CREATION () {
		return $this->DT_CREATION;
	}
	public function setDT_CREATION ($DT_CREATION) {
		$this->DT_CREATION = $DT_CREATION;
    }
}

?>