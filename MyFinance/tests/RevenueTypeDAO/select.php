<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/RevenueTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/RevenueTypeVO.php");

$revenueTypeBO = new RevenueTypeBOImpl();

$arr = $revenueTypeBO->find();

//var_dump ($arr);

foreach ($arr as $key => $row){
	echo $row->getID_REVENUE_TYPE ()." - " . $row->getNM_REVENUE_TYPE () . "<br>\n";
}

?>