<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
//$hook['post_controller_constructor'] = array(
$hook['post_controller_constructor'] = array(
 'class'  => 'LogHook',
 'function' => 'setDbReady',
 'filename' => 'LogHook.php',
 'filepath' => 'hooks',
 'params' => true,
); 
/*
$hook['post_controller'] = array(
 'class'  => 'LogHook',
 'function' => 'setDbReady',
 'filename' => 'LogHook.php',
 'filepath' => 'hooks',
 'params' => false,
); 
*/
/* End of file hooks.php */
/* Location: ./application/config/hooks.php */