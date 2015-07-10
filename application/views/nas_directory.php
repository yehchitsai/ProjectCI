<!DOCTYPE html>
<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>實踐大學資管系 數位典藏系統</title>
<script type="text/javascript" src="/nas/public/js/jquery/jquery-1.10.2.min.js"></script>
<script>
	$(document ).ready(function() {
		$("#backLink").click(function(event) {
			event.preventDefault();
			history.back(1);
		});
	  });
</script>

   <style> 
     body{
        background-color:#F5F5F5;
     }
     #wrapper{
       width:1000px;
       margin:60px auto;
         margin-top:60px;
         margin-right:auto;
         position:relative;
         background:#fff;
          background-image:initial;
          background-position-x:initial;
          background-position-y:initial;
          background-size:initial;
       padding-right:15px;
       padding-left:15px:   
     }
     #header{
      position:relative;
     }
     #protitle{
      padding:40px;
      font-size:3em;
     }
     #content{
      width:960px;
      padding:10px; 
     }
     .well{ 
      min-height:20px;
      padding:19px;
      margin-bottom:20px;
      background-color:#F5F5F5;
     }
     #logo{
       width: 250px;
       height: 70px;
       border: 1px solid #ccc;
        border-top-color:rgb(204,204,204);
        border-top-style:solid;
        border-top-width:1px;
       position:absolute;
       top:-30px;
       left:20px;
       background-image:url('/nas/public/css/Img/logo.jpg');
     }
     #menu{
      min-height:60px;
      position:absolute;
      top:20px;
      right:650px;
     }
     a{
      color:#428bca;
      text-decoration:none;
     }
   </style>
 </head>
 <body>
  <div id="wrapper" class="container">
   <div id="logo"></div>
    <div id="header">
     <div id="protitle"></div>
   </div>
   <div id="menu">
      <a href="#" id="backLink">Back</a>
<!--      <a href="" onclick="window.history.back()">Back</a> -->
   </div>
    <div id="content">
    <div class="well"> 
    <p>專題資訊</p>
    <hr>
    <UL>
     {file_entries}
     <li>{file}</li>
     {/file_entries}		
    </UL>
    </div>
   </div>
  </div>
 </body>
</html>		
