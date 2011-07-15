<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Filters files to upload
 * NOTE: Based on CodeIgniter's upload class
 * 
 * @author	erickson.leynes <erickson.leynes@98labs.com>
 */
class Upload_Filter {
    
	protected $ci;
	
	private $classes = array( 'Excel_Filter' );
	
    // properties
    // FIXME: load properties from config 
    protected $newName = '';
    protected $maxSize = 4; 
    protected $fileType = 'excel';
    protected $extension = '';
    protected $isValidFile;
    protected $errorCount;
    protected $errorMessages = 'Encountered the following errors : <br><br><ul>';
    
    
    public function __construct(){
    	$this->ci =& get_instance();
    	$this->isValidFile = true;
    }
    
    public function instantiate($class)
    {
    	if (in_array($class, $this->classes)) {
	    	$this->ci->load->library('Upload_Filter/'.$class);
    	}
    }
    
    // setters
    public function setNewName($name)
    {
        $this->newName = $name;
    }
    
    public function setMaxFileSize($size)
    {
        $this->maxSize = $size;
    }
    
    public function setFileType($type)
    {
        $this->fileType = $type;
    }
    
    public function getIsValidFile()
    {
        $isValid = true;
        if ($this->errorCount > 0) {
            $isValid = false;
        }
        
        return $isValid;
    }
    
    public function getErrorMessages()
    {
        return $this->errorMessages . "</ul>";
    }
    

    public function filterFileToUpload($formFile)
    {
        //No file to upload.
        if(!isset($_FILES[$formFile]) OR $_FILES[$formFile]['error'] != 0)
        {
            $this->errorCount++;
            $this->errorMessages .= $this->_buildErrorMessage('There was no file to upload');
        }

        //Get the extension or false.
        $this->extension = $this->_isCorrectFile($_FILES[$formFile]['type'], $this->fileType, $formFile);
        $extension = $this->extension;
        if(!$extension)
        {
            $this->errorCount++;
            $this->_errorDelete($formFile);
            $this->errorMessages .= $this->_buildErrorMessage('The file you tried to upload is not allowed or not a(an) '.$this->fileType.' file');
        }
        
        //Check for any upload errors.
        if($_FILES[$formFile]['error'] != 0)
        {
            $this->_errorDelete($formFile);
            $this->errorMessages .= $this->_buildErrorMessage('There was an error while trying to upload the file');
        }
        
        //Check for the maximum size of the file.
        if($_FILES[$formFile]['size'] > $this->maxSize * 1048576)
        {
            $this->errorCount++;
            $this->_errorDelete($formFile);
            $this->errorMessages .= $this->_buildErrorMessage('The size of the file is over the limit');
        }
        
        //Clean the name and check if it's empty.
        $this->newName = $this->_cleanFileName($_FILES[$formFile]['name']);
        if($this->newName == '')
        {
            $this->errorCount++;
            $this->_errorDelete($formFile);
            $this->errorMessages .= $this->_buildErrorMessage('Bad file');
        }
        
        //Return the path and the new name with the extension... Change it to whatever you want.
        return $this->newName;
    }
    
    //Private methods.
    /**
     * Override this function on child classes 
     * to determine if the file uploaded is correct.
     */
    protected function _isCorrectFile() {}
    
    // delete the file from temp
    private function _errorDelete($formFile)
    {
        @unlink($_FILES[$formFile]['tmp_name']);
    }
        
    // CI method to clean the file name.
    private function _cleanFileName($filename)
    {
        $bad = array(
                        "<!--",
                        "-->",
                        "'",
                        "<",
                        ">",
                        '"',
                        '&',
                        '$',
                        '=',
                        ';',
                        '?',
                        '/',
                        " ",
                        "\"",
                        "<",        // <
                        "%3c",     // <
                        ">",         // >
                        "",         // >
                        "(",         // (
                        ")",         // )
                        "%28",     // (
                        "&",         // &
                        "$",         // $
                        "?",         // ?
                        ";",         // ;
                        "="        // =
                    );
                    
        $filename = str_replace($bad, '', $filename);
        return stripslashes($filename);
    }
    
    private function _buildErrorMessage($errorMessage)
    {
        return "<li>" . $errorMessage . "</li>";
    }
    
    
}