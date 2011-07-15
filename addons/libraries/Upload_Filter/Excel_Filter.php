<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Filters images to be uploaded
*
*/
class Excel_Filter extends Upload_Filter
{
	// image-related properties
	private $_maxWidth;
	private $_maxHeight;
	
	private $_excelMimes = array(
	    'csv'  =>  array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/html'),
	    'xls'   => array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/html'),
	    'ods'   => array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel','application/vnd.oasis.opendocument.spreadsheet', 'text/html')
	);
	
	public function __construct()
	{
		parent::__construct();
		$this->ci->load->config('excel_filter');
		$this->fileType = 'excel';
		$this->maxSize = $this->ci->config->item('max_excel_file_size');
	}

	public function filterFileToUpload($formFile)
	{
		parent::filterFileToUpload($formFile);
		
		// TODO: add size checker
		/*
        if($this->_isExtImg($this->extension))
        {
            $dimension = @getimagesize($_FILES[$formFile]['tmp_name']);
            if($dimension[0] > $this->maxWidth)
            {
                $this->_errorDelete($formFile);
                throw new Exception('The width is bigger than the maximum allowed');
            }
            if($dimension[1] > $this->maxHeight)
            {
                $this->_errorDelete($formFile);
                throw new Exception('The height is bigger than the maximum allowed');
            }
        }*/
        return $this->newName;
	}
	
    // detect if file is correct
    protected function _isCorrectFile($file, $type = 'excel', $formFile)
    {
		return $this->_isExcel($file);
    }
    
    // Taken from CI
    private function _isExcel($file)
    {
        $allowedTypes = $this->ci->config->item('allowed_upload_excel_types');
        foreach ($allowedTypes as $excelType) {
        	$stack = $this->_excelMimes[$excelType];
        	if(in_array($file, $stack)) {
        		$file = $excelType;
        		break;
        	}
        }
		
		// double check here
        return (in_array($file, $allowedTypes)) ? $file : FALSE;
    }
}