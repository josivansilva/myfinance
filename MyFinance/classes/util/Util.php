<?php

/**
 * Utility class containing useful methods.
 * 
 * @author Josivan Silva
 *
 */
class Util {

	/**
	 * Gets the start date given the month and year.
	 * 
	 * @param $month the month
	 * @param $year the year
	 * @return start date
	 */
	public static function getStartDate ($month, $year) {
		date_default_timezone_set("America/Sao_Paulo");
		$date = new DateTime();
		$date->setDate ($year, $month, 1);
		return $date->format("Y/m/d 00:00:00");
	}
	
	/**
	 * Gets the end date (after 1 month) given the start date.
	 * 
	 * @param $startDate the start date
	 * @return end date
	 */
	public static function getEndDate ($startDate) {
		$date = new DateTime ($startDate);
		$interval = new DateInterval('P1M');
		$date->add ($interval);
		return $date->format("Y/m/d 00:00:00");
	}
	
}

?>