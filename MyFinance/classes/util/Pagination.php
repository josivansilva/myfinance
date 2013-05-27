<?php

/**
 * Pagination util class.
 * 
 * @author Josivan Silva
 *
 */
class Pagination {

	private $PAGE_NUM;
	private $PAGE_ROWS;
	private $LAST;
	private $ROWS;	
		
	public function __construct () {
		$this->PAGE_NUM = 1;
		$this->LAST     = 1;
	}
	
	public function getPAGE_NUM () {		
		if ($this->PAGE_NUM < 1) {
 			$this->PAGE_NUM = 1;
 		}
		return $this->PAGE_NUM;		
	}
	public function setPAGE_NUM ($PAGE_NUM) {
		$this->PAGE_NUM = $PAGE_NUM;
    }
	public function getPAGE_ROWS () {
		return $this->PAGE_ROWS;
	}
	public function setPAGE_ROWS ($PAGE_ROWS) {
		$this->PAGE_ROWS = $PAGE_ROWS;
    }
	public function getLAST () {
		$this->LAST = ceil ($this->ROWS / $this->PAGE_ROWS);
		return $this->LAST;
	}
	public function getROWS () {
		return $this->ROWS;		
	}
	public function setROWS ($ROWS) {
		$this->ROWS = $ROWS;
    }
    
    public function getLIMIT () {
    	return ($this->PAGE_NUM - 1) * $this->PAGE_ROWS . "," . $this->PAGE_ROWS;
    }
}

?>