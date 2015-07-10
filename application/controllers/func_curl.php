<?php
//debug
	function debug($str)
	{
		log_message('debug',htmlspecialchars($str));
		//echo($str);
	}
/*把HTTP Request分成array*/
	function RequestSplite($response, $attr)
	{	
		debug( 'RequestSplite<br/>');
		$check = false;
		$stack = array();
		$response_array = array();
		$str_response = str_replace("\r\n", ": ", $response); 
		$str_response = explode(": ",$str_response);
		foreach($str_response as $index=>$value){
			array_push($stack,$value);
		}
		$response_array['HTTP'] = $stack[0];
		
		for($i=1;$i < count($stack)-2;$i+=2){
			if($stack[$i] != ' '){
				if($stack[$i] == $attr)
					$check = true;
				$response_array[$stack[$i]] = $stack[$i+1];
			}
		}
		
		if($check)
			return $response_array[$attr];
		if(!$check)
			return NUll;
	}
/*
$url = 設定截取網址, 
$post_data = 傳遞的值, 
$headers = HTTP標頭字段的設置
*/
	function post_https($url, $post_data, $headers, &$http_status)
	{
		//初始化一個curl
		$ch = curl_init(); 

		//設定截取網址
		curl_setopt($ch, CURLOPT_URL , $url);
				
		//將結果回傳成字串 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1); 
		
		//自動設置header中的referer信息		
		curl_setopt($ch, CURLOPT_AUTOREFERER , true);
		
		//設置curl允許執行的最長秒數
		curl_setopt($ch, CURLOPT_TIMEOUT , 80); 
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//FALSE to stop cURL from verifying the peer's certificate. Alternate certificates to verify against can be specified with the CURLOPT_CAINFO option or a certificate directory can be specified with the CURLOPT_CAPATH option.
		
		/*CURLOPT_SSL_VERIFYHOST
		1.檢查是否存在一個共同的名字在同行的SSL證書。
		2.檢查是否存在一個共同的名字，也驗證了它提供的主機名匹配。
		may also need to be TRUE or FALSE if CURLOPT_SSL_VERIFYPEER is disabled (it defaults to 2).TRUE by default as of cURL 7.10. Default bundle installed as of cURL 7.10.
		*/
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

		curl_setopt($ch, CURLOPT_HEADER, true);	//是否截取header的資訊 return headers
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set headers to above array
		curl_setopt($ch, CURLOPT_VERBOSE, true); // Display communication with server
		
		
		curl_setopt($ch, CURLOPT_POST , 1); 
		//TRUE to do a regular HTTP POST. This POST is the normal application/x-www-form-urlencoded kind, most commonly used by HTML forms.
		
		//用POST方式傳遞的值
		curl_setopt($ch, CURLOPT_POSTFIELDS , $post_data ); 
		
		$xml_response = curl_exec($ch); 
		$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//echo $http_status;
		curl_close($ch);
		return $xml_response;
	}
	
	function get_https($url, $headers)
	{
		$session = curl_init();
		curl_setopt($session, CURLOPT_URL, $url); // Oops - wrong URL for API
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); // Set headers to above array
		
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
		//FALSE to stop cURL from verifying the peer's certificate. Alternate certificates to verify against can be specified with the CURLOPT_CAINFO option or a certificate directory can be specified with the CURLOPT_CAPATH option.
		curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
		
		curl_setopt($session, CURLOPT_HEADER, true); // Display headers
		curl_setopt($session, CURLOPT_VERBOSE, true); // Display communication with server
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // Return data instead of display to std out
		$xml_response = curl_exec($session);
		curl_close($session);
 
		return $xml_response;
	}
?>