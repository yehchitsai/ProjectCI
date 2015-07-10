<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extend the functionality of the default Log library.
 *
 * @author Eric 'Aken' Roberts
 * @website http://www.cryode.com
 */
class MY_Log extends CI_Log {

 /**
  * Whether DB logging functionality is available or not.
  *
  * @var  boolean
  */
 protected $dbReady = false;

 /**
  * Constructor. Line added for log file readability.
  *
  * THIS CONSTRUCTOR IS OPTIONAL. You can remove it if you don't want the line.
  */
 public function __construct()
 {
  parent::__construct();

//  $this->write_log('debug', '--------------------------------------------------------');
 }

 /**
  * write_log function adds the database logging check prior to
  * using the default write_log() method in the parent, and thus
  * writing the log message to the file like usual.
  *
  * @param string Priority level.
  * @param string Message to log.
  * @param bool Is this a PHP error?
  * @return void
  */
 public function write_log($level = 'error', $msg, $php_error = false)
 {
  if ($this->dbReady === true)
//if (true)
  {
   // This is where you would perform your DB logging,
   // using $CI = get_instance();

   // This is here just for reference to see when it would fire:

        $ci =& get_instance();
        //$ci->load->library('user_agent');
        //$gmtoffset = 60*60*5;
		date_default_timezone_set("Asia/Taipei");
        $post = array(
                'log_type' => $level,
                'log_message' => $msg,
                'log_php_message' => $php_error,
                'log_ip_origin' => $ci->input->ip_address(),
                'log_user_agent' => $ci->agent->agent_string(),
                'log_date' => date("Y-m-d H:i:s",time())
            );

        $ci->db->insert('system_log', $post);

//   parent::write_log($level, '-- INSERT INTO DB: ' . $msg, $php_error);
  }

  // Write the message to the log file like normal.
  $result = parent::write_log($level, $msg, $php_error);
  return $result;
 }

 /**
  * Set the current availability of DB logging.
  *
  * @param bool
  * @return void
  */
 public function setDbReady($ready = false)
 {
  $this->dbReady = (bool) $ready;
 }

}