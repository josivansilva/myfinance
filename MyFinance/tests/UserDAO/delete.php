<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/UserBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/UserVO.php");

$userBO = UserBOImpl::getInstance();

$userVO = new UserVO();
$userVO->setID_USER (3);

$countRows = $userBO->delete ($userVO);

var_dump ($countRows);

?>