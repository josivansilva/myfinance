<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/RevenueTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/RevenueTypeVO.php");

$revenueTypeBO = new RevenueTypeBOImpl();
$revenueTypeVO = new RevenueTypeVO();
$revenueTypeVO->setNM_REVENUE_TYPE("Receitas principais");

//var_dump ($revenueTypeVO);

$revenueTypeVO = $revenueTypeBO->insert ($revenueTypeVO);

var_dump ($revenueTypeVO);

?>