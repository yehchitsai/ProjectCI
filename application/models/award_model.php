<?php
class Award_model extends CI_Model {

	public function __construct()
	{
	}
	
	function get_award($args = FALSE)
	{
	}	
	function get_awardbySQL($args)
	{
	}
	
	function set_award($args = FALSE)
	{
		$this->db->set($args);
		$this->db->insert('award');
	}
	

}
