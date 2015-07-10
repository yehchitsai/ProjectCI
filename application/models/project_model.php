<?php
class Project_model extends CI_Model {

	public function __construct()
	{
	}
	function get_award($args = FALSE)
	{
		$query = $this->db->get_where('award', array('a_project' => $args));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}	
	function getKeywordByPID($args = FALSE)
	{
		$query = $this->db->get_where('keyword', array('k_project' => $args));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;	
	}
	function getMemberByPID($args = FALSE)
	{
		$query = $this->db->get_where('member', array('s_project' => $args));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;	
	}	
	function get_project_teacher($args = FALSE)
	{
		$str = "SELECT P.*,M.entre_year AS enter_year, GROUP_CONCAT(M.s_name) AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND p_adviser LIKE '%{$this->input->post("p_adviser")}%' GROUP BY P.p_id ORDER BY M.entre_year, P.p_name";
//		$str = "SELECT P.*,SUBSTRING(`p_leader_number`,2,2) AS enter_year, GROUP_CONCAT(M.s_name) AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND p_adviser LIKE '%{$this->input->post("p_adviser")}%' GROUP BY P.p_id ORDER BY M.entre_year, P.p_name";
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	
	}	
	function get_projectbySQL($args)
	{
		$query = $this->db->query($args);
		log_message('debug',json_encode($query->result_array()));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}
	
	function get_project($args = FALSE)
	{
		$str = "SELECT P.*,M.entre_year AS enter_year, GROUP_CONCAT(M.s_name)  AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND p_name LIKE '%{$this->input->post("p_name")}%' GROUP BY P.p_id ORDER BY M.entre_year";
//		$str = "SELECT P.*,SUBSTRING(`p_leader_number`,2,2) AS enter_year, GROUP_CONCAT(M.s_name)  AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND p_name LIKE '%{$this->input->post("p_name")}%' GROUP BY P.p_id ORDER BY M.entre_year";
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
		
	}
	function get_studentByID($args = FALSE)
	{
		$str = "SELECT P.*,M.entre_year AS enter_year, GROUP_CONCAT(M.s_name)  AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND M.s_id = '{$args}' GROUP BY P.p_id ORDER BY M.entre_year";
//		$str = "SELECT P.*,SUBSTRING(`p_leader_number`,2,2) AS enter_year, GROUP_CONCAT(M.s_name)  AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND M.s_id = '{$args}' GROUP BY P.p_id ORDER BY M.entre_year";
		log_message('debug',$str);
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}		
	
	function get_student($args = FALSE)
	{
		$str = "SELECT P.*,M.entre_year AS enter_year, GROUP_CONCAT(M.s_name)  AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND M.s_name like '%{$args}%' GROUP BY P.p_id ORDER BY M.entre_year";
//		$str = "SELECT P.*,SUBSTRING(`p_leader_number`,2,2) AS enter_year, GROUP_CONCAT(M.s_name)  AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND M.s_name like '%{$args}%' GROUP BY P.p_id ORDER BY M.entre_year";
		log_message('debug',$str);
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}	
	
	function get_byEnterYear($args = FALSE)
	{
//		$str = "SELECT P.*,SUBSTRING(`p_leader_number`,2,2) AS enter_year, GROUP_CONCAT(M.s_name)  AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND M.entre_year={$args}  GROUP BY P.p_id ORDER BY P.p_adviser, P.p_name";
		$str = "SELECT P.*,M.entre_year AS enter_year, GROUP_CONCAT(M.s_name)  AS proj_members FROM project P, member M WHERE M.s_project=P.p_id AND M.entre_year={$args}  GROUP BY P.p_id ORDER BY P.p_adviser, P.p_name";
		log_message('debug',$str);
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}	
	
	function set_project($args = FALSE)
	{
		$this->db->set($args);
		$this->db->insert('project');
	}
	function update_projectByPID($id, $args = FALSE)
	{
		$this->db->where('p_id', $id);
		$this->db->update('project', $args); 
	}
	function get_project_keyword($args = FALSE)
	{
		$str = "SELECT P.*,M.entre_year AS enter_year, GROUP_CONCAT(M.s_name) AS proj_members FROM project as P , keyword AS K, member M WHERE  M.s_project=P.p_id AND K.k_project=P.p_id AND K.k_value like '%{$this->input->post("k_value")}%' GROUP BY P.p_id ORDER BY M.entre_year,P.p_adviser";
//		$str = "SELECT P.*,SUBSTRING(`p_leader_number`,2,2) enter_year, GROUP_CONCAT(M.s_name) AS proj_members FROM project as P , keyword AS K, member M WHERE  M.s_project=P.p_id AND K.k_project=P.p_id AND K.k_value like '%{$this->input->post("k_value")}%' GROUP BY P.p_id ORDER BY M.entre_year,P.p_adviser";
//		$str = "SELECT P.* FROM project as P RIGHT JOIN keyword AS K ON K.k_project=P.p_id WHERE K.k_value like '%{$this->input->post("k_value")}%' ";
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}

}

