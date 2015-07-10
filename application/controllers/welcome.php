<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	private $data,$group,$logoutMsg;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->group = $this->loginGroup();
		$this->uid = 'A9828387';
		if($this->group!=false) {
			$this->logoutMsg = $this->group . "(Logout)";
			$this->uid = $this->session->userdata('id');
		}
//		log_message('debug', 'this->setMessage()');
//		$this->setMessage();
	}
	
	public function index()
	{
//		log_message('debug', 'this->setMessage()');
		$this->query();
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->logoutMsg = "";
		$this->query();
	}
	public function query()
	{
		$content = $this->load->view('query', '', true);
		$this->data = array(
			'baseURL'		=> base_url(), 
			'logout'		=> $this->logoutMsg, 
			'myAppCSS'	=>	base_url().'public/css/query.css',
			'myAppJS'	=>	base_url().'public/js/query.js',
			'content' => $content );
		$this->parser->parse('master',$this->data);			
	}	
	
	public function register()
	{
		if($this->group===false)	$this->login_view();
		else 
		{
			//$content = $this->load->view('register', '', true);
			if($this->group=="unreg_student")
				$projData="''";
			else {
				$this->load->model('project_model');
				$result = $this->project_model->get_studentByID($this->uid);
				//取得關鍵字
				$arr = $this->project_model->getKeywordByPID($result[0]['p_id']);
				$i=0;
				foreach ($arr as &$value) 
					 $str[$i++] = $value['k_value'];
				$result[0]['keyword']=implode(",",$str);
				//取得組員資料，需移除組長
				$arr = $this->project_model->getMemberByPID($result[0]['p_id']);
				foreach($arr as $key=>$value) {
					 if($value['s_id'] == $result[0]['p_leader_number']){
						unset($arr[$key]);
						break;
					}
				}
				$result[0]['members']=$arr;
				//取得專題成果
				$arr1 = $this->project_model->get_award($result[0]['p_id']);

				$result[0]['awards']=$arr1;
				//				$result[0]['awards']='test';
				//log_message('debug', "projData = " . json_encode($result));
				$projData=json_encode($result);
			}
//			$projData="''";
			$formData = array(
				'projData'		=> $projData
				);
			$content = $this->parser->parse('register',$formData,true);
			$this->data = array(
				'baseURL'		=> base_url(), 
				'logout'		=> $this->logoutMsg, 
				'myAppCSS'	=>	base_url().'public/css/register.css',
				'myAppJS'	=>	base_url().'public/js/register.js',
				'content' => $content );
			$this->parser->parse('master',$this->data);			
		}
	}	
	public function login()
	{
		if($this->group===false)	$this->login_view();
		else {
			switch($this->group){
				case "unreg_student":
					$this->register();
					break;
				case "teacher":
					$this->query();
					break;
				case "member":
					$this->project_info();
					break;
				case "leader":
					$this->register();
					break;
			}
		}
	}
	public function login_view()
	{
		
		$content = $this->load->view('login', '', true);
		$this->data = array(
			'baseURL'		=> base_url(), 
			'logout'		=> $this->logoutMsg, 
			'myAppCSS'	=>	base_url().'public/css/login.css',
			'myAppJS'	=>	base_url().'public/js/login.js',
			'content' => $content );
		$this->parser->parse('master',$this->data);			
	}

	public function modify()
	{
		if($this->group===false)	$this->login_view();
		else {
			$content = $this->load->view('modify', '', true);
			$this->data = array(
				'baseURL'		=> base_url(), 
				'logout'		=> $this->logoutMsg, 
				'myAppCSS'	=>	base_url().'public/css/modify.css',
				'myAppJS'	=>	base_url().'public/js/modify.js',
				'content' => $content );
			$this->parser->parse('master',$this->data);			
		}
	}

	public function project_info()
	{
		if($this->group===false)	$this->login_view();
		else {
			$this->load->model('project_model');
			$result = $this->project_model->get_studentByID($this->session->userdata('id'));
			//$result2 = $this->project_model->get_award($result[0]['p_id']);
			$formdata = array(
				'baseURL'	=> base_url(),
				'p_name'	=>  $result[0]['p_name'],
				'enter_year'	=>  $result[0]['enter_year'],
				'p_adviser'	=>  $result[0]['p_adviser'],
				'p_leader_name'	=>  $result[0]['p_leader_name'],
				'proj_members'	=>  $result[0]['proj_members'],
				'p_type'	=>  $result[0]['p_type'],
				'p_date'	=>  $result[0]['p_date'],
				'p_description'	=>  $result[0]['p_description'],
				 'award_entries' => $this->project_model->get_award($result[0]['p_id'])
				);
			//$content = $this->load->view('project_info','',true);
			$content = $this->parser->parse('project_info',$formdata,true);
			$this->data = array(
				'baseURL'	=> base_url(), 
				'logout'	=> $this->logoutMsg, 
				'myAppCSS'	=>	base_url().'public/css/project_info.css',
				'myAppJS'	=>	base_url().'public/js/project_info.js',
				'content' => $content );
			$this->parser->parse('master',$this->data);			
		}
	}	
	function loginGroup() //判斷是否已經登錄，並回傳登錄後群組
	{
		log_message('debug', "group = " . $this->session->userdata('group'));
		return $this->session->userdata('group');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */