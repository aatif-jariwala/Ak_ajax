<?php
	class Curl extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('session');
		}

		public function index(){
			if(!$this->session->userdata('loggedin')){
				$this->login();
			}	
			else{
				redirect(base_url('api/curl/display'));
			}	
		}
		// login_response function*********************************************************
		public function login(){
			if($this->input->post()){
				$name=$this->input->post('name');
				$password=$this->input->post('password');

				// library ***************************************************
				$this->load->library('curl_library');
				$login_response = $this->curl_library->login($name,$password);
				$response=json_decode($login_response,true);
				
				$error='';
				if($response['status']==1){
					$this->session->set_userdata(array('name'=>$name,'loggedin'=>true,'api_data'=>$response));
					$error = array('status'=>'1');
					echo json_encode($error);
				}
				if($response['status']==0){
					$error = array('status'=>'0','message'=>'Invalid Username and Password');
					echo json_encode($error);
				}
			}
			else{
				if(!$this->session->userdata('loggedin')){
					$this->load->view('login');
				}
				else{
					redirect(base_url('api/curl/displaydata'));
				}
			}
				
		}
		// displaydata function*********************************************************

		public function display(){
			if(!$this->session->userdata('loggedin')){
				$this->load->view('display');
			}
			else{
				$this->load->view('display');
			}
		}
		public function displaydata(){
			if($this->session->userdata('loggedin')){
				$name = $this->session->userdata('api_data');
				echo json_encode($name);
			}
			else{
				$this->load->library('curl_library');
				$response = $this->curl_library->showdata();
				echo $response;
				// $this->load->view('display');	
			}
		}
		// signup function*********************************************************

		public function signup(){
			
			if($this->input->post()){

				$name=$this->input->post('name');
				$email=$this->input->post('email');
				$password=$this->input->post('password');
				$cpassword=$this->input->post('cpassword');

				$country=$this->input->post('country');
				$state=$this->input->post('state');
				$city=$this->input->post('city');

				// library ******************************************************
				$this->load->library('curl_library');
				$signup_response = $this->curl_library->signup($name,$email,$country,$state,$city,$password,$cpassword);
				
				$response=json_decode($signup_response,true);
				// echo "<pre>";
				// print_r($response);echo "</pre>";	
				// print_r($response);
				$error = '';
				if($response['status']==1){
					// echo "<h3>Signup Successfull</h3>";
					echo $signup_response;
				}
				if($response['status']==0){
					$error = array('status'=>'0','message'=>'User Already Exist');
					echo json_encode($error);
				}	
			}		
			else{
				if(!$this->session->userdata('loggedin')){
					$this->load->view('signup');
				}	
			}		
		}

		// update function *******************************************************
		public function update(){
			$this->load->view('update');
		}

		public function update_process(){
			if($this->session->userdata('loggedin')){
				if($this->input->post()){

					$id=$this->input->post('id');
					$name=$this->input->post('name');
					$email=$this->input->post('email');
					$country=$this->input->post('country');
					$state=$this->input->post('state');
					$city=$this->input->post('city');
					$password=$this->input->post('password');
					$cpassword=$this->input->post('cpassword');

					$this->load->library('curl_library');
					$response=$this->curl_library->update($id,$name,$email,$country,$state,$city,$password,$cpassword);
					// echo $response;
					$update = json_decode($response,true);

					if($update['status']=='1'){
						$msg = array('status'=>'1');
						echo json_encode($msg);
						// redirect(base_url('api/curl/displaydata'));
					}
				}
				else{
					$userdata = $this->session->userdata('api_data');
					echo json_encode($userdata);
				}
			}
			else{
				redirect('api/curl/login');
			}
		}

		// delete function *******************************************************

		public function delete(){
			if($this->session->userdata('loggedin')){
				$id=$this->input->get('id');
				$this->load->library('curl_library');
				$response=$this->curl_library->delete($id);
				$delete=json_decode($response,true);
				if($delete['status']==1){
					// print_r($delete);
					$this->logout();
				}
				else{
					echo "error";
				}
			}
			else{
				redirect(base_url('api/curl/login'));
			}
		}

		// logout function*********************************************************

		public function logout(){
			if($this->session->userdata('loggedin')){
				$this->session->unset_userdata('name');
				$this->session->sess_destroy();
				redirect(base_url('api/curl/login'));
			}
			else{
				redirect(base_url('api/curl/login'));
			}
		}

		public function country_data(){
			$this->load->library('curl_library');

			$country = $this->curl_library->country();
			echo $country;
		}
		public function state_data(){
			//******** state select code**************************
			
			$this->load->library('curl_library');
			$state = $this->curl_library->state();
			// header("content-type:application/json");
			echo $state;
		}
		public function city_data(){
			//******** city select code**************************
			$this->load->library('curl_library');
			$city = $this->curl_library->city();
			echo $city;
			// print_r($city);
		}
	}
?>