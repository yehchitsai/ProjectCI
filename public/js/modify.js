var URL = "http://" + $(location).attr('host')+ "/nas/index.php/register";

$(document).ready(function () {
	$("#plus").click(function () {
		btn_plus();
	});
	$("#submit").click(function () {
		btn_submit();
	});
	teacher();

});
function finish() {

	$project_name = $("#project_name").val();
	$project_teacher = $("#sel_teacher").val();
	$project_type = $("#project_type").val();
	$project_description = $("#project_description").val();
	$project_keyword = $("#project_keyword").val();
	$leader_name = $("#leader_name").val();
	$leader_number = $("#leader_number").val();
	$stu_name = "";
	$stu_num = "";
	$(".control_group").each(function () {

		$stu_name == "" ? $stu_name = $(this).find(".name").val() : $stu_name += "," + $(this).find(".name").val();
		$stu_num == "" ? $stu_num = $(this).find(".num").val() : $stu_num += "," + $(this).find(".num").val();

	});
	alert($project_teacher);
	var request = $.ajax({
			url : URL,
			type : "POST",
			data : {
				action : "finish",
				project_name : $project_name,
				project_teacher : $project_teacher,
				project_type : $project_type,
				project_description : $project_description,
				project_keyword : $project_keyword,
				leader_name : $leader_name,
				leader_number : $leader_number,
				stu_name : $stu_name,
				stu_num : $stu_num
			},
			dataType : "html"
		});
	request.done(function (data) {
		$("body").html(data);
		/*
		data = eval(data);
		$.each(data,function(i){
		$("#sel_teacher").append($("<option value ="+data[i].id+">"+data[i].name+"</option>"));
		});*/
	});
	request.fail(function (jqXHR, textStatus) {
		alert("Request failed: " + textStatus);
	});
}
function teacher() {
	var request = $.ajax({
			url : URL,
			type : "POST",
			data : {
				action : "teacher"
			},
			dataType : "html"
		});
	request.done(function (data) {
		data = eval(data);

		$.each(data, function (i) {
			$("#sel_teacher").append($("<option value =" + data[i].id + ">" + data[i].name + "</option>"));
		});
	});
	request.fail(function (jqXHR, textStatus) {
		alert("Request failed: " + textStatus);
	});

}
function checkdata() {

	$checksum = true;
	var $message = new Array(
			"不能為空白",
			"");
	var $checkElement = new Array(
			"p_name",
			"p_adviser",
			"p_keyword",
			"p_leader_name",
			"p_std_number");
	for ($i = 0; $i < $checkElement.length; $i++) {
		alert(1);
		$temp = showError($checkElement[$i], $message[0]);
		$checksum == false ? false : $temp;
	}
	return $checksum;
}
function showError($element, $message) {
	$checksum = true;
	$element = "." + $element;
	$input = $element + " input";
	if ($($input).eq(0).val().length == 0) //指導教授
	{
		$($element).addClass("error");
		$($element).children("div").children("span").html($message);
		$checksum = false;
	} else {
		$($element).removeClass("error");
		$($element).children("div").children("span").html("");
		$checksum = true;
	}
	if ($($input).length == 2) {
		if ($($input).eq(1).val().length == 0) //指導教授
		{
			$($element).addClass("error");
			$($element).children("div").children("span").html($message);
			$checksum = false;
		} else if ($($input).eq(1).val().length != 0 && $($input).eq(0).val().length != 0) {
			$($element).removeClass("error");
			$($element).children("div").children("span").html("");
			$checksum = true;
		}
	}

	return $checksum;
}
function start() {
	var request = $.ajax({
			url : "Controls/scan/mobile01Class.php",
			type : "POST",
			data : {
				action : "getSelect2",
				belong : $("select#mobile_c1").val()
			},
			dataType : "html"
		});
	request.done(function (data) {
		data = eval(data);
		$("#mobile_c2").append($("<input id='allSelect' type='button' value='選取所有' /><br/>"));
		$.each(data, function (i) {
			$("#mobile_c2").append($("<input class ='subClass' type='checkbox' value='" + data[i].id + "' />"))
			.append($("<span>" + data[i].title + "</span><br/>"));
		});
	});
	request.fail(function (jqXHR, textStatus) {
		alert("Request failed: " + textStatus);
	});
}
function btn_plus() {
	$max = 4;
	if ($("#memberGrpoup>div").length < $max) {
		$member = $("#memberGrpoup>div").eq(0);
		$member = $member.clone();
		$member.children(".controls").children(".name").val("");
		$member.children(".controls").children(".num").val("");
		$("#memberGrpoup").append($member);
	} else {
		alert("組員最多" + $max + "位");
	}
}
function btn_submit() {
	var passval = pass();

	if (passval == 0) {
		finish();
		//alert('pass');
	}

	//finish();
	/*if(checkdata())
{
	finish();
	}
	else
{
	alert("請修正錯誤");
	}*/
}

function pass() {
	var pass = 0;
	pass += $('#project_name').val().trim() != '' ? message($('.p_name .help-inline'), '') : message($('.p_name .help-inline'), '不能為空');
	pass += $('#sel_teacher').val() >= 1 ? message($('.p_adviser .help-inline'), '') : message($('.p_adviser .help-inline'), '必須選擇');
	pass += $('#project_type :selected').text() != '請選擇' ? message($('.p_type .help-inline'), '') : message($('.p_type .help-inline'), '必須選擇');
	pass += $('#project_description').val().trim() != '' ? message($('.p_description .help-inline'), '') : message($('.p_description .help-inline'), '不能為空');
	pass += /^[^,]{1,}(,[^,]+)*$/.test($('#project_keyword').val()) ? message($('.p_keyword .help-inline'), '') : message($('.p_keyword .help-inline'), '不能為空');
	pass += $('#leader_name').val().trim() != '' ? message($('.p_leader_name .help-inline'), '') : message($('.p_leader_name .help-inline'), '不能為空');
	pass += /^(A[\d]{2}28[\d]{3})$/.test($('#leader_number').val()) ? message($('.p_leader_name .help-inline'), '') : message($('.p_leader_name .help-inline'), '姓名&學號 不能為空 且學號皆為大A');

	$('.p_std_number').each(function () {
		pass += $('.name', this).val().trim() != '' && /^(A[\d]{2}28[\d]{3})$/.test($('.num', this).val()) ? message($('.help-inline', this), '') : message($('.help-inline', this), '姓名&學號 不能為空 且學號皆為大A');
		//pass += /^(A[\d]{2}28[\d]{3})$/.test($('.num', this).val()) ? message($('.help-inline', this), '') : message($('.help-inline', this), '不能為空');
	});

	return pass;
}

function message(selector, message) {
	selector.text(message);
	return message == '' ? 0 : 1;
}
