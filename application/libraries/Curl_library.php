<?php
class Curl_library{

	function showdata(){
		$curl = curl_init();
		curl_setopt_array($curl,array(CURLOPT_URL => "http://localhost/curl_api/api/login/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array("content-type:application/json")));

		$response = curl_exec($curl);

		$err = curl_error($curl);
		if($err){
			return "cURL Error #:" . $err;
		}
		else{
			return $response;
		}
		curl_close($curl);
	}

	function login($name,$password){
		$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://localhost/curl_api/api/login/loginuser",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => array('username' =>$name ,'password'=>$password),
			  // CURLOPT_HTTPHEADER => array(
			  //   "authorization: Basic YWxrZXNoOjEy",
			  //   "cache-control: no-cache",
			  //   "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
			  //   "postman-token: 368be180-665f-efa2-672f-f7e20cdfb94e"
			  // ),
			 //  CURLOPT_HTTPHEADER => array(
			 //    "content-type: application/json",
				// )
			));

			$response = curl_exec($curl);
			
			$err = curl_error($curl);
			if ($err) {
				  return "cURL Error #:" . $err;
			}
			else{
					return $response;
			}

			curl_close($curl);
	}


	function signup($name,$email,$country,$state,$city,$password,$cpassword){
		$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "http://localhost/curl_api/api/login/signup",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => array('name' =>$name ,'email'=>$email,'password'=>$password,'cpassword'=>$cpassword,'country'=>$country,'state'=>$state,'city'=>$city),
				  // CURLOPT_HTTPHEADER => array(
				  //   "authorization: Basic YWxrZXNoOjEy",
				  //   "cache-control: no-cache",
				  //   "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
				  //   "postman-token: 368be180-665f-efa2-672f-f7e20cdfb94e"
				  // ),
				  // CURLOPT_HTTPHEADER=> array(
				  	    // "cache-control: no-cache",
	    				// "content-type: application/json",
	    				// "postman-token: 65ad0ef3-775e-d952-697e-f69ef6b8f46a"
	    			// )
				));

				$response = curl_exec($curl);
				
				$err = curl_error($curl);
				if ($err) {
				  return "cURL Error #:" . $err;
				}else{
					return $response;
				}

				curl_close($curl);
	}

	function update($id,$name,$email,$country,$state,$city,$password,$cpassword){

				$data=array('id'=>$id,'name'=>$name,'email'=>$email,'country'=>$country,'state'=>$state,'city'=>$city,'password'=>$password,'cpassword'=>$cpassword);
				$req_data=json_encode($data);
				// print_r($req_data);die;

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "http://localhost/curl_api/api/login/update",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "PUT",
				  CURLOPT_POSTFIELDS => $req_data,
				  CURLOPT_HTTPHEADER => array(
				    // "cache-control: no-cache",
				    "content-type: application/json"
				    // "postman-token: 653eed0a-1c76-b8e8-57e6-94d607ec3c8d"
				  ),
				));

				$response = curl_exec($curl);

				$err = curl_error($curl);

				if ($err) {
				  return "cURL Error #:" . $err;
				} 
				else {
				  return $response;
				}
				curl_close($curl);
	}

	function delete($id){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://localhost/curl_api/api/login/delete/$id",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "DELETE",
		  // CURLOPT_POSTFIELDS => array('id' => $id),
		  CURLOPT_HTTPHEADER => array(
		    // "cache-control: no-cache",
		    "content-type: application/json",
		    // "postman-token: c0e26fcc-1377-77ec-a99a-e85981fbb014"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}

	function country(){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://localhost/curl_api/api/login/country",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  // CURLOPT_POSTFIELDS => array('id' => $id),
		  CURLOPT_HTTPHEADER => array(
		    // "cache-control: no-cache",
		    "content-type: application/json",
		    // "postman-token: c0e26fcc-1377-77ec-a99a-e85981fbb014"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}

	function state(){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://localhost/curl_api/api/login/state",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  // CURLOPT_POSTFIELDS => array('id' => $id),
		  CURLOPT_HTTPHEADER => array(
		    // "cache-control: no-cache",
		    "content-type: application/json",
		    // "postman-token: c0e26fcc-1377-77ec-a99a-e85981fbb014"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}

	function city(){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://localhost/curl_api/api/login/city",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  // CURLOPT_POSTFIELDS => array('id' => $id),
		  CURLOPT_HTTPHEADER => array(
		    // "cache-control: no-cache",
		    "content-type: application/json",
		    // "postman-token: c0e26fcc-1377-77ec-a99a-e85981fbb014"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}
}
?>