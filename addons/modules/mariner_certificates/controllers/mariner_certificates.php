<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mariner_Certificates extends Public_Controller
{
    /**
     * Constructor method
     *
     * @author PyroCMS Dev Team
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mariner_Certificates_m', 'marinerCert');
        
        // Load the required classes

    }
    
    /**
     * Index method
     *
     * @access public
     * @return void
     */
    public function index()
    {
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
        	->append_metadata(js('jquery-1.5.2.min.js', 'mariner_certificates'))
        	->append_metadata(js('verify_cert.js', 'mariner_certificates'))
            ->append_metadata(js('paging.js', 'mariner_certificates'))
            ->build('mariner_certificates/mariner_certificates/forms/certificate_verification');
        
    }
    
    
    public function verify($isAjax = false)
    {
    	$data = array('certificate'=>array());
    	
    	// validate certificate here
		if (isset($_POST['verify'])) {
			$searchKey = $_POST['search_key'];
			$data = $this->_getCertificateData($searchKey);
		} else {
			$this->session->set_flashdata('error', 'Invalid arguments passed on verification params.');
			redirect(base_url().'mariner_certificates');
		}
		
    	if ($isAjax == true) {
    	    
    	    
    		$ajaxData = null;
    		// check if really an ajax request
    		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	    		$this->load->view('mariner_certificates/verify', $data);
    		}
    		// load ajax output view
// 			$this->load->view('ajax_output', $ajaxData);
    		
    	} else {
    		$this->template
    		->title('Mariner Certificates')
    		->set('mariner_certificates')
    		->build('mariner_certificates/verify', $data);
    	}
    	
    }
    
    private function _getCertificateData($searchKey)
    {
    	// default data
    	$data = null;
    	$params = array('search_key' => $searchKey);
    	$certificates = $this->marinerCert->getForVerification($params);
    	if (count($certificates) > 0) {
    		$data = array(
				'certificates' => $certificates
    		);
    	}
    	return $data;
    }
    
}