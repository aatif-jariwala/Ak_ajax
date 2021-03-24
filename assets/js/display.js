$(document).ready(function(){

	$('#nav_display').hide();

	$('#delete a').on('click',function(){
		if(confirm('Do you want to delete?')){
			return true;
		}
		else{
			return false;
		}
	});
	$.ajax({
		url:base_url + 'api/curl/displaydata',
		type:'get',
		dataType:'json',
		beforeSend:function(){
			//
		},
		success:function(response){
			if(session == true){
				var json = response.Detail;
				display = '<tr>'
							+'<td>' + json.id + '</td>'
							+'<td>' + json.name + '</td>'
							+'<td>' + json.email + '</td>'
							+'<td>' + json.country + '</td>'
							+'<td>' + json.state + '</td>'
							+'<td>' + json.city + '</td>'
							+'<td>' + json.password + '</td>'
							+'<td>' + json.cpassword + '</td>'
						+'</tr>';
				$('#data').after(display);
				$('#update a').attr('href',"update?id="+json.id);
				$('#delete a').attr('href',"delete?id="+json.id);
			}
			else{
				var json = response.details;
				// console.log(json);
				var table='';
				for(var i=0; i<json.length; i++){
					table += '<tr>'
								+'<td>' + json[i].id + '</td>'
								+'<td>' + json[i].name + '</td>'
								+'<td>' + json[i].email + '</td>'
								+'<td>' + json[i].country + '</td>'
								+'<td>' + json[i].state + '</td>'
								+'<td>' + json[i].city + '</td>'
								+'<td>' + json[i].password + '</td>'
								+'<td>' + json[i].cpassword + '</td>'
							+'</tr>';
				}
				$('#table_row').after(table);
			}
		},
		error:function(xhr,ajaxOptions,thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

});

