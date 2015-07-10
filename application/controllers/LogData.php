<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LogData extends CI_Controller {
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url');
	}
	public function index()
	{
		$update = 1;
		$log_id=$_GET['log_id'];
		$response = new stdClass();
	
		for ($i = 0, $timeout = 180; $i<$timeout; $i++ ) {

			$SQL = "SELECT * FROM system_log WHERE log_id > $log_id ORDER by log_id limit 100";
			$result = $this->db->query($SQL) or die("Couldn't execute query.".mysql_error());
			$row_num = $result->num_rows();
			if($row_num == 0){
				$update=0;
			} else {
				//$row_num = $row_num1 ;
				$j=0;
				foreach ($result->result_array() as $row)
				{
					$data[$j++] = $row;
					$log_id = $row['log_id']; 
				}
/*
				while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
					$data[$j++] = $row;
					$log_id = $row['log_id']; 
				}
*/				
				$update=1;
				$response->update = $update;
				$response->log_id = $log_id;
				$response->data = $data;
				echo json_encode($response);
				flush();
				exit(0);
			}
			usleep(1000000);
		}
	}
}
?>