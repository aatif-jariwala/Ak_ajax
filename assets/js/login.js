$(document).ready(function(){

	$('#nav_login').hide();

	$('.fa').on('click',function(){
		$(this).toggleClass('fa-eye fa-eye-slash');

		var eye_password = $('#password');
		if(eye_password.attr('type') === 'password'){
			eye_password.attr('type','text'); 
			$('.fa-eye-slash').css({'position':'relative','right':'25px','cursor':'pointer'});
		}
		else{
			eye_password.attr('type','password');
		}
	});

	$('#login').on('click',function(e){
		e.preventDefault();
		var name = $('#name').val();
		var password = $('#password').val();
 		var form = new FormData();
 		form.append('name',name);
		form.append('password',password);
		function display_message(){
			$('#message').css('display','flex');
			$('#close').click(function(){$('#message').fadeOut(500);});
			$('#close').html('&#x2716;');
		}
		if(name.length == ''){
			display_message();
			$('#demo').text('Please Enter Name');
		}
		else if(password.length == ''){
			display_message();
			$('#demo').text('Please Enter Password');
		}
		else if(name.length == '' && password.length ==''){
			display_message();
			$('#demo').text('Please Enter Name and Password');
		}
		else{
			$.ajax({
				// url:'http://localhost/curl_api/api/curl/login',
				url:base_url +'/api/curl/login',
				type:'post',
				// dataType:'json',
				contentType:false,
				processData:false,
				// data:{'name':name,'password':password},
				data:form,
				beforeSend:function(){
					// alert('process...');
				},
				success:function(userdata){
					var json = JSON.parse(userdata);
					// console.log(form);
					// alert('hello');
					if(json.status == 1){
						window.location.replace('http://localhost/curl_api/api/curl/display');
					}
					if(json.status == 0){
						display_message();
						$('#demo').html(json.message);
					}
				},
				error:function(xhr,ajaxOptions,thrownError){
					console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	});
});