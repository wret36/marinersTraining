<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // load common model for the controller
        $this->load->model('Mariner_Certificates_m', 'marinerCert');
        
        $this->load->model('Mariner_Certificates_Row_Validator_m', 'marinerCertificateRowValidator');
        $this->load->helper('mariner_certificates');
        
        // load partial for admin quick links
        $this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
    }
    
    public function index()
    {
		redirect(base_url().'admin/mariner_certificates/browse');

    }
    
    public function data()
    {
    	$page = $this->input->post('page');
    	
        $certRecord = $this->marinerCert->browse(null, $page);
        $encodedRows = $this->_encodeToFlexigridRows($certRecord);
        $itemCount = $this->marinerCert->getTotalRecordCount();
        
//         $page = 1;
        $responseArr = array(
            'page' => $page,
            'total' => $itemCount,
            'rows' => $encodedRows
        );
        
        $data = array( 'values' => $responseArr );
        $this->load->view('admin/data', $data);
    }
    
    private function _encodeToFlexigridRows($certRecord)
    {
    	
        $formattedArray = array();
        foreach ($certRecord as $row) {
            $tempArr = array(
                'id' => $row->id,
                'cell' => array(
                    'certificate_id' => $row->certificate_id,
                    'first_name' => $row->first_name,
                    'last_name' => $row->last_name,
                    'middle_name' => $row->middle_name,
                    'suffix' => $row->suffix,
                    'date_certified' => $row->date_certified,
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                    'id' => $row->id
                )
            );
            
            $formattedArray[] = $tempArr;
        }
        return $formattedArray;
    }
    
    public function search($skey)
    {
        // Load the view
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
            ->build('admin/browse', $data);
    }
    
    public function browse()
    {
        $data = array();
        
        // Load the view
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
            ->append_metadata(js('jquery-1.5.2.min.js', 'mariner_certificates'))
            ->append_metadata(js('flexigrid.pack.js', 'mariner_certificates'))
            ->append_metadata(js('init_flexigrid.js', 'mariner_certificates'))
            ->append_metadata(css('flexigrid.css', 'mariner_certificates'))
            ->build('admin/browse', $data);
    }
    
    public function read($id = null)
    {
        $data = array(
            'certRecord' => $this->_getSpecificMarinerRecord($id),
        );
        
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
            ->build('admin/read', $data);
    }
    
    public function edit($id = null)
    {
        
        if ($_POST) {
            $postValues = $_POST;
            
            if (isset($postValues['save'])) {
                
                unset($postValues['save']);
                try {
                    $result = $this->marinerCert->edit($postValues);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Record successfully updated.');
                    } else {
                        $this->session->set_flashdata('error', 'An error occured while updating your record');
                    }
                } catch (Exception $e) {
                    $this->session->set_flashdata('error', 'An error occured while updating your record');
                }
                
                redirect('admin/mariner_certificates/browse/'.null);
            }
        }
        
        $data = array(
            'certRecord' => $this->_getSpecificMarinerRecord($id),
            'operation' => 'edit'
        );
        
        // Load the view
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
            ->build('admin/forms/add_edit', $data);
    }
    
    /**
     * TODO: clean and validate
     */
    public function add()
    {
        if ($_POST) {
            $postValues = $_POST;
            
            if (isset($postValues['save'])) {
                
                unset($postValues['save']);
                try {
                    $result = $this->marinerCert->create($postValues);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Record successfully saved.');
                    } else {
                        $this->session->set_flashdata('error', 'An error occured while inserting your record');
                    }
                } catch (Exception $e) {
                    $this->session->set_flashdata('error', 'An error occured while inserting your record');
                }
                
                redirect('admin/mariner_certificates/add');
            } elseif (isset($postValues['cancel'])) {
                $this->session->set_flashdata('success', 'Adding new certificate cancelled.');
                redirect('admin/mariner_certificates/browse/', null);
            }
        }
        
        $data = array(
            'certRecord' => null,
            'operation' => 'add'
        );
        
        // Load the view
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
            ->build('admin/forms/add_edit', $data);
    }
    
    public function delete($id)
    {
    
    }
    
    public function upload()
    {
        $this->load->library('Upload_Filter');
        $this->upload_filter->instantiate('Excel_Filter');
        $this->load->library('Spreadsheet/SpreadsheetReaderFactory','test');
        
        $data = array();
        
        if ($this->input->post()) {
            $filename = $this->excel_filter->filterFileToUpload('userfile');
            if (!$this->excel_filter->getIsValidFile()) {
                $data['hasErrors'] = 1;
                $data['errorMessages'] = $this->excel_filter->getErrorMessages();
            } else {
                $tmpFileName = $_FILES['userfile']['tmp_name'];
                // move physical file in project
                move_uploaded_file($tmpFileName, './uploads/'.$filename);
                $fullFilename = './uploads/'.$filename;
                $reader = SpreadsheetReaderFactory::reader($fullFilename);
                $this->_validateUploadedFile($fullFilename);
                if ($this->marinerCertificateRowValidator->hasErrors()) {
                    $data['hasErrors'] = 1;
                    $data['errorMessages'] = $this->marinerCertificateRowValidator->getErrorMessages();
                } else {
                    try {
                        $rowsAffected = $this->_saveUploadedFileInDB($fullFilename);
                        $this->session->set_flashdata('success', $rowsAffected . 'row(s) are successfully inserted in database.');
                        redirect('admin/mariner_certificates/upload_result/', null);
                    }catch (Exception $e) {
                        $this->session->set_flashdata('error', 'Failed to upload data.' . $e->getMessage());
                        redirect('admin/mariner_certificates/upload_result/', null);
                    }
                }
            }
            
        }
        
        // Load the view
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
        	->append_metadata(css('style.css', 'mariner_certificates'))
            ->build('admin/forms/upload', $data);
    }
    
    
    
    public function upload_result()
    {
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
            ->build('admin/forms/upload', null);
    }
    
    public function post2()
    {
        $this->load->view('admin/browse_data');
    }
    
    private function _validateUploadedFile($filename = null)
    {
        $reader = SpreadsheetReaderFactory::reader($filename);
        $result = $reader->read( $filename );
                    
        $rowNum = 0;
        
        foreach($result as $sheet){
            foreach($sheet as $rowValues){
                $rowNum++;
                if(!empty($rowValues) 
                        && $rowNum > Mariner_Certificates_Row_Validator_m::ROW_HEADER ) {
                    $this->marinerCertificateRowValidator->setRowValues($rowValues);
                    $this->marinerCertificateRowValidator->setRowNum($rowNum);
                    $this->marinerCertificateRowValidator->validate();      
                }
            }
        }       
        
    }
    
    private function _saveUploadedFileInDB($filename = null)
    {
        $reader = SpreadsheetReaderFactory::reader($filename);
        $result = $reader->read($filename);
                    
        $rowNum = 0;
        $affectedRowCount = count($result[0]) - 1;
        foreach($result as $sheet){
            foreach($sheet as $rowValues){
                $rowNum++;
                if(!empty($rowValues) && $rowNum > Mariner_Certificates_Row_Validator_m::ROW_HEADER ) {
                    $this->marinerCert->saveFromValidatedFile($rowValues);
                }
            }
        }
        
        return $affectedRowCount;
        
    }
    
    private function _getSpecificMarinerRecord($id)
    {
        $result = null;
        if ($id) {
            $marinerResult = $this->marinerCert->getById($id);
            if (is_object($marinerResult)) {
                $result = $marinerResult;
            } else {
                $this->_noRecordFoundAction();
            }
        } else {
            $this->_noRecordFoundAction();
        }
        return $result;
    }
    
    private function _noRecordFoundAction()
    {
        $this->session->set_flashdata('error', 'No record found! Please specify the correct id.');
        redirect('admin/mariner_certificates');
    }

}