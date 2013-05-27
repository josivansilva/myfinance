<?php

/**
 * Expense Type DAO interface.
 * 
 * @author Josivan Silva
 *
 */
interface ExpenseTypeDAO {
	
	/**
	 * Inserts a new expense type into the database.
	 * 
	 * @param ExpenseTypeVO $expenseTypeVO the expense type vo.
	 */
	public function insert (ExpenseTypeVO $expenseTypeVO);

	/**
	 * Updates an expense type into the database.
	 * 
	 * @param ExpenseTypeVO $expenseTypeVO the expense type vo.
	 */
	public function update (ExpenseTypeVO $expenseTypeVO);

	/**
	 * Deletes an expense type from the database.
	 * 
	 * @param ExpenseTypeVO $expenseTypeVO the expense type vo.
	 */
	public function delete (ExpenseTypeVO $expenseTypeVO);

	/**
	 * Finds a expense type into the database.
	 * 
	 * @param Pagination $pagination the pagination. 
	 */
	public function find (Pagination $pagination);
	
	/**
	 * Finds the expense types associated to a specific launch.
	 * 
	 * @param launchVO the $launchVO used as filter.
	 */
	public function findByLaunch (LaunchVO $launchVO);
	
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
	 * Finds an expense type by its id in the database.
	 * 
	 * @param ExpenseTypeVO $expenseTypeVO the expense type vo. 
	 */
	public function findById (ExpenseTypeVO $expenseTypeVO);

}

?>