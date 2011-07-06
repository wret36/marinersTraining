<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Casebook Helpers
 *
 * @package		Casebook
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Casebook Dev Team
 */

// ------------------------------------------------------------------------


/**
 * Easy Access to SoapClient
 *
 * @return Object
 */
/*
if ( ! function_exists('sc'))
{
	function sssc($value = NULL, $soap_options = NULL)  
	{
		if ($value == NULL) {return FALSE;}
	
	    if ($soap_options == NULL) {
	    	$soap_options = array('trace'=>1, 'exceptions'=>1);
	    } 
	    
	    if ($client = new SoapClient(WEBSERVICE_URL.$value.'.svc?wsdl', $soap_options)) {
			return $client;
		} else {
			return FALSE;
		}
	} 
}
*/


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


/* End of file casebook_helper.php */
/* Location: ./cb_base/helpers/casebook_helper.php */