<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		// load common model for the controller
		$this->load->model('Mariner_Certificates_m', 'marinerCert');
		
		// load partial for admin quick links
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	}
	
	public function index()
	{

		$data = array(
			'test_data' => $this->marinerCert->test_query()
		);

		// Load the view
		$this->template
			->title('Mariner Certificates')
			->set('mariner_certificates')
			->build('admin/index', $data);
	}
	
	public function search($skey)
	{

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
			}
		}
		
		// Load the view
		$this->template
			->title('Mariner Certificates')
			->set('mariner_certificates')
			->build('admin/forms/add_edit');
	}
	
	public function read($id)
	{
		$result = null;
		if ($id) {
			$marinerResult = $this->marinerCert->getById($id);
			$result = ($marinerResult ? $marinerResult : null);
		} else {
			redirect('admin/mariner_certificates');
		}
		
		$data = array(
			'certRecord' => $result 
		);
		
		$this->template
			->title('Mariner Certificates')
			->set('mariner_certificates')
			->build('admin/read', $data);
	}
	
	public function browse()
	{
		
	}
}
