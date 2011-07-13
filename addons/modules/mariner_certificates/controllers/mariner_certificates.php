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
            ->build('mariner_certificates/mariner_certificates/forms/certificate_verification');
        
    }
    
    
    public function verify($isAjax = false)
    {
    	$data = array('certificate'=>array());
    	
    	// validate certificate here
		if (isset($_POST['verify'])) {
			$certID = $_POST['certificate_id'];
			$data = $this->_getCertificateData($certID);
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
    
    private function _getCertificateData($certID)
    {
    	// default data
    	$data = null;
    	$params = array('certificate_id' => $certID);
    	$certificates = $this->marinerCert->getBy($params);
    	
    	if (count($certificates) > 0) {
    		$certificate = $certificates[0];
    		$data = array(
				'certificate' => $certificate
    		);
    	}
    	return $data;
    }
    
}