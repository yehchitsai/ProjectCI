<?php
class Keyword_model extends CI_Model {

	public function __construct()
	{
	}
	
	function set_keyword($args)
	{
		$this->db->set($args);
		$this->db->insert('keyword');
	}
	function delete_keywordByPID($pid)
	{
		$this->db->where('k_project', $pid);
		$this->db->delete('keyword'); 
	}	

}
