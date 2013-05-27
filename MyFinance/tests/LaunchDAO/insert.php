<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/LaunchBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/LaunchVO.php");

$launchBO  = LaunchBOImpl::getInstance();

$launchVO = new LaunchVO();
$launchVO->setID_USER(34);
$launchVO->setID_EXPENSE_TYPE(10);
$launchVO->setNM_LAUNCH ("Estacionamento");
$launchVO->setVLR_LAUNCH (800);
$launchVO->setSTATUS ("P");
//0000-00-00 00:00:00
date_default_timezone_set("America/Sao_Paulo");

$currentDate = date ('Y/m/d h:i:s a', time());
$launchVO->setDT_CREATION ($currentDate);

//var_dump ($userVO);

$launchVO = $launchBO->insert ($launchVO);

var_dump ($launchVO);

?>