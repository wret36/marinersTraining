<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mariner_Certificates_m extends MY_Model 
{
	const ITEMS_PER_PAGE = 10;
    const CERTIFICATE_ID    = 'certificate_id';
    const FIRST_NAME        = 'first_name';
    const LAST_NAME         = 'last_name';
    const MIDDLE_NAME       = 'middle_name';
    const SUFFIX            = 'suffix';
    const DATE_CERTIFIED    = 'date_certified';
    const CREATED_AT        = 'created_at';
    
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
        $this->db->select('id, certificate_id, first_name, last_name, middle_name, suffix, date_certified, created_at, updated_at');
        $this->db->from('mariner_certificates');
        $this->db->where('id IS NOT NULL');
        
        if (array_key_exists('certificate_id', $params)) {
            $this->db->where('certificate_id', $params['certificate_id']);
        }
        
        $query = $this->db->get();
        return $query->result();
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
		
		return (isset($query[0]) ? $query[0] : null) ;
	}
	
	/**
	 * @return Mariner_Certificates row
	 */
	public function create($params)
	{
	    $values = array_filter($params);
		return $this->db->insert('mariner_certificates', $values);
	}
	
	/**
	 * @param Mariner_Certificates row
	 * @return bool
	 */
	public function edit($params)
	{
		$result = null;
		if (isset($params['id']) || isset($params->id))
		{
			if (is_object($params)) {
				$id = $params->id;
				unset($params->id);
			} else {
				$id = $params['id'];
				unset($params['id']);
			}
			
			$this->db->where('id', $id);
			$result = $this->db->update('mariner_certificates', $params); 
		} else {
			throw new Exception('No id for mariner record provided');
		}
		
		return $result;
	}
	
	/**
	 * @return bool
	 */
	public function delete($id)
	{
	
	}
	
    public function browse($params = null, $page)
    {
	
    	$offset = ($page - 1) * self::ITEMS_PER_PAGE;
    	
        $this->db->select('id, certificate_id, first_name, last_name, middle_name, suffix, date_certified, created_at, updated_at');
        $this->db->from('mariner_certificates');
        $this->db->where('id IS NOT NULL');
        $this->db->limit(self::ITEMS_PER_PAGE, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getTotalRecordCount()
    {
    	$rowCount = 0;
    	
    	$this->db->select("COUNT(id) AS total");
    	$this->db->from($this->_table);
    	$query = $this->db->get();
    	
    	$rows = $query->result();
    	
    	if (isset($rows[0]) && is_object($rows[0])) {
    		if (isset($rows[0]->total)) {
    			$rowCount = (int) $rows[0]->total;
    		}
    	}
    	
    	return $rowCount;
    }
    
    public function isUniqueCertificateId($certificateId)
    {
        $isUnique = false;
        $result = $this->getBy(array('certificate_id' => $certificateId));
        if (count($result) == 0) {
            $isUnique = true;
        }
        
        return $isUnique;
    }
    
    public function saveFromValidatedFile($rowValues)
    {
        
        $this->_renameKeys($rowValues);
        $rowValues[self::CREATED_AT] = date('Y-m-d G:i:s');
        $this->create($rowValues);
        
    }
    
    private function _getReplacementKeys()
    {
        return array(self::CERTIFICATE_ID, self::FIRST_NAME, self::LAST_NAME, self::MIDDLE_NAME, self::SUFFIX, self::DATE_CERTIFIED);
        
    }

    private function _renameKeys(&$array)
    {
        $keys   = array_keys($array);
        $values = array_values($array);
        
        $replacement_keys = $this->_getReplacementKeys();
        
        for ($i=0; $i < count($replacement_keys); $i++) {
            $keys[$i] = $replacement_keys[$i];
        }

        $array = array_combine($keys, $values);
    }

}