<?php

/**
 * RevenueTypeVO value object class.
 * 
 * @author Josivan Silva
 *
 */
class RevenueTypeVO {

	private $ID_REVENUE_TYPE;
	private $NM_REVENUE_TYPE;
		
	public function __construct () {}
	
	public function getID_REVENUE_TYPE () {
		return $this->ID_REVENUE_TYPE;		
	}
	public function setID_REVENUE_TYPE ($ID_REVENUE_TYPE) {
		$this->ID_REVENUE_TYPE = $ID_REVENUE_TYPE;
    }
	public function getNM_REVENUE_TYPE () {
		return $this->NM_REVENUE_TYPE;		
	}
	public function setNM_REVENUE_TYPE ($NM_REVENUE_TYPE) {
		$this->NM_REVENUE_TYPE = $NM_REVENUE_TYPE;
    }
}

?>