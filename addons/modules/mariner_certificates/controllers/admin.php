<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	}
	
	public function index()
	{
		$this->load->model('Mariner_Certificates_m', 'marinerCert');

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
	
}
