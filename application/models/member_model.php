<?php
class Member_model extends CI_Model {

	public function __construct()
	{
	}
	
	function get_member($args = FALSE)
	{
		$str = "SELECT DISTINCT CASE `s_id` WHEN `p_leader_number` THEN 2 ELSE 1 END `isLeader` FROM `member`, `project` WHERE `s_id` = '{$args}' AND `s_project` = `p_id`";
		$member = $this->db->query($str);
		if ($member->num_rows() > 0)
		{
		   return $member->result_array();
		}
		else
			return 0;
	}	
	function get_memberbySQL($args)
	{
		$query = $this->db->query($args);
		log_message('debug',json_encode($query->result_array()));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}
	
	function set_member($args = FALSE)
	{
		$this->db->set($args);
		$this->db->insert('member');
	}

	function update_memberByID($id, $args = FALSE)
	{
		$this->db->where('s_id', $id);
		$this->db->update('member', $args); 	
	}
	function get_memberByPID($id = FALSE)
	{
		$query = $this->db->get_where('member', array('s_project' => $id));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;	
	}		
	function del_memberByID($id = FALSE)
	{
		$this->db->delete('member', array('s_id' => $id)); 	
	}		
	
	function set_award($args = FALSE)
	{
		$this->db->set($args);
		$this->db->insert('award');
	}	
	function update_awardByID($id, $args = FALSE)
	{
		$this->db->where('a_id', $id);
		$this->db->update('award', $args); 	
	}
	function get_awardByID($id = FALSE)
	{
		$query = $this->db->get_where('award', array('a_id' => $id));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;	
	}		
	function get_awardByPID($id = FALSE)
	{
		$query = $this->db->get_where('award', array('a_project' => $id));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;	
	}		
	function del_awardByID($id = FALSE)
	{
		$this->db->delete('award', array('a_id' => $id)); 	
	}		
}
