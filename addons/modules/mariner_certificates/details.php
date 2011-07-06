<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_mariner_certificates extends Module {

	public $version = '0.1';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Mariner Certificates'
			),
			'description' => array(
				'en' => 'Mariner Certificates Manager',
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => "Mariner Certificates"
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('mariner_certificates');
		
		$marinersTable = "
		CREATE TABLE IF NOT EXISTS `mariner_certificates` (
		  `id` int(11) NOT NULL auto_increment,
		  `certificate_id` varchar(200) collate utf8_unicode_ci NOT NULL,
		  `first_name` varchar(255) collate utf8_unicode_ci NOT NULL,
		  `last_name` varchar(255) collate utf8_unicode_ci NOT NULL,
		  `middle_name` varchar(255) collate utf8_unicode_ci default NULL,
		  `suffix` varchar(10) collate utf8_unicode_ci default NULL,
		  `date_certified` timestamp NULL default NULL,
		  `created_at` timestamp NULL default NULL,
		  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
		  PRIMARY KEY  (`id`),
		  UNIQUE KEY `certificate_id` (`certificate_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		";
		
		if($this->db->query($marinersTable)) {
			return TRUE;
		}
		
	}

	public function uninstall()
	{
		if($this->dbforge->drop_table('mariner_certificates')) {
			return TRUE;
		}
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "This modules manages the Mariner Certificates.";
	}
}
/* End of file details.php */
