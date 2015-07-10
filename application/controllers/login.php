<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller{  
     
    function __construct() {  
        parent::__construct();  
        $this->load->helper('url');
    }  
     
    function index(){
		$this->load->model('member_model');
        $action = $this->input->post("a_value");
		log_message('aa', $action);
		echo json_encode($this->member_model->get_member($action));
		/*if ($action == "1") {
			echo json_encode($this->teacher_model->get_teacher());
		} else if ($action == "2") {
			$this->finish();
		}	*/
    }   
    function login(){  
        $data['query'] = $this->checkpwd_sql->all('login');  
        $this->load->view('login',$data);  
    }  
     
}  
?> 