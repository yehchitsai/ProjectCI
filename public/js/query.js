var URL = "http://" + $(location).attr('host')+ "/nas/index.php/query";
console.log(URL);
$(document).ready(function(){
	var $selec=1;
    $('#sds').dropdown();
    $("#selects li").click(function(){
        var placeholders = new Array(4)
        placeholders[0] = "請輸入關鍵字"
        placeholders[1] = "請輸入指導教授"
        placeholders[2] = "請輸入專題名稱"
        placeholders[3] = "請輸入級別"
        placeholders[4] = "學生姓名"
        $selec = $(this).find("a").attr("se");
        $("#appendedDropdownButton").attr("placeholder",placeholders[$selec-1]);
        $("#appendedDropdownButton").attr("se",$selec);
      test(parseInt($selec));
    });
    $("#appendedDropdownButton").next().next().click(function(){
        select($selec);
    });
});

function test(a)
{
	console.log(a);
}
function createTable(data)
{
	for($i = 0; $i< data.length;$i++)
	{
		$tr = "<tr class= 'qu'>";
		$td1 = "<td>"+($i+1)+"</td>";
//		$td1 += "<td><a href = '/nas_directory/"+data[$i].p_leader_number+"' >"+data[$i].p_name+"</a></td>";
		$td1 += "<td><a href = 'http://163.15.192.185/nas/index.php/nas_directory?sid="+data[$i].p_leader_number+"' >"+data[$i].p_name+"</a></td>";
		$td2 = "<td>"+data[$i].p_adviser+"</td>";
		$td3 = "<td>"+data[$i].p_description+"</td>";
		$td4 = "<td>"+data[$i].p_leader_name+"</td>";
		$td5 = "<td>"+data[$i].proj_members+"</td>";
		$td6 = "<td>"+data[$i].enter_year+"</td>";
		$td7 = "<td>"+data[$i].p_date+"</td>";
		$tr += $td1+$td2+$td3+$td4+$td5+$td6+$td7+"</tr>";
		$("#result").append($tr);
	}
}

function select(selec)
{
	test(selec);
	var d;
	switch(parseInt(selec))
    {
		case 1://keyword
			d = {
                action:"keyword",
                k_value:$("#appendedDropdownButton").val()
            };
			test("keyword");
			break;
		case 2://professor
			d = {
                action:"teacher",
                p_adviser:$("#appendedDropdownButton").val()
            };
			break;
		case 3://project
			d = {
                action:"project",
                p_name:$("#appendedDropdownButton").val()
			};
			break;
		case 4://enter_year
			d = {
                action:"enter_year",
                k_value:$("#appendedDropdownButton").val()
            };
			break;		
		case 5://student name
			d = {
                action:"student",
                k_value:$("#appendedDropdownButton").val()
            };
			break;		
	}
	test(d);
	var request = $.ajax({
            url: URL,
            type: "POST",
            data: d,
            dataType: "html"
        });
        request.done(function(data) {
            if(data == 0)alert("無資料");
            else{
           
                $("#result tr.qu").remove();
				//console.log(data);
//                data = eval(data);
				data = jQuery.parseJSON(data)
				createTable(data);			
            }   
        });
        request.fail(function(jqXHR, textStatus) {
            alert( "ajax2 : " + textStatus );
        });
}

