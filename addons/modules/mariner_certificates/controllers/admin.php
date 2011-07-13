<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // load common model for the controller
        $this->load->model('Mariner_Certificates_m', 'marinerCert');
        $this->load->helper('mariner_certificates');
        
        // load partial for admin quick links
        $this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
    }
    
    public function index()
    {

//        $certRecord = $this->marinerCert->test_query();
//        $encodedRows = $this->_encodeToFlexigridRows($certRecord);
//        $itemCount = count($certRecord);
//        $page = 1;
//        
//        $responseArr = array(
//            'page' => $page,
//            'total' => $itemCount,
//            'rows' => $encodedRows
//            
//        );
//        
//        $data = array(
//            'test_data' => $responseArr 
//        );
//
//        $this->load->view('admin/index');
        
        // Load the view
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
            ->build('admin/index', null);
    }
    
    public function data()
    {

        $certRecord = $this->marinerCert->browse();
        $encodedRows = $this->_encodeToFlexigridRows($certRecord);
        $itemCount = count($certRecord);
        
        $page = 1;
        
        $responseArr = array(
            'page' => $page,
            'total' => $itemCount,
            'rows' => $encodedRows
            
        );
        
        $data = array(
            'values' => $responseArr 
        );

        $this->load->view('admin/data', $data);
        
        // Load the view
//      $this->template
//          ->title('Mariner Certificates')
//          ->set('mariner_certificates')
//          ->build('admin/index', $data);
    }
    
    private function _encodeToFlexigridRows($certRecord)
    {
//        id     certificate_id     first_name     last_name     middle_name     suffix     date_certified     created_at     updated_at
        
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
    
    public function post2()
    {
        $this->load->view('admin/browse_data');
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