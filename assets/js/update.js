$(document).ready(function(){
	update();

	$('#nav_update').hide();
	
	$('#delete a').on('click',function(){
		if(confirm('Do you want to delete?')){
			return true;
		}
		else{
			return false;
		}
	});

	$('.p_eye').click(function(){
		$(this).toggleClass('fa-eye fa-eye-slash');
		var eye_password = $('#password');
		if(eye_password.attr('type') === 'password'){
			eye_password.attr('type','text'); 
		}
		else{
			eye_password.attr('type','password');
		}
	});

	$('.cp_eye').click(function(){
		$(this).toggleClass('fa-eye fa-eye-slash'); 

		var eye_cpassword = $('#cpassword');
		if(eye_cpassword.attr('type') === 'password'){
			eye_cpassword.attr('type','text'); 
		}
		else{
			eye_cpassword.attr('type','password');
		}
	});

	$('select#country').on('change',function(e){
		e.preventDefault();
		var country_ID = $(this).val();
		state(country_ID);
	});

	$('select#state').on('change',function(e){
		e.preventDefault();
		var state_ID = $(this).val();
		city(state_ID);
	});

	$('#update').on('click',function(e){
		e.preventDefault();

		var id = $('#id').val();
		var name = $('#name').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var cpassword = $('#cpassword').val();
		var country = $('#country').val();
		var state = $('#state').val();
		var city = $('#city').val();

		var form = new FormData();
		form.append('id',id);
		form.append('name',name);
		form.append('email',email);
		form.append('password',password);
		form.append('cpassword',cpassword);
		form.append('country',country);
		form.append('state',state);
		form.append('city',city);

		$.ajax({
			url:'http://localhost/curl_api/api/curl/update_process',
			type:'post',
			// dataType:'json',
			contentType:false,
			processData:false,
			data:form,
			beforeSend:function(){
				//
			},
			success:function(response){
				var json = JSON.parse(response);
				if(json.status==1){
					window.location.replace('http://localhost/curl_api/api/curl/display');
				}
			},
			error:function(xhr, ajaxOptions, thrownError){
				console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
});

function load_country(){
	$.ajax({
		url:base_url + '/api/curl/country_data',
		type:'get',
		dataType:'json',
		beforeSend:function(){
			$('#country').find('option:eq(0)').html('Please Wait....')
		},
		success:function(data){
			// console.log(data.Country);
			var json = data.Country;
			var option = '';
			var value_id='';
						// option += '<option value="">Select Country</option>';
			for(var i=0; i<json.length; i++){
				option += '<option value="' + json[i].id + '">' + json[i].name + '</option>';
				if(user_country==json[i].name){
					value_id = json[i].id;
				}
			}
			$('#country').html(option);
			$('#country').val(value_id).trigger('change');
			$("#country option[value='"+value_id+"']").attr('selected','selected');
		},
		error:function(xhr,ajaxOptions,thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function state(country_ID){
	$.ajax({
		url:base_url + '/api/curl/state_data',
		type:'post',
		dataType:'json',
		contentType:'application/json',
		data:{country_id:country_ID},
		beforeSend(){
			$('select#state').find('option:eq(0)').html('Please Wait.....');
		},
		success:function(json){
			var json_data = json.State;			
			var option = '';
			var value_id='';
			option += '<option value="">Select State</option>';
			for(var k=0; k<json_data.length; k++){
				if(json_data[k].country_id==country_ID){
					option += '<option value="' + json_data[k].id + '">' + json_data[k].name + '</option>';
					if(user_state==json_data[k].name){
						value_id=json_data[k].id;
					}
				}
			}
			$('select#state').html(option);
			$('#state').val(value_id).trigger('change');
			$('#state option[value="'+value_id+'"]').attr('selected','selected');
		},
		error:function(xhr, ajaxOptions, thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function city(state_ID){
	$.ajax({
		url:base_url + '/api/curl/city_data',
		type:'post',
		dataType:'json',
		contentType:'application/json',
		data:{state_id:state_ID},
		beforeSend:function(){
			$('select#city').find('option:eq(0)').html('Please Wait....');
		},
		success:function(json){
			var json_data = json.City;
			var option = '';
			var value_id='';
			option +='<option value="">Select City:</option>';
			for(var i=0; i<json_data.length; i++){
				if(json_data[i].state_id==state_ID){
					option +='<option value="' + json_data[i].id + '">' + json_data[i].name + '</option>';
					if(user_city==json_data[i].name){
						value_id=json_data[i].id;
					}
				}
			}
			$('select#city').html(option);
			$('#city').val(value_id).trigger('change');
			$('#city option[value="'+value_id+'"]').attr('selected','selected');
		},
		error:function(xhr, ajaxOptions, thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function update(){
	$.ajax({
		url:'http://localhost/curl_api/api/curl/update_process',
		type:'post',
		dataType:'json',
		// data:form,
		beforeSend:function(){
			// $('select#city').find('option:eq(0)').html('Please Wait....');
		},
		success:function(response){
			var json = response.Detail;
			if(response.status==1){
				$('#id').val(json.id);
				$('#name').val(json.name);	
				$('#email').val(json.email);
	  			// $('#country').find(json.country).attr('selected','selected');
	  			// console.log(id);
	  			window.user_country=json.country;
	  			window.user_state=json.state;
	  			window.user_city=json.city;

	  			load_country();

				$('#password').val(json.password);
				$('#cpassword').val(json.cpassword);
			}
		},
		error:function(xhr, ajaxOptions, thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}