<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/UserBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/UserVO.php");

$userBO = UserBOImpl::getInstance();

$userVO = new UserVO();
$userVO->setUSERNAME("admin1432");
$userVO->setPWD("54321");
$userVO->setEMAIL("test@localhost");
$userVO->setROLE_ADMIN (TRUE);
$userVO->setID_USER (3);

$updatedRows = $userBO->update($userVO);

var_dump ($updatedRows);

?>