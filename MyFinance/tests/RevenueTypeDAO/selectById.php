<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/RevenueTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/RevenueTypeVO.php");

$revenueTypeBO = new RevenueTypeBOImpl();

$revenueTypeVO = new RevenueTypeVO();
$revenueTypeVO->setID_REVENUE_TYPE (3);

$arr = $revenueTypeBO->findById ($revenueTypeVO);

foreach ($arr as $key => $row) {
	echo $row->getID_REVENUE_TYPE() . " - " . $row->getNM_REVENUE_TYPE () . "<br>\n";
}

?>