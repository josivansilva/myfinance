<?php

/**
 * Revenue Type DAO interface.
 * 
 * @author Josivan Silva
 *
 */
interface RevenueTypeDAO {
	
	/**
	 * Inserts a new revenue type into the database.
	 * 
	 * @param RevenueTypeVO $revenueTypeVO the revenue type vo.
	 */
	public function insert (RevenueTypeVO $revenueTypeVO);

	/**
	 * Updates a revenue type into the database.
	 * 
	 * @param RevenueTypeVO $revenueTypeVO the revenue type vo.
	 */
	public function update (RevenueTypeVO $revenueTypeVO);

	/**
	 * Deletes a revenue type into the database.
	 * 
	 * @param RevenueTypeVO $revenueTypeVO the revenue type vo.
	 */
	public function delete (RevenueTypeVO $revenueTypeVO);

	/**
	 * Finds a revenue type into the database.
	 * 
	 * @param Pagination $pagination the pagination. 
	 */
	public function find (Pagination $pagination);
	
	/**
	 * Finds the revenue types associated to a specific launch.
	 * 
	 * @param launchVO the $launchVO used as filter. 
	 */
	public function findByLaunch (LaunchVO $launchVO);
	
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
	 * Finds a revenue type by its id in the database.
	 * 
	 * @param RevenueTypeVO $revenueTypeVO the revenue type vo. 
	 */
	public function findById (RevenueTypeVO $revenueTypeVO);

}

?>