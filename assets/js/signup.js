$(document).ready(function(){

	$('#nav_signup').hide();

	// load for country
	load_country();

	// change event for state
	$('#country').on("change",function(e){
		e.preventDefault();
		var country_id = $(this).val();
		state(country_id);
	});

	// change event for city
	$('#state').on('change',function(e){
		e.preventDefault();
		var state_id = $(this).val();
		city(state_id);
	});

	// click event for submit button
	$('#signup').on('click',function(e){	
		e.preventDefault();

		var name = $('#name').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var cpassword = $('#cpassword').val();
		var country = $('#country').val();
		var state = $('#state').val();
		var city = $('#city').val();

		var form = new FormData();
		form.append('name',name);
		form.append('email',email);
		form.append('password',password);
		form.append('cpassword',cpassword);
		form.append('country',country);
		form.append('state',state);
		form.append('city',city);

		function display_message(){
			$('.message').css('display','flex');
			$('#close').click(function(){$('.message').fadeOut(500);});
			$('#close').html('&#x2716;');
		}

		if(name.length == ''){
			display_message();
			$('#demo').text('Please Enter Name');
		}
		else if(email.length == ''){
			display_message();
			$('#demo').text('Please Enter email');
		}
		else if(password.length == ''){
			display_message();
			$('#demo').text('Please Enter password');
		}
		else if(cpassword.length == ''){
			display_message();
			$('#demo').text('Please Enter confirm password');
		}
		else if(!(password == cpassword)){
			display_message();
			$('#demo').text('Password Do Not Match');
		}
		else if(country.length == ''){
			display_message();
			$('#demo').text('Please Enter country');
		}
		else if(state.length == ''){
			display_message();
			$('#demo').text('Please Enter state');
		}
		// else if(city.length == ''){
		// 	$('#demo').text('Please Enter city');
		// }
		else{
			signup(form);
		}
	});

});

function signup(form){
	$.ajax({
		url:'http://localhost/curl_api/api/curl/signup',
		// url:base_url +'/api/curl/signup',
		type:'post',
		// dataType:'json',
		contentType:false,
		processData:false,
		data:form,
		beforeSend:function(){
			//
		},
		success:function(json){
			// console.log('hello');
			var encode = JSON.parse(json);
			
			// alert(json);
			if(encode.status == 0){
				$('#demo').text(encode.message);
			}
			else{
				$('#demo').text('Signup Successfull');
			}
			// console.log(encode.status);
		},
		error:function(xhr,ajaxOptions,thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function load_country(){
	$.ajax({
		url:'http://localhost/curl_api/api/curl/country_data',
		type:'get',
		dataType:'json',
		beforeSend:function(){
			$('#country').find('option:eq(0)').html('Please Wait....')
		},
		success:function(data){
			// console.log(data.Country[0]);
			var json = data.Country;
			
			var option = '';
			option += '<option value="">Select Country</option>';
			for(var i=0; i<json.length; i++){
				option += '<option value="' + json[i].id + '">' + json[i].name + '</option>';
			}
			$('#country').html(option);
		},
		error:function(xhr,ajaxOptions,thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function state(country_id){
	$.ajax({
		url:'http://localhost/curl_api/api/curl/state_data',
		type:'post',
		dataType:'json',
		data:{countryID:country_id}, 
		contentType:'application/json',
		beforeSend:function(){
			$('select#state').find('option:eq(0)').html("Please Wait.....");
		},
		success:function(json){	
			var json_data=json.State;			
			// console.log(len.length);
			var option='';
			option += '<option value="" hidden>Select City:</option>';
			for(var i=0; i<json_data.length; i ++){
				if(json_data[i].country_id==country_id){
					option += '<option value="' + json_data[i].id + '">' + json_data[i].name + '</option>';
				}
			}
			$('select#state').html(option);
		},
		error:function(xhr, ajaxOptions, thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
function city(state_id){
	$.ajax({
		url:'http://localhost/curl_api/api/curl/city_data',
		type:'post',
		dataType:'json',
		data:{stateID:state_id},
		contentType:'application/json',
		beforeSend:function(){
			$('select#city').find('option:eq(0)').html('Please Wait......');
		},
		success:function(json){
			var json_data=json.City;
			
			var option ='';
			option += '<option value="" hidden>Select City:</option>';
			for(var i=0; i<json_data.length; i++){
				if(json_data[i].state_id==state_id){
					option +='<option value="' + json_data[i].id + '">' + json_data[i].name + '</option>';
				}
			}
			$('select#city').html(option);
		},
		error:function(xhr, ajaxOptions, thrownError){
			console.log(thrownError +"\r\n"+ xhr.statusText + "\r\n" + xhr.responseText); 
		}
	});
		
}