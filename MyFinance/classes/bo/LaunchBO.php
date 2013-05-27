<?php

/**
 * Launch BO interface.
 * 
 * @author Josivan Silva
 *
 */
interface LaunchBO {
	
	/**
	 * Inserts a new launch.
	 * 
	 * @param LaunchVO $launchVO the launch vo.
	 */
	public function insert (LaunchVO $launchVO);

	/**
	 * Updates a launch into the database.
	 * 
	 * @param LaunchVO $launchVO the launch vo.
	 */
	public function update (LaunchVO $launchVO);

	/**
	 * Deletes a launch from the database.
	 * 
	 * @param LaunchVO $launchVO the launch vo.
	 */
	public function delete (LaunchVO $launchVO);

	/**
	 * Finds a launch.
	 *
	 * @param Pagination $pagination the pagination.
	 */
	public function find (Pagination $pagination);
	
	/**
	 * Finds launches by a specified filter.
	 * 
	 * @param LaunchVO $launchVO the launch vo used as filter.
	 */
	public function findByFilter (LaunchVO $launchVO);
	
	/**
	 * Gets the row count from the find method.
	 * 
	 */
	public function findRowCount ();
	
	/**
	 * Finds a launch by its id in the database.
	 * 
	 * @param LaunchVO $launchVO the launch vo.
	 */
	public function findById (LaunchVO $launchVO);

}

?>