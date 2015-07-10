<?php
class Nas_model extends CI_Model {

	public function __construct()
	{
	}
	
	public function get_directory($args = FALSE,$level)
	{
		$this->load->helper('directory');
		$str = '/nas/project/'. $args;
		$map = directory_map($str,$level+1);
                $baseurl="http://mars.kh.usc.edu.tw/nas_directory/" . $args;
                $i=0;
                if(empty($map))
                  $files[$i]['file']= "no file inside.";
                else {
                  foreach($map as $key=>$value){
		    if(is_array($value)){
			$files[$i++]['file']= "+ " . $key;
			foreach($value as $secondKey=>$secondValue){
			  if(is_array($secondValue))
			    $files[$i++]['file']= "&nbsp; + " . $secondKey;
			  else
			    $files[$i++]['file']="<a href='${baseurl}/${key}/${secondValue}'>--- " . $secondValue . "</a>";
			}
		    } else
		        $files[$i++]['file']="<a href='${baseurl}/${value}'>" . $value . "</a>";
                  }
                }
                return array('baseurl'=> $baseurl, 'file_entries' => $files);
	}	

	public function set_teacher($args = FALSE)
	{
	}
}
