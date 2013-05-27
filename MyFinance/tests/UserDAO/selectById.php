<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/AbstractDAO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/UserBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/UserVO.php");

$userBO = UserBOImpl::getInstance();

$userVO = new UserVO();
$userVO->setID_USER (0);

$arr = $userBO->findById ($userVO);

foreach ($arr as $key => $row) {
	echo $row->getID_USER() . " - " . $row->getUSERNAME() . "<br>\n";
}

?>