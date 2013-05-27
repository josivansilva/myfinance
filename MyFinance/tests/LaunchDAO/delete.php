<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/LaunchBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/LaunchVO.php");

$launchBO = new LaunchBOImpl();

$launchVO = new LaunchVO();
$launchVO->setID_LAUNCH (1);

$countRows = $launchBO->delete ($launchVO);

var_dump ($countRows);

?>