<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/ExpenseTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/ExpenseTypeVO.php");

$expenseTypeBO = new ExpenseTypeBOImpl();
$expenseTypeVO = new ExpenseTypeVO();
$expenseTypeVO->setNM_EXPENSE_TYPE("Moradia");

//var_dump ($revenueTypeVO);

$expenseTypeVO = $expenseTypeBO->insert ($expenseTypeVO);

var_dump ($expenseTypeVO);

?>