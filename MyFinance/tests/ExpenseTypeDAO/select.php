<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/dao/AbstractDAO.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/bo/ExpenseTypeBOImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/myfinance/classes/vo/ExpenseTypeVO.php");

$expenseTypeBO = new ExpenseTypeBOImpl();

$arr = $expenseTypeBO->find();

//var_dump ($arr);

foreach ($arr as $key => $row){
	echo $row->getID_EXPENSE_TYPE ()." - " . $row->getNM_EXPENSE_TYPE () . "<br>\n";             
}

?>