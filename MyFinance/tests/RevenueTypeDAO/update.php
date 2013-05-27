<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/RevenueTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/RevenueTypeVO.php");

$revenueTypeBO = new RevenueTypeBOImpl();
$revenueTypeVO = new RevenueTypeVO();
$revenueTypeVO->setNM_REVENUE_TYPE("Receitas principais1451");
$revenueTypeVO->setID_REVENUE_TYPE (3);

//var_dump ($userVO);

$updatedRows = $revenueTypeBO->update ($revenueTypeVO);

var_dump ($updatedRows);

?>