<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>實踐大學資管系 數位典藏系統</title>
		<link rel="stylesheet" type="text/css" href="{baseURL}public/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="{baseURL}public/css/master.css" />
		<link rel="stylesheet" type="text/css" href="{myAppCSS}" />

		<script type="text/javascript" src="{baseURL}public/js/jquery/jquery-1.10.2.min.js"></script> 
		<script type="text/javascript" src="{baseURL}public/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{myAppJS}"></script>

	</head>
	<body>

		<div id="wrapper" class ="container">
			<div id ="logo"></div>   
			<div id="header">
				<div id="userName"></div>
				<div id="ProTitle"></div>			
			</div>
			<div id ="menu">
				<ul>
				<li><a href ="{baseURL}index.php/welcome/query">專題搜尋</a></li>
				<li><a href ="{baseURL}index.php/welcome/login">專題註冊／修改</a></li>
				<li><a href ="{baseURL}index.php/welcome/logout">{logout}</a></li>
				</ul>
			</div>    
			<div id="content">{content}</div>
			<div id="footer"></div>
		</div>
	</body>
</html>
