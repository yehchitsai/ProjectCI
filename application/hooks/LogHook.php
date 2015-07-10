<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Hooks relating to logging.
 */
class LogHook {

 /**
  * Call the setDbReady() method in the extended MY_Log library.
  *
  * @param bool Whether or not the DB is ready to use.
  * @return void
  */
 public function setDbReady($ready = false)
 {
  // We can use get_instance() here because the controller
  // is already instantiated fully.
  $CI =& get_instance();
  $CI->log->setDbReady($ready);
 }
} 