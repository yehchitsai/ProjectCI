var URL = "http://" + $(location).attr('host')+ "/nas/index.php/register";
var member_tmp, award_tmp;
/*
$.getScript("commonFunc.js", function(){
   debug("Script loaded and executed.");
   // Here you can use anything you defined in the loaded script
});
*/
function debug(msg){
	console.log(msg);
}

$(document).ready(function () {
	$("#plus").click(function () {
		btn_plus();
	});
	$(".minus").on('click',function () {
		console.log($(this).parent().parent().get(0).className);
		member_tmp = $(this).parent().parent(); //將資料暫存起來
		$(this).parent().parent().remove();
	});
	$(".a_minus").on('click',function(){
		console.log($(this).parent().parent().get(0).className);
		award_tmp = $(this).parent().parent(); //將資料暫存起來
		$(this).parent().parent().remove();
	});	
	$("#plus_a").click(function () {
//		console.log('award_plus');
		award_plus();
	});	
	$(".award_type").change(function() { selectType($(this)); });
	
	$("#submit").click(function () {
		btn_submit();
	});
	console.log(URL);
	teacher();
	
	
	
});
function selectType(self)
{
	if(self.val()=='論文')
		self.next().attr("placeholder",'黃冠雅、葉期財，"透過大專電子學習歷程進行人才推薦之行動應用"，第八屆數位教學暨資訊實務研討會(EITS 2013)，台南市，3月27日, 2013。');
	else
		self.next().attr("placeholder","2013第六屆全國行動通訊專題創意競賽，榮獲佳作，主辦單位：龍華科技大學工程學院, Taiwan, R.O.C.");
}

function finish() {
	project_year = $("#project_year").val();
	project_name = $("#project_name").val();
	project_teacher = $("#sel_teacher").val();
	project_type = $("#project_type").val();
	project_description = $("#project_description").val();
	project_keyword = $("#project_keyword").val();
	leader_name = $("#leader_name").val();
	leader_number = $("#leader_number").val();
//	award_type = $("#award_type").val();
//	a_name = $("#a_name").val();
	stu_name = "";
	stu_num = "";
	$(".control_group").each(function () {

		stu_name == "" ? stu_name = $(this).find(".name").val() : stu_name += "," + $(this).find(".name").val();
		stu_num == "" ? stu_num = $(this).find(".num").val() : stu_num += "," + $(this).find(".num").val();
		//awardfile = $(this).find("#award").val();
		console.log("stu_name = " + stu_name);
	});
	console.log("stu_name = '" + stu_name + "'");
//	alert($project_teacher);
	var data = new FormData();
	if(projData=='')
		data.append('action','finish');
	else {
		data.append('action','update');
		data.append('p_id',projData[0]['p_id']);
	}

	data.append('project_year',project_year);
	data.append('project_name',project_name);
	data.append('project_teacher',project_teacher);
	data.append('project_type',project_type);
	data.append('project_description',project_description);
	data.append('project_keyword',project_keyword);
	data.append('leader_name',leader_name);
	data.append('leader_number',leader_number);
	data.append('stu_name',stu_name);
	data.append('stu_num',stu_num);
//	data.append('award_type',award_type);
//	data.append('a_name',a_name);

//上傳多筆得獎紀錄	
	for(var i=0; i < $('.award').length;i++){
		file = $('.award')[i].files[0];
		console.log('file- ' + i + " - " + file);
		console.log('專題成果類型- ' + $(".award_type")[i].value);
		//var a_name = $(".a_name").get(i);
		console.log('專題id- '+ $(".award_id")[i].value);
		data.append('award_id'+i,$(".award_id")[i].value); //專題成果id
		console.log('成果名稱- ' + $(".a_name")[i].value);
		data.append('award_type'+i,$(".award_type")[i].value); //專題成果類型
		data.append('a_name'+i,$(".a_name")[i].value);		//成果名稱
		data.append('awardfile'+i, file);	//成果檔案
	}
/*
	jQuery.each($('.award')[0].files, function(i, file) {
		console.log('file- ' + i + " - " + file);
		data.append('awardfile', file);
	});	
*/

	var request = $.ajax({
			url : URL,
			type : "POST",
			data : data,
			contentType: false,
			processData: false,			
		});
		
	request.done(function (data) {
		alert("註冊完畢，可選擇繼續修改還是直接查詢");
		location.href= "http://163.15.192.185/nas/index.php/welcome/project_info"
//		$("body").html(data);
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
		var data = eval(data);
		console.log('teacher done');
//取得老師紀錄		
		$.each(data, function (i) {
			$("#sel_teacher").append($("<option>" + data[i].name + "</option>"));
//			$("#sel_teacher").append($("<option value =" + data[i].id + ">" + data[i].name + "</option>"));
		});
//設定專題資料	
		if(projData!=''){
			var data = projData[0];
			$("#project_year").val(data['enter_year']);
			$("#project_name").val(data['p_name']);
		//	$("#sel_teacher").value = data['p_adviser'];
			$("#sel_teacher").val(data['p_adviser']);
		//	$("#sel_teacher").val();
			$("#project_type").val(data['p_type']);
			$("#project_description").val(data['p_description']);
			$("#project_keyword").val(data['keyword']);
			$("#leader_name").val(data['p_leader_name']);
			//因組長學號與儲存目錄相關，故不允許修改
			$("#leader_number").val(data['p_leader_number']).attr('readonly',true);	
//取得組員資料	
/*
			var output = '';
			for (var property in data['members']) {
				//output += property + ': ' + Array[property].s_name+'; ';
				for (var pro in Object[property])
					output += pro + ': ' + Object[pro]+'; ';
			}
*/			
			$.each(data['members'], function(idx, obj) {
				if(idx>0) btn_plus();
				member = $("#memberGrpoup>div").eq(idx);
				member.children(".controls").children(".name").val(obj.s_name);
				member.children(".controls").children(".num").val(obj.s_id).attr('readonly',true);				

			});
/*
			console.log(output);
			var d = new Array(data['members']);
			console.log("the number of members is " + data.members.length);
			//d = eval(data['members']);
			//console.log("the number of members is " + d.length);
			for(i = 0; i< d.length;i++) {
				if(i>0) btn_plus();
				member = $("#memberGrpoup>div").eq(i);
				member.children(".controls").children(".name").val(data['members'][i].s_name);
				member.children(".controls").children(".num").val(data['members'][i].s_id);			
			}
*/			
//取得比賽資料
			$.each(data['awards'], function(idx, obj) {
				if(idx>0) award_plus();
				debug("取得比賽資料"+ idx);
				award = $(".control_group_a").eq(idx);
				award.children(".controls").children(".award_type").val(obj.a_type);
				award.children(".controls").children(".a_name").val(obj.a_name);
				award.children(".controls").children(".award_id").val(obj.a_id);
				if(obj.a_url)
					award.children(".controls").children(".help-inline").html('<a target="_blank" href="http://' + $(location).attr('host') + '/nas/upload/' + obj.a_url +'">view uploaded file</a>');

			});			
		}
	});
	request.fail(function (jqXHR, textStatus) {
		alert("Request failed: " + textStatus);
	});

}

function btn_plus() {
	var max = 4;
	var member_num = $("#memberGrpoup>div").length;

	if (member_num < max) {
		if(member_num==0)
			member = member_tmp;
		else
			member = $("#memberGrpoup>div").eq(0);
		member = member.clone();
		member.children(".controls").children(".name").val("");
		member.children(".controls").children(".num").val("").attr('readonly',false);
		$("#memberGrpoup").append(member);
		$(".minus").eq(member_num).on('click',function(){
			console.log(member.get(0).className);
			$(this).parent().parent().remove();
		});
		console.log(member.get(0).className);
	} else {
		alert("組員最多" + max + "位");
	}
}

function award_plus() {
	var award_num = $(".control_group_a").length;
	if(award_num==0)
		award = award_tmp;
	else
		award = $(".control_group_a").eq(0);
//	console.log(award.html());
	award = award.clone();
	award.children(".controls").children(".a_name").val("");
	award.children(".controls").children(".award").val("");
	award.children(".controls").children(".help-inline").text("");
	$("#awardGrpoup").append(award);
	var award_len = $(".control_group_a").length;
	$(".a_minus").eq(award_len-1).on('click',function(){
		console.log($(this).parent().parent().get(0).className);
		$(this).parent().parent().remove();
	});
	$(".award_type").eq(award_len-1).on('change',function(){
		if($(this).val()=='論文')
			$(this).next().attr("placeholder",'黃冠雅、葉期財，"透過大專電子學習歷程進行人才推薦之行動應用"，第八屆數位教學暨資訊實務研討會(EITS 2013)，台南市，3月27日, 2013。');
		else
			$(this).next().attr("placeholder","2013第六屆全國行動通訊專題創意競賽，榮獲佳作，主辦單位：龍華科技大學工程學院, Taiwan, R.O.C.");	
	});
	
	console.log(".control_group_a " + award_len);	
}
function btn_submit() {
	var passval = pass();
//	var passval =0;
	if (passval == 0) {
		finish();
		//alert('pass');
	}
}

function pass() {
	var pass = 0;
	pass += $('#project_name').val().trim() != '' ? message($('.p_name .help-inline'), '') : message($('.p_name .help-inline'), '不能為空');
	pass += $('#sel_teacher').val().length > 1 ? message($('.p_adviser .help-inline'), '') : message($('.p_adviser .help-inline'), '必須選擇');
	pass += $('#project_type :selected').text() != '請選擇' ? message($('.p_type .help-inline'), '') : message($('.p_type .help-inline'), '必須選擇');
	pass += $('#project_description').val().trim() != '' ? message($('.p_description .help-inline'), '') : message($('.p_description .help-inline'), '不能為空');
	pass += /^[^,]{1,}(,[^,]+)*$/.test($('#project_keyword').val()) ? message($('.p_keyword .help-inline'), '') : message($('.p_keyword .help-inline'), '不能為空');
	pass += $('#leader_name').val().trim() != '' ? message($('.p_leader_name .help-inline'), '') : message($('.p_leader_name .help-inline'), '不能為空');
	pass += /^(A[\d]{2}28[\d]{3})$/.test($('#leader_number').val()) ? message($('.p_leader_name .help-inline'), '') : message($('.p_leader_name .help-inline'), '姓名&學號 不能為空 且學號皆為大A');

	$('.p_std_number').each(function () {
		pass += $('.name', this).val().trim() != '' && /^(A[\d]{2}28[\d]{3})$/.test($('.num', this).val()) ? message($('.help-inline', this), '') : message($('.help-inline', this), '姓名&學號 不能為空 且學號皆為大A');
		//pass += /^(A[\d]{2}28[\d]{3})$/.test($('.num', this).val()) ? message($('.help-inline', this), '') : message($('.help-inline', this), '不能為空');
	});
	$('.p_award').each(function () {
		pass += $('.a_name', this).val().trim() != '' ? message($('.help-inline', this), '') : message($('.help-inline', this), '專題成果說明不能為空');
		if(projData=='') {//修改不需指定檔案
			pass += $('.award', this).val().trim() != '' ? message($('.help-inline2', this), '') : message($('.help-inline2', this), '專題檔案沒有選擇');
		}
		//console.log($('.award').val());
	});
	return pass;
}

function message(selector, message) {
	selector.text(message);
	return message == '' ? 0 : 1;
}
