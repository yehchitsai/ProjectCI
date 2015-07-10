<?php
class Teacher_model extends CI_Model {

	public function __construct()
	{
	}
	
	public function get_teacher($args = FALSE)
	{
		if($args==false)
			$query = $this->db->get('teacher');
		else {
			$query = $this->db->get_where('teacher',array('id' => $args));
		}
		log_message('debug',json_encode($query->result_array()));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}	

	public function set_teacher($args = FALSE)
	{
	}
}
