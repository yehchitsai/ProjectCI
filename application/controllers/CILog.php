<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CILog extends CI_Controller {

	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->data = array(
			'baseURL'		=> base_url()
		);
		$this->parser->parse('logView',$this->data);			
	}
}	