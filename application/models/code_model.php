<?php
class Code_model extends CI_Model {

	public function __construct()
	{
	}
	
	function set_code($args)
	{
		$this->db->set($args);
		$this->db->insert('verifycode');
	}

	function get_code($args)
	{
		$query = $this->db->get_where('verifycode', array('v_code' => $args));
		return $query;
	}	

}
