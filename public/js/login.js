var URL = "http://" + $(location).attr('host')+ "/nas/index.php/login";
var NASURL = "http://" + $(location).attr('host')+ "/nas/index.php/rest_auth";
//var NASURL = "http://127.0.0.1/nas/index.php/rest_auth";

$(document).ready(function(){
	var qry_str='/student/format/json';
	$("#submit").click(function(){
		if($("#select").val()=="0" || $("#account").val() == "" || $("#password").val() == "")
		{
			alert("請輸入完整資料!!");
		}
		else {
			//window.sessionStorage["id"] = $("#account").val();
			console.log(qry_str);
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
	$("#select").change(function(){

		switch($("#select").val())
		{
			case '1':
				qry_str="/teacher/format/json";
				break;
			case '2':
				qry_str="/student/format/json";
				break;
		}
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
//	data = jQuery.parseJSON("[" + data + "]");
	data = jQuery.parseJSON(data);
	if(data.auth =='success'){
		debug('success')
		switch($("#select").val())
		{
			case '1':
				url_str="query";
				alert("老師身分");
				window.location.assign = url_str;
		        href_load(url_str);
				break;
			case '2':
				if(data.member == 0)
					{
						url_str="register";
						alert("無註冊資料");
						window.location.assign = url_str;
						href_load(url_str);
					}else{
						//data = jQuery.parseJSON(data);					
						if(data.member[0].isLeader == 2){
							debug("組長");
							//var answer = confirm ("組長是/否進行專題修改?");
						//	var answer = 0;
							//if (answer){
								url_str="register";
								window.location.assign = url_str;
								href_load(url_str);
							/*}else{
								url_str="project_info";
								window.location.assign = url_str;
								href_load(url_str);								
							}*/
						}
						else if(data.member[0].isLeader == 1){
							debug("組員");		
							url_str="project_info";
							window.location.assign = url_str;
							href_load(url_str);									
						}
					}
/*				a = {a_value:$("#account").val()};
				var request = $.ajax({
					url: URL,
					type: "POST",
					data: a,
					dataType: "html"
				});
				request.done(function(data) {
					if(data == 0)
					{
						url_str="register";
						alert("無資料");
						window.location.assign = url_str;
						href_load(url_str);
					}else{
						data = jQuery.parseJSON(data);					
						if(data[0].isLeader == 1){
							alert("組長");
							var answer = confirm ("是/否進行專題修改?");
							if (answer){
								url_str="modify";
								window.location.assign = url_str;
								href_load(url_str);
							}else{
								url_str="project_info";
								window.location.assign = url_str;
								href_load(url_str);								
							}
						}
						else if(data[0].isLeader == 2){
							alert("組員");		
							url_str="project_info";
							window.location.assign = url_str;
							href_load(url_str);									
						}
					}
				});
				request.fail(function(jqXHR, textStatus) {
					alert( "ajax2 : " + textStatus );
				});
*/				
				break;
		}
		
		
	} else {
		alert("login fail");
	}
	debug(data);
}

