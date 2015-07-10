<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modify extends CI_Controller {
	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('teacher_model');
		$this->load->model('project_model');
		$this->load->model('member_model');
		$this->load->model('keyword_model');
	}
	
	public function index()
	{
		
		$action = $this->input->post("action");
		if ($action == "teacher") {
			echo json_encode($this->teacher_model->get_teacher());
		} else if ($action == "finish") {
			$this->finish();
		}	
	}

	private function finish() {
			$leader_name = $this->input->post("leader_name");
			$leader_number = $this->input->post("leader_number");
			$project_name = $this->input->post("project_name");
			$project_description = $this->input->post("project_description");
			$project_teacher = $this->input->post("project_teacher");
			$project_type = $this->input->post("project_type");

			$s =$this->teacher_model->get_teacher($project_teacher);
			log_message('debug',$s[0]['name']);
			$array = array(
				"p_name" => $project_name, 
				"p_adviser" => $s[0]['name'],
				"p_type" => $project_type,
				"p_description" => $project_description,
				"p_leader_name" => $leader_name,
				"p_leader_number" => $leader_number,
				"p_date" => date("Y-m-d")
			);
			
			$this->project_model->set_project($array);
			$x = $this->project_model->get_projectbySQL("SELECT max(p_id) as p_id FROM project");

//			$db->insert("project", $array);			
//			$db->select("project", "p_id=(SELECT max(p_id) FROM project)");
//			$x = $db->getOne();
			$array = array(
				"s_project" => $x[0]['p_id'],
				"s_name" => $leader_name,
				"s_id" => $leader_number
			);
			$this->member_model->set_member($array);				

			$na = explode(",", $this->input->post("stu_name"));
			$nu = explode(",", $this->input->post("stu_num"));
//			var_dump($na);
			for ($i = 0; $i < count($na); $i++) {
				$array = array(
					"s_project" => $x[0]['p_id'],
					"s_name" => $na[$i],
					"s_id" => $nu[$i]
				);
				$this->member_model->set_member($array);
			}
			$nux = explode(",", $this->input->post("project_keyword"));
			for ($i = 0; $i < count($nux); $i++) {
				$array = array(
					"k_project" => $x[0]['p_id'],
					"k_value" => $nux[$i]
				);
				$this->keyword_model->set_keyword($array);
//				$db->insert("keyword", $array);
			}
//		echo  var_dump($array);
/*
		mkdir("/nas/project/$leader_number");
		$data="index.txt";
		$fp=fopen("/nas/project/$leader_number/$data","a+");  
//		$str = var_dump($array);
		fwrite($fp,'434');
		fclose($fp);
*/	 
	}
}

?>
