<?php

/**
 * ExpenseType BO interface.
 * 
 * @author Josivan Silva
 *
 */
interface ExpenseTypeBO {
	
	/**
	 * Inserts a new expense type.
	 * 
	 * @param ExpenseTypeVO $expenseTypeVO the expense type vo.
	 */
	public function insert (ExpenseTypeVO $expenseTypeVO);

	/**
	 * Updates an expense type.
	 * 
	 * @param ExpenseTypeVO $expenseTypeVO the expense type vo.
	 */
	public function update (ExpenseTypeVO $expenseTypeVO);

	/**
	 * Deletes an expense type.
	 * 
	 * @param ExpenseTypeVO $expenseTypeVO the expense type vo.
	 */
	public function delete (ExpenseTypeVO $expenseTypeVO);

	/**
	 * Finds an expense type.
	 *
	 * @param Pagination $pagination the pagination.
	 */
	public function find (Pagination $pagination);
	
	/**
	 * Finds all the expense types.
	 *
	 */
	public function findAll ();
	
	/**
	 * Gets the row count from the find method.
	 * 
	 */
	public function findRowCount ();
	
	/**
	 * Finds an expense type by its id.
	 *
	 * @param ExpenseTypeVO $expenseTypeVO the expense type vo. 
	 */
	public function findById (ExpenseTypeVO $expenseTypeVO);
}

?>