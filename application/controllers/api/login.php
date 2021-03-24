<?php 
	require APPPATH . 'libraries/REST_Controller.php';

	class Login extends REST_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->model('api_model');
		}

		public function index_get(){
			$display=$this->api_model->display();
			$this->response($display,200);
		}

		public function country_get(){
			$display_country = $this->api_model->country();

			if(isset($display_country)){
				$this->response(["status"=>"1","Country"=>$display_country],200);
			}

		}

		public function state_get(){
			$display_state = $this->api_model->state();

			if(isset($display_state)){
				$this->response(["status"=>"1","State"=>$display_state],200);
			}
		}

		public function city_get(){
			$display_city = $this->api_model->city();

			if(isset($display_city)){
				$this->response(["status"=>"1","City"=>$display_city],200);
			}
		}

		public function loginuser_post(){
			$username = $this->post('username');
			$password = $this->post('password');
				
			$nameError=$this->api_model->nameError($username);
			$passwordError=$this->api_model->passwordError($password);
			$login=$this->api_model->login($username,$password);
			
			if($nameError){
				$this->response($nameError,REST_Controller::HTTP_UNAUTHORIZED);
			}
			elseif($passwordError){
				$this->response($passwordError,REST_Controller::HTTP_UNAUTHORIZED);
			}
			else{
				$this->response($login,REST_Controller::HTTP_OK);
			}
		}

		public function signup_post(){
			// $input=$this->input->post();

			$input['name']=$this->post('name');
			$input['email']=$this->post('email');
			$input['password']=$this->post('password');
			$input['cpassword']=$this->post('cpassword');

			// $input['country']=$this->post('country');
			// $input['state']=$this->post('state');
			// $input['city']=$this->post('city');

			$country['country']=$this->post('country');
			$country['state']=$this->post('state');
			$country['city']=$this->post('city');

			if($input['name']==''){
				$this->response(["status"=>"0","message"=>"Enter Name"],REST_Controller::HTTP_UNAUTHORIZED);
			}
			elseif($input['email']==''){
				$this->response(["status"=>"0","message"=>"Please Enter Email"],REST_Controller::HTTP_UNAUTHORIZED);

			}
			elseif($input['password']=='' || $input['cpassword']==''){
				$this->response(["status"=>"0","message"=>"Please Enter Password"],REST_Controller::HTTP_UNAUTHORIZED);
				
			}
			else{
				$signup=$this->api_model->signup($input,$country);

				$this->response($signup,REST_Controller::HTTP_OK);
			}
		}

		public function update_put(){

			$id['update_id']=$this->put('id');
			$input['name']=$this->put('name');
			$input['email']=$this->put('email');

			$country['country']=$this->put('country');
			$country['state']=$this->put('state');
			$country['city']=$this->put('city');

			$input['password']=$this->put('password');
			$input['cpassword']=$this->put('cpassword');

			if($id['update_id']==''){
				$this->response(["status"=>"0","message"=>"Please Enter Id"],REST_Controller::HTTP_UNAUTHORIZED);
			}
			elseif($input['name']==''){
				$this->response(["status"=>"0","message"=>"Please Enter Name"],REST_Controller::HTTP_UNAUTHORIZED);
				// $this->response(false);
			}
			elseif($input['email']==''){
				$this->response(["status"=>"0","message"=>"Please Enter email"],REST_Controller::HTTP_UNAUTHORIZED);
				// $this->response(false);
			}
			elseif($country['country']==''){
				$this->response(["status"=>"0","message"=>"Please Enter country"],REST_Controller::HTTP_UNAUTHORIZED);
				// $this->response(false);
			}
			elseif($country['state']==''){
				$this->response(["status"=>"0","message"=>"Please Enter state"],REST_Controller::HTTP_UNAUTHORIZED);
				// $this->response(false);
			}
			// elseif($country['city']==''){
			// 	$this->response(["status"=>"0","message"=>"Please Enter city"],REST_Controller::HTTP_UNAUTHORIZED);
			// 	// $this->response(false);
			// }
			elseif($input['password']==''){
				$this->response(["status"=>"0","message"=>"Please Enter password"],REST_Controller::HTTP_UNAUTHORIZED);
				// $this->response(false);
			}
			elseif($input['cpassword']==''){
				$this->response(["status"=>"0","message"=>"Please Enter cpassword"],REST_Controller::HTTP_UNAUTHORIZED);
				// $this->response(false);
			}
			else{
				$update=$this->api_model->update($input,$country,$id);
				if(!$update){
					$this->response(["status"=>"0","message"=>"Error"],REST_Controller::HTTP_UNAUTHORIZED);
				}
				else{
					$this->response($update,REST_Controller::HTTP_OK);
				}
			}
		}

		public function delete_delete($id){
			// $delete['id']=$this->post('id');
			$delete=$this->api_model->delete($id);
			if($delete){
				$this->response($delete,200);
			}
			else{
				$this->response(['status'=>"0","message"=>"Error"],200);
			}
		}
	}
?>