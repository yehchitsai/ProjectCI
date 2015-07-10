<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nas_directory extends CI_Controller{  
     
    function __construct() {  
        parent::__construct();  
//        $this->load->model('checkpwd_sql');  
       
        $this->load->helper('url');  
	$this->load->helper('directory');
    }  
     
    function index(){  
	$this->load->library('parser');
	$this->load->model('nas_model');
	$sid = $this->input->get("sid");
	$data = $this->nas_model->get_directory($sid,2);
/*	$str = '/nas/project/'. $sid;

	echo $str;
	$map = directory_map($str);
	foreach($map as $value)
	  echo $value . "<br>";
		$map = directory_map($str,1);
		$baseurl="http://mars.kh.usc.edu.tw/nas_directory/" . $sid;
		$i=0;
		if(empty($map))
		  $files[$i]['file']= "no file inside.";
		else {
		  foreach($map as $value){
		    $files[$i]['file']=$value;
		    $i++;
		  }
		}
		$data = array('baseurl'=> $baseurl, 'file_entries' => $files);
*/
		$this->parser->parse('nas_directory', $data);				


//        $this->load->view('Project_info');  
    }  
     
 
     
}  
?> 
