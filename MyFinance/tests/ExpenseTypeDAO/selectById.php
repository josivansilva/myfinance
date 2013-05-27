<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/ExpenseTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/ExpenseTypeVO.php");

$expenseTypeBO = new ExpenseTypeBOImpl();

$expenseTypeVO = new ExpenseTypeVO();
$expenseTypeVO->setID_EXPENSE_TYPE (1);

$arr = $expenseTypeBO->findById ($expenseTypeVO);

foreach ($arr as $key => $row) {
	echo $row->getID_EXPENSE_TYPE() . " - " . $row->getNM_EXPENSE_TYPE () . "<br>\n";
}

?>