<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/ExpenseTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/ExpenseTypeVO.php");

$expenseTypeBO = new ExpenseTypeBOImpl();
$expenseTypeVO = new ExpenseTypeVO();
$expenseTypeVO->setNM_EXPENSE_TYPE("Moradia1615");
$expenseTypeVO->setID_EXPENSE_TYPE (2);

//var_dump ($userVO);

$updatedRows = $expenseTypeBO->update ($expenseTypeVO);

var_dump ($updatedRows);

?>