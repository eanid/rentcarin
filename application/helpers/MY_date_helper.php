<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('week_between_two_dates'))
{
	function week_between_two_dates($format, $date1, $date2)
	{
		$first = DateTime::createFromFormat($format, $date1);
		$second = DateTime::createFromFormat($format, $date2);
		if($date1 > $date2) return week_between_two_dates($date2, $date1);
		return floor($first->diff($second)->days/7);
	}
	
	function month_between_two_dates($date1, $date2)
	{
		$time_stamp1 = strtotime($date1);
		$time_stamp2 = strtotime($date2);

		$year1 = date('Y', $time_stamp1);
		$year2 = date('Y', $time_stamp2);

		$month1 = date('m', $time_stamp1);
		$month2 = date('m', $time_stamp2); 
		
		$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
		return $diff;
	}
	
}