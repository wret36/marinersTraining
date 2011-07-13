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
            ->build('mariner_certificates/mariner_certificates/forms/certificate_verification');
        
    }
    
    
    public function verify()
    {
        $certificateId = $_POST['certificate_id'];
        $params = array('certificate_id' => $certificateId); 
        $certificates = $this->marinerCert->getBy($params);
        $data = array('certificate'=>array());
        if (count($certificates) > 0) {
            $certificate = $certificates[0];
            $data = array(
                'certificate' => $certificate
            );
        }
        
        $this->template
            ->title('Mariner Certificates')
            ->set('mariner_certificates')
            ->build('mariner_certificates/verify', $data);
    }
}