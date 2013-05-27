<?php

/**
 * UserVO value object class.
 * 
 * @author Josivan Silva
 *
 */
class UserVO {

	private $ID_USER;
	private $USERNAME;
	private $PWD;
	private $EMAIL;
	private $ROLE_ADMIN;
	
	public function __construct () {}
	
	public function getID_USER () {
		return $this->ID_USER;		
	}
	public function setID_USER ($ID_USER) {
		$this->ID_USER = $ID_USER;
    }
	public function getUSERNAME () {
		return $this->USERNAME;		
	}
	public function setUSERNAME ($USERNAME) {
		$this->USERNAME = $USERNAME;
    }
	public function getPWD () {
		return $this->PWD;		
	}
	public function setPWD ($PWD) {
		$this->PWD = $PWD;
    }
	public function getEMAIL () {
		return $this->EMAIL;		
	}
	public function setEMAIL ($EMAIL) {
		$this->EMAIL = $EMAIL;
    }
	public function getROLE_ADMIN () {
		return $this->ROLE_ADMIN;
	}
	public function setROLE_ADMIN ($ROLE_ADMIN) {
		$this->ROLE_ADMIN = $ROLE_ADMIN;
    }

}

?>