<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_info extends CI_Controller{  
     
    function __construct() {  
        parent::__construct();  
       
        $this->load->model('checkpwd_sql');  
       
        $this->load->helper('url');  
    }  
     
    function index(){  
        $this->load->view('Project_info');  
    }  
     
 
     
}  
?> 