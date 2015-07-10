<?php
//[php] 利用 curl 來抓取網頁結果
	include ('func_curl.php');//functuin 區
	//驗證帳號、密碼
/*	
//	$Name   = '094381';
	$Name   = $_POST['user_id'];
//	$password   = 'lowew4127';
	$password   = $_POST['password'];
*/	
	//設定header區的用戶代理
	$UA = 'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1';
	
/*
$url = 設定截取網址, 
$post_data = 傳遞的值, 
$headers = HTTP標頭字段的設置
*/
	$headers = array (
	$UA,
	);	
/*
	$host = "https://search.kh.usc.edu.tw";
	$path = "/TerSystem/Process.asp";
	$url = $host . $path;
	$post_data = "user_id=$Name&password=$password";
	
	debug('<pre>');
	$response = post_https($url, $post_data,$headers,$http_status);
	debug($http_status);
	debug($response);
	if( $response !=NULL && $http_status=='302') //檢查是否通過認證
	{
		$pos = strpos(RequestSplite($response,'Location'), 'rdurl');
		if ($pos !== false) {
			$auth='success';
		} else {
			$auth='false';
		}
	}
	//RequestSplite方法 = HTTP Request 取的個別屬性的值
	$url = $host . RequestSplite($response,'Location');
	$cookie = RequestSplite($response,'Set-Cookie');
	$headers = array (
	$UA,
	"Cookie: $cookie",
	"Cache-control: max-age=3600"
	);	
	debug($url . "\n"); 
	debug($cookie . "\n");
//	var_dump($headers);

	$response = get_https($url,$headers);
	debug($response);
	if( $response !=NULL)
	{
		$url = RequestSplite($response,'Location');
		$cookie2 = RequestSplite($response,'Set-Cookie');
		$headers = array (
		$UA,
		"Cookie: $cookie; $cookie2",
		"Cache-control: no-cache"
		);	
		$response = get_https($url,$headers);
		$auth='success';
		//var_dump($response);
		debug($response);
		debug('\n</pre>\n');
		
	}
	//else
		 //echo "<script>alert ('Error!'); window.history.go(-1);</script>";
*/
?>
