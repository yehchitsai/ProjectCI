<?php
require(APPPATH.'/libraries/REST_Controller.php');

class RESTAPI extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		
//		$this->load->model('db_model');
	}
	
    function cors_headers() //Cross-origin resource sharing
    {
	header('Access-Control-Allow-Origin: *');
//	header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }
    function user_get()
    {
	$this->user_post();
/*
		$data = array('returned: get'. $this->get('id'));
		$this->response($data);
*/
    }
    function user_options() {
        $this->cors_headers();
        $this->response($_SERVER['HTTP_ORIGIN']);
    }

    function user_post()
    {
	$this->cors_headers();
	$data = array('success' => true, 'user' => $this->db_model->get_skill($this->post('search_skill')));
        $this->response($data);
    }
    function auth_options()
    {
	$this->cors_headers();
	$this->response($_SERVER['HTTP_ORIGIN']);
    }

    function auth_post()
    {		
//	log_message('debug','test1');
	$this->cors_headers();
//	log_message('debug','test2');
	$auth='';
	include("curl_php.php");
//	log_message('debug','test3');
	if($auth=='')
	  $data = array('success' => false, 'auth' => false);
	else
	  $data = array('success' => true, 'auth' => $auth);
	 log_message('debug',json_encode($data));
	$this->response($data);
    }

    function user_put()
    {		
		$data = array('returned: put-'. $this->put('id'));
		$this->response($data);
    }

    function user_delete()
    {
		$data = array('returned: delete-'. $this->delete('id'));
		$this->response($data);
    }
}
?>
