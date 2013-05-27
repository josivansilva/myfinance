<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/dao/AbstractDAO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/UserBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/UserVO.php");

$userBO  = UserBOImpl::getInstance();

$userVO = new UserVO();
$userVO->setUSERNAME("admin");
$userVO->setPWD("admin");
$rowCount = $userBO->doLogin ($userVO);
var_dump ($rowCount);

?>