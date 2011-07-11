<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Mariner Certificates Helpers
 *
 * @author		Richard Malibiran <richard.malibiran@98labs.com>
 */

// ------------------------------------------------------------------------


/**
 * Easy Detect property existence
 *
 * @return Object
 */
if ( ! function_exists('get_propery_from_object'))
{
	function get_propery_from_object($object, $property)  
	{
		$returnValue = null;
		if (is_object($object)) {
			$returnValue = (isset($object->$property) ? $object->$property : null);
		}
		
		return $returnValue;
	}
}


/**
 * Is_Selected
 *
 * @return string
 */
/*
if ( ! function_exists('is_selected'))
{
	function is_selected($value1 = NULL, $value2 = NULL)  
	{
		if($value1 == $value2){ 
			return  'selected'; 
		} else {
			return NULL;
		}
	} 
}
*/
// ------------------------------------------------------------------------
