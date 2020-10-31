<?php 

/*

	Model class: Usersetupmodel
	Base class: CI_Model
	Description: 
	
*/

class Usersetupmodel extends CI_Model {
	
	public function __construct() {
    	parent::__construct();
    	$this->load->model('mastersetupmodel', 'mastermodel');
  	}
	
	public function get_user_list() {
							
		$resultArray = [];
		$query = $this->db->where(["user_status"=>"1"])
					->get("user_info");		
		$list = $query->result();
		foreach($list as $row) {
			//
			$user_role_name = "";
			$role_id = $row->user_role;
			$role_query = $this->mastermodel->find_user_role_info($role_id);
			if($role_query) {	
				$user_role_name = $role_query->user_role_name;
			}
			$array  =[
				'user_id' => $row->user_id,
				'lab_id' => $row->lab_id,
				'user_salutation' => $row->user_salutation,
				'user_first_name' => $row->user_first_name,
				'user_middle_name' => $row->user_middle_name,
				'user_last_name' => $row->user_last_name,
				'user_employee_id' => $row->user_employee_id,
				'user_dob' => $row->user_dob,
				'user_gender' => $row->user_gender,
				'user_blood_group' => $row->user_blood_group,
				'user_address' => $row->user_address,
				'user_city' => $row->user_city,
				'user_pincode' => $row->user_pincode,
				'user_state' => $row->user_state,
				'user_country' => $row->user_country,
				'user_phone_number' => $row->user_phone_number,
				'user_mobile_number' => $row->user_mobile_number,
				'user_email' => $row->user_email,				
				'user_password' => $row->user_password,
				'user_role' => $user_role_name,
				'user_status' => $row->user_role,
			];
			array_push($resultArray, $array);
		}
		
		return $resultArray;
	
	}
	
	public function add_user_info($userSalutation, $userFirstName, $userMiddleName, $userLastName, $userEmployeeId, $userNewDob, $userGender, $userBloodGroup, $userAddress, $userCity, $userPincode, $userState, $userMobileNumber, $userEmail, $userPassword, $userRole) {
		
		$array  =[
				'lab_id' => $this->session->userdata("login_lab_id"),
				'user_salutation' => $userSalutation,
				'user_first_name' => $userFirstName,
				'user_middle_name' => $userMiddleName,
				'user_last_name' => $userLastName,
				'user_employee_id' => $userEmployeeId,
				'user_dob' => $userNewDob,
				'user_gender' => $userGender,
				'user_blood_group' => $userBloodGroup,
				'user_address' => $userAddress,
				'user_city' => $userCity,
				'user_pincode' => $userPincode,
				'user_state' => $userState,
				'user_mobile_number' => $userMobileNumber,
				'user_email' => $userEmail,				
				'user_password' => $userPassword,
				'user_role' => $userRole,
				'user_ip_address' => $_SERVER['REMOTE_ADDR'],
				'user_status' => "1",
		];
		$rows = $this->db->insert('user_info', $array);
		return $rows;
		
	}
	
	public function update_user_info($userSalutation, $userFirstName, $userMiddleName, $userLastName, $userEmployeeId, $userNewDob, $userGender, $userBloodGroup, $userAddress, $userCity, $userPincode, $userState, $userMobileNumber, $userEmail, $userPassword, $userRole, $user_id) {
		$array  =[
				'lab_id' => $this->session->userdata("login_lab_id"),
				'user_salutation' => $userSalutation,
				'user_first_name' => $userFirstName,
				'user_middle_name' => $userMiddleName,
				'user_last_name' => $userLastName,
				'user_employee_id' => $userEmployeeId,
				'user_dob' => $userNewDob,
				'user_gender' => $userGender,
				'user_blood_group' => $userBloodGroup,
				'user_address' => $userAddress,
				'user_city' => $userCity,
				'user_pincode' => $userPincode,
				'user_state' => $userState,
				'user_mobile_number' => $userMobileNumber,
				'user_email' => $userEmail,				
				'user_password' => $userPassword,
				'user_role' => $userRole,
				'user_ip_address' => $_SERVER['REMOTE_ADDR'],
				'user_status' => "1",
		];
		
		$rows = $this->db
						 ->where("user_id", $user_id)
						 ->update('user_info', $array);
		return $rows;
	}
	
	public function find_user_info($user_id) {
	
		$query = $this->db->where(["user_id"=>$user_id, "user_status"=>"1"])
					->get("user_info");		
		$labDetails = $query->row();		
		return $labDetails;
		
	}
	
	public function delete_management_info($user_id) {
		$rows = $this->db
						 ->where("user_id", $user_id)
						 ->update('user_info', ['user_status' => "0"]);
		return $rows;
	}
	
}


