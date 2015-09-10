<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_connected'))
{
	function is_connected()
	{
		if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {

			return true;

		} else {

			return false;

		}
	}
}