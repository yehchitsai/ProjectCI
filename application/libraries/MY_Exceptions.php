class MY_Exceptions extends CI_Exceptions{
    function __construct(){
        parent::__construct();
    }

    function log_exception($severity, $message, $filepath, $line){

        //$result = parent::write_log($level, $msg, $php_error);

        $ci =& get_instance();
		if($ci->log->dbReady=== true){
			$post = array(
					'log_type' => $level,
					'log_message' => $msg,
					'log_php_message' => $php_error,
					'log_ip_origin' => $ci->input->ip_address(),
					'log_user_agent' => $ci->agent->agent_string(),
					'log_date' => date("Y-m-d H:i:s",time())
				);

			$ci->db->insert('system_log', $post);
        }
        parent::log_exception($severity, $message, $filepath, $line);
        //return $result;
    }
}