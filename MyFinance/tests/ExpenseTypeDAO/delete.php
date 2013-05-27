<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/ExpenseTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/ExpenseTypeVO.php");

$expenseTypeBO = new ExpenseTypeBOImpl();
$expenseTypeVO = new ExpenseTypeVO();
$expenseTypeVO->setID_EXPENSE_TYPE (2);

//var_dump ($userVO);

$countRows = $expenseTypeBO->delete ($expenseTypeVO);

var_dump ($countRows);

?>