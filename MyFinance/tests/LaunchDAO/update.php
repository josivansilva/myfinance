<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/LaunchBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/LaunchVO.php");

$launchBO  = new LaunchBOImpl();

$launchVO = new LaunchVO ();
$launchVO->setID_USER (8);
$launchVO->setID_REVENUE_TYPE (3);
$launchVO->setNM_LAUNCH ("FGTS");
$launchVO->setVLR_LAUNCH (3.800);
$launchVO->setSTATUS ("N");
$launchVO->setID_LAUNCH (2);
//0000-00-00 00:00:00
$currentDate = date ('Y/m/d h:i:s a', time());

//var_dump ($userVO);

$updatedRows = $launchBO->update ($launchVO);

var_dump ($launchVO);

?>