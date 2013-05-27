<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/RevenueTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/RevenueTypeVO.php");

$revenueTypeBO = new RevenueTypeBOImpl();
$revenueTypeVO = new RevenueTypeVO();
$revenueTypeVO->setID_REVENUE_TYPE (2);

//var_dump ($userVO);

$countRows = $revenueTypeBO->delete ($revenueTypeVO);

var_dump ($countRows);

?>