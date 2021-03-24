<?php 
	class Api_model extends CI_model{
		function display(){
			$display = $this->db->get('login')->result_array();
			return array("status"=>"1","details"=>$display);
		}

		function nameError($username){
			if($username==''){
				// $select =$this->db->get('login')->result_array();
				$error = array("status"=>"0","message"=>"Please Enter Username");
				return $error;
			}
		}

		function passwordError($password){
			if($password==''){
				$error = array("status"=>"0","message"=>"Please Enter Password");
				return $error;
			}
		}

		function login($username,$password){
			if(!$username == '' && !$password == ''){
				$data=$this->db->get_where('login',['name'=>$username,'password'=>$password])->row_array();
				if($data){
					return ['status'=>'1','message'=>'Welcome '.$data['name'],'Detail'=>$data];
				}
				else{
					return ["status"=>"0","message"=>"invalid Username Or Password"];
				}
			}
		}

		function signup($input,$country){

			$select =$this->db->get_where('login',['name'=>$input['name']])->row_array();

			if($select){
				$error = ["status"=>"0","message"=>"User Already Exist"];
				return $error;
			}
			else{
				$this->db->select('name');
				$this->db->where('id',$country['country']);
				$data['country'] = $this->db->get('countries')->row_array();
				$input['country'] = $data['country']['name'];

				$this->db->select('name');
				$this->db->where('id',$country['state']);
				$data['state'] = $this->db->get('states')->row_array();
				$input['state'] = $data['state']['name'];

				$this->db->select('name');
				$this->db->where('id',$country['city']);
				$data['city'] = $this->db->get('cities')->row_array();	
				$input['city'] = $data['city']['name'];

				if($input['password']==$input['cpassword']){
					$data = $this->db->insert('login',$input);
					return ["status"=>"1","message"=>"Signup Successfull"];
				}
				else{
					return ["status"=>"0","message"=>"Password Do Not Match"];
				}
			}
		}

		function update($input,$country,$id){
			$this->db->select('name');
			$this->db->where('id',$country['country']);
			$data['country'] = $this->db->get('countries')->row_array();
			$input['country'] = $data['country']['name'];  

			$this->db->select('name'); 
			$this->db->where('id',$country['state']);
			$data['state'] = $this->db->get('states')->row_array();
			$input['state'] = $data['state']['name'];

			$this->db->select('name');
			$this->db->where('id',$country['city']);
			$data['city'] = $this->db->get('cities')->row_array();	
			$input['city'] = $data['city']['name'];
			
			$this->db->select('id');
			$database_id = $this->db->get_where('login',['id'=>$id['update_id']])->row_array();
			// return $database_id;

			$where=$this->db->where('id',$id['update_id']);
			$update =$this->db->update('login',$input);
			// return $this->db->where('id',$id['update_id']);

			$msg = '';
			if($database_id['id'] == $id['update_id']){
				$msg = ["status"=>"1","message"=>"Update Successfull"];
				return $msg;
			}
			else{
				$msg = ["status"=>"0","message"=>"Error"];
				return $msg;
			}
		}

		function delete($id){
			$this->db->where('id',$id);
			$delete=$this->db->delete('login');
			if($delete){
				return ["status"=>"1","message"=>"Delete Successfull"];
			}
			else{
				return ["status"=>"0","message"=>"Error"];
			}
		}

		function country(){
			$country_data=$this->db->get('countries')->result_array();
			return $country_data;
		}
		function state(){
			$state_data=$this->db->get('states')->result_array();
			return $state_data;
		}
		function city(){
			$city_data=$this->db->get('cities')->result_array();
			return $city_data;
		}
	}
?>