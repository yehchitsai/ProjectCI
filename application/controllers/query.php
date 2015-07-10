<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query extends CI_Controller {

	private $data;
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url');
//		log_message('debug', 'this->setMessage()');
//		$this->setMessage();
	}

    function cors_headers() //Cross-origin resource sharing
    {
	header('Access-Control-Allow-Origin: *');
//	header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
	
	public function index()
	{
//		echo "123";

		$this->cors_headers();
		$this->load->model('project_model');
		$action = $this->input->post("action");
		log_message('debug', $action);
		if ($action == "keyword") {
			$this->keyword();
		} else if ($action == "teacher") {
			$this->teacher();
		} else if ($action == "project") {
			$this->project();
		} else if($action == "student") {
			$this->student();
		} else if($action == "enter_year") {
			$this->enter();
		}
	}

	private function project() {
		echo json_encode($this->project_model->get_project());
	}
	private function student() {
		echo json_encode($this->project_model->get_student($this->input->post("k_value")));
	}
	private function enter() {
		echo json_encode($this->project_model->get_byEnterYear($this->input->post("k_value")));
	}	
	private function teacher() {
//		echo "123";
		echo json_encode($this->project_model->get_project_teacher());
	}

	private function keyword() {
		echo json_encode($this->project_model->get_project_keyword());
//		echo json_encode($array,JSON_HEX_QUOT);
	}
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

