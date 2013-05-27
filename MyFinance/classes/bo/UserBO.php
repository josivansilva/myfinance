<?php

/**
 * User BO interface.
 * 
 * @author Josivan Silva
 *
 */
interface UserBO {
	
	/**
	 * Inserts a new user.
	 * 
	 * @param UserVO $userVO the user vo.
	 */
	public function insert (UserVO $userVO);

	/**
	 * Updates an user into the database.
	 * 
	 * @param UserVO $userVO the user vo.
	 */
	public function update (UserVO $userVO);

	/**
	 * Deletes an user into the database.
	 * 
	 * @param UserVO $userVO the user vo.
	 */
	public function delete (UserVO $userVO);

	/**
	 * Finds an user into the database.
	 *
	 * @param Pagination $pagination the pagination.
	 */
	public function find (Pagination $pagination);
	
	/**
	 * Gets the row count from the find method.
	 * 
	 */
	public function findRowCount ();
	
	/**
	 * Finds an user by its id in the database.
	 * 
	 * @param UserVO $userVO the user vo.
	 */
	public function findById (UserVO $userVO);
	
	/**
	 * Finds an user by its username in the database.
	 * 
	 * @param UserVO $userVO the user vo.
	 */
	public function findByUsername (UserVO $userVO);
	
	/**
	 * Performs the user login.
	 * 
	 */
	public function doLogin (UserVO $userVO);

}

?>