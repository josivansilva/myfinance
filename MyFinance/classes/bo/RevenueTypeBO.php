<?php

/**
 * RevenueType BO interface.
 * 
 * @author Josivan Silva
 *
 */
interface RevenueTypeBO {
	
	/**
	 * Inserts a new revenue type.
	 * 
	 * @param RevenueTypeVO $revenueTypeVO the revenue type vo.
	 */
	public function insert (RevenueTypeVO $revenueTypeVO);

	/**
	 * Updates a revenue type.
	 * 
	 * @param RevenueTypeVO $revenueTypeVO the revenue type vo.
	 */
	public function update (RevenueTypeVO $revenueTypeVO);

	/**
	 * Deletes a revenue type.
	 * 
	 * @param RevenueTypeVO $revenueTypeVO the revenue type vo.
	 */
	public function delete (RevenueTypeVO $revenueTypeVO);

	/**
	 * Finds a revenue type.
	 *
	 * @param Pagination $pagination the pagination.
	 */
	public function find (Pagination $pagination);
	
	/**
	 * Finds all the revenue types.
	 * 
	 */
	public function findAll ();
	
	/**
	 * Gets the row count from the find method.
	 * 
	 */
	public function findRowCount ();
	
	/**
	 * Finds a revenue type by its id.
	 *
	 * @param RevenueTypeVO $revenueTypeVO the revenue type vo. 
	 */
	public function findById (RevenueTypeVO $revenueTypeVO);
}

?>