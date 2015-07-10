<?php

	$dbhost = '127.0.0.1';
	$dbuser = 'jeff';
	$dbpass = 'jeff0115';
	$dbname = 'career';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
	mysql_query("SET NAMES 'utf8';");
	mysql_select_db($dbname);

	$update = 1;
	$log_id=$_GET['log_id'];
	$response = new stdClass();
	
	for ($i = 0, $timeout = 180; $i<$timeout; $i++ ) {

		$SQL = "SELECT * FROM system_log WHERE log_id > $log_id ORDER by log_id limit 100";
		$result = mysql_query($SQL) or die("Couldn't execute query.".mysql_error());
		$row_num = mysql_num_rows($result);
		if($row_num == 0){
			$update=0;
		} else {
			//$row_num = $row_num1 ;
			$j=0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
				$data[$j++] = $row;
				$log_id = $row['log_id']; 
			}
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

?>