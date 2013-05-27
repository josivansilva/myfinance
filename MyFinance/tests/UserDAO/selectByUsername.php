<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/UserBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/UserVO.php");

$userBO = UserBOImpl::getInstance();

$userVO = new UserVO();
$userVO->setUSERNAME ("admin1612");

$newUser = $userBO->findByUsername ($userVO);

//foreach ($arr as $key => $row) {
	echo $newUser->getID_USER() . " - " . $newUser->getUSERNAME() . "<br>\n";
//}

?>