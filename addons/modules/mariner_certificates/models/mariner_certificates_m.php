<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mariner_Certificates_m extends MY_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function test_query()
	{
		$this->db->select('id, certificate_id, first_name, last_name, middle_name, suffix, date_certified, created_at, updated_at');
		$this->db->from('mariner_certificates');

		$query = $this->db->get();
		return $query->result();
	}
	
	public function getBy($params)
	{
	
	}
	
	/** 
	 * TODO: temporary only, deprecate this if getBy is available
	 */
	public function getById($id)
	{
		$query = $this->db->get_where(
			'mariner_certificates',
			array(
				'id' => $id
			),
			1
		)->result();
		
		return $query[0];
	}
	
	/**
	 * @return Mariner_Certificates row
	 */
	public function create($params)
	{
		return $this->db->insert('mariner_certificates', $params);
	}
	
	/**
	 * @param Mariner_Certificates row
	 * @return bool
	 */
	public function edit($params)
	{
	
	}
	
	/**
	 * @return bool
	 */
	public function delete($id)
	{
	
	}

}