$(document).ready(function(){
	var log_id =0;
	poll();
	console.log('poll...1');
 
	function poll(){
		var CIURL="http://" + $(location).attr('host')+ "/nas/index.php/LogData?log_id=" + log_id
		console.log('poll...'+CIURL);
		$.ajax({
			url:  CIURL,
			async: true,
			dataType: "json",
			timeout: 1000000,
			success: function(data){
				console.log('poll...success');
		// update data
				if (data.update=='1') {
					log_id = data.log_id;
					var i = 0;
					var JData = data.data;
					console.log('hello...' + log_id);
					$("#JSON_table").prepend('<tr><td colspan="4"><hr></td></tr>');
					$.each(JData, function() {
			//			$("#JSON_table").append("<tr>" +
						$("#JSON_table").prepend("<tr>" +
							"<td>" + JData[i].log_type   + "</td>" +
							"<td>" + JData[i].log_message    + "</td>" +
							"<td>" + JData[i].log_user_agent + "</td>" +
							"<td>" + JData[i].log_date + "</td>" +
							"</tr>");
						i++;
					});
					$("#JSON_table").prepend('<tr><td>log_type</td><td>log_message</td><td>log_user_agent</td><td>log_date</td></tr>');

		//     $('#php_log').text($('#php_log').text() + data.data);
				}
			},
			complete: function() {
				console.log('poll...complete');
				setTimeout(
					poll, /* Request next message */
					1000 /* ..after 1 seconds */
				);
			}
		}); // end of .ajax
	} // end of poll
});//end of ready