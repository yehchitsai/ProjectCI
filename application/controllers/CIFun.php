<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
class CIFun extends REST_Controller {
//class CIFun extends Controller {

	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->cors_headers();
	}

    function cors_headers() //Cross-origin resource sharing
    {
		header('Access-Control-Allow-Origin: *');
//	header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
	
	public function code_post()
	{
//		$this->cors_headers();
		$v_code = substr(hash('md5',$this->input->post('id') . time()),1,6);
		$this->load->model('code_model');
		$array = array(
			"stu_id" => $this->input->post('id'),
			"v_code" => $v_code
		);
		$this->code_model->set_code($array);		
		$this->response($v_code);
	}
}	