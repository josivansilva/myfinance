<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/LaunchBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/LaunchVO.php");

$launchBO = new LaunchBOImpl();

$arr = $launchBO->find();

foreach ($arr as $key => $row) {
	echo $row->getID_LAUNCH() . " - " . $row->getNM_LAUNCH () . "<br>\n";
}

?>