<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mariner_Certificates_Row_Validator_m extends MY_Model 
{
    
    const CERTIFICATE_ID    = 0;
    const FIRST_NAME        = 1;
    const LAST_NAME         = 2;
    const MIDDLE_NAME       = 3;
    const SUFFIX            = 4;
    const DATE_CERTIFIED    = 5;
    
    const ROW_HEADER                = 1;
    
    protected $_errorMsgs = "Encountered the following errors : <br><br><ul>";
    protected $_errorCount;
    protected $_rowNum;
    protected $_rowValues;
    
    public function __construct( $row = null, $x = 0 )
    {
        parent::__construct();
        $this->_rowValues = $row;
        $this->_rowNum = $x;
        $this->_errorCount = 0;
    }
    
    public function setRowValues( $value )
    {
        $this->_rowValues = $value;
    }
    
    public function setRowNum( $value )
    {
        $this->_rowNum = $value;
    }
    
    public function getErrorMessages()
    {
        return $this->_errorMsgs . "</ul>";
    }
    
    public function validate()
    {
        $this->validateCertificateId($this->_rowValues[self::CERTIFICATE_ID]);
        $this->validateDateCertified($this->_rowValues[self::DATE_CERTIFIED]);
    }
    
    public function hasErrors()
    {
        if ( $this->_errorCount != 0 )
            return true;
        else 
            return false;
    }
    
    public function validateCertificateId($ceritificateId = null)
    {
        $this->load->model('Mariner_Certificates_m', 'marinerCert');
        
        
        if (empty($ceritificateId)) {
            $this->_errorMsgs .= $this->_getTemplatedErrorMessage(self::CERTIFICATE_ID,"has an invalid certificate entry(empty).");
            $this->_errorCount++;
            return false;
        }
        
        if ( !$this->marinerCert->isUniqueCertificateId($ceritificateId)) {
            $this->_errorMsgs .= $this->_getTemplatedErrorMessage(self::CERTIFICATE_ID,"is not a unique certificate id value. Either the given value is 
                                                                            already uploaded(uploading an equal value) or there is an error in the value encoding." );
            $this->_errorCount++;
            return false;       
        }

        return true;    
    }
    
    public function validateDateCertified($dateCertified)
    {
        if ( empty( $dateCertified ) ) {
            $this->_errorMsgs .= $this->_getTemplatedErrorMessage(self::DATE_CERTIFIED, "has an invalid date value." );
            $this->_errorCount++;
            return false;       
        }else {
            $dateTime = new DateTime($dateCertified);
            $convertedDate = $dateTime->format('m-d-Y');
            
            try{
                $explodedDate = explode('-',$convertedDate);
            } catch( Exception $e ) {
                $this->_errorMsgs .= $this->_getTemplatedErrorMessage(self::DATE_CERTIFIED,"has an invalid date value." );
                $this->_errorCount++;
                return false;
            }

            if ( !checkdate($explodedDate[0],$explodedDate[1],$explodedDate[2]) ) {
                $this->_errorMsgs .= $this->_getTemplatedErrorMessage(self::DATE_CERTIFIED,"is not a valid date value for date certified." );
                $this->_errorCount++;
                return false;
            }
        }
        
        return true;
    }
    
    public function convertValueToValidColumnLabel( $column = 0 )
    {
        if ($column == self::CERTIFICATE_ID)
            return 'A';
        else if ($column == self::FIRST_NAME)
            return 'B';
        else if ($column == self::LAST_NAME )
            return 'C';
        else if ($column == self::MIDDLE_NAME)
            return 'D';         
        else if ($column == self::SUFFIX)
            return 'E';         
        else if ($column == self::DATE_CERTIFIED)
            return 'F';                                             
    }
    
    protected function _getTemplatedErrorMessage( $column = 0, $error = '' )
    {
        if( empty($this->_rowValues[self::DATE_CERTIFIED]) ) {
            return sprintf("<li> Certificate  on cell[%s%s] %s </li>", 
                         $this->convertValueToValidColumnLabel($column), $this->_rowNum, $error );      
        }
        
        if ( is_null( $this->_rowValues ) )
            return 'Invalid';
        else
            return sprintf("<li> Certificate entry with Certificate Id : %s on cell[%s%s] %s </li>", 
                        $this->_rowValues[self::CERTIFICATE_ID], $this->convertValueToValidColumnLabel($column), $this->_rowNum, $error );
    }


}