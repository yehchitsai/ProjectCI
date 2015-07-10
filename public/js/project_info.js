var URL = "http://" + $(location).attr('host')+ "/nas/index.php/checkpwd";
var NASURL = "http://" + $(location).attr('host')+ "/nas/index.php/rest_auth";

$(document).ready(function(){
	var qry_str='/student/format/json';
	$(document).ready(function(){	
		$("#submit").click(function(){
			if($("#account").val() == "" && $("#password").val() == "" ){
				alert( "請輸入完整資料!!");
			} else {
				window.sessionStorage["id"] = $("#account").val();
				var request = $.ajax({
					url: NASURL+qry_str,
					type: "POST",	
					cache: false,
					crossDomain: true,
					success: onSuccess,
					error: onError,			
					data: {
						user_id:$("#account").val(),
						password:$("#password").val()
					},
					contentType: "application/x-www-form-urlencoded; charset=utf-8",
					dataType: "html"
				});				

			}
		});	//http://127.0.0.1/nas/index.php/RESTAPI/auth/format/json
		/*$("#select").change(function(){
			$("#id").show();
			switch($("#select").val())
			{
				case '1':
					qry_str="/student/format/json";
					break;
				case '2':
					qry_str="/student/format/json";
					break;
				case '3':
					$("#id").hide();
					qry_str="/employer/format/json";
					break;
			}
		});*/
	});
		
	$("#li_search").click(function(){
		var url = $(this).attr("value");
		href_load(url);
	});
	
	$("#callAjaxForm").submit(function(){
//		alert("#callAjaxForm");
        select();
		return false;
    });
	
 	
});
function debug(a)
{
	console.log(a);
}

function href_load(url) { //解決無法直接使用href屬性的問題
	location.href= url;
}

function onError(data, status)
{
	alert(data);
} 

function onSuccess(data, status)
{
	debug(data);
//	console.log(data)
/*
	data = jQuery.parseJSON(data);
	if(data.auth =='success'){
		
				url_str="register.php";
				//break;
		
		window.location = url_str;
//		href_load('search.html');
	} else {
		alert("login fail");
	}
	debug(data);
*/	
}
