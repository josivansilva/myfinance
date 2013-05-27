<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/AbstractDAO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/UserBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/UserVO.php");

$userBO = UserBOImpl::getInstance();

$arr = $userBO->find();

foreach ($arr as $key => $row) {
	echo $row->getID_USER() . " - " . $row->getUSERNAME() . "<br>\n";
}

?>