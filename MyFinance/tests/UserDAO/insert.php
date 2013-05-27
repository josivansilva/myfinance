<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/AbstractDAO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/UserBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/UserVO.php");

$userBO = UserBOImpl::getInstance();

//$fieldArr = "nome,login,senha";
//$paramArr = array ("Ingrid","login1","senha1");

$userVO = new UserVO();
$userVO->setUSERNAME("admin");
$userVO->setPWD("admin");
$userVO->setEMAIL("admin@myfinance.com");
$userVO->setROLE_ADMIN (TRUE);

$userVO = $userBO->insert ($userVO);

echo $userVO->getID_USER() . "\n";

var_dump ($userVO);

?>