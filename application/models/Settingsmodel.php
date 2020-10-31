<?php 

/*

	Model class: Settingsmodel
	Base class: CI_Model
	Description: 
	
*/

class Settingsmodel extends CI_Model {

	public function __construct() {
    	parent::__construct();
    	$this->load->model('utilmodel', 'utilmodel');
  	}
	
	public function get_user_profile($user_id) {
							
		$query = $this->db->where(["user_id"=>$user_id, "user_status"=>"1"])
					->get("user_info");		
		$row = $query->row();		
		return $row;
	
	}
	
	public function update_user_info($userSalutation, $userFirstName, $userMiddleName, $userLastName, $userEmployeeId, $userNewDob, $userGender, $userBloodGroup, $userAddress, $userCity, $userPincode, $userState, $userCountry, $userPhoneNumber, $userMobileNumber, $user_id) {
		$array  =[
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
				'user_country' => $userCountry,
				'user_phone_number' => $userPhoneNumber,
				'user_mobile_number' => $userMobileNumber,
				'user_ip_address' => $_SERVER['REMOTE_ADDR'],
				'user_status' => "1",
		];
		
		$rows = $this->db
						 ->where("user_id", $user_id)
						 ->update('user_info', $array);
		print_r($rows);
		return $rows;
	}
	
	public function update_password_info($userNewPassword, $user_id) {
		$array  =[
				
				'user_password' => $userNewPassword,
				'user_ip_address' => $_SERVER['REMOTE_ADDR'],
				'user_status' => "1",
		];
		
		$rows = $this->db
						 ->where("user_id", $user_id)
						 ->update('user_info', $array);
		print_r($rows);
		return $rows;
	}
	
	/*********************************************************/
	//				BEGIN: LOG GENERATION
	/*********************************************************/	
	
	public function log_report_generation($action,$url){
		$user_id="";
		$user_id=$this->session->userdata('login_id');
		
		$array  =[
				'log_user_id' => $user_id,
				'log_action' => $action,
				'log_url' => $url,
				'log_ip_addr' => $_SERVER['REMOTE_ADDR'],
				'log_status' => "1",
		];
		if($user_id){
		$rows = $this->db->insert('log_info', $array);
		}else{
		$arrayfail  =[
				'log_user_id' => "0",
				'log_action' => $action,
				'log_url' => $url,
				'log_ip_addr' => $_SERVER['REMOTE_ADDR'],
				'log_status' => "1",
		];
		$rows = $this->db->insert('log_info', $arrayfail);
		}
		return $rows;
	}
	
	public function get_log_report(){
		$logArray=[];
		$query = $this->db->where(["log_status"=>"1"])
					->order_by('log_date_time','DESC')
					->get("log_info");
		$logList = $query->result();
		
		/*foreach($logList as $row) {
			$user_name = $this->utilmodel->get_user_by_id_info($row->log_user_id);
			
			$array  =[
				'log_user_name' => $user_name,
				'log_action' => $row->log_action,
				'log_url' => $row->log_url,
				'log_date_time' =>$row->log_date_time,
				'log_ip_addr' => $row->log_ip_addr,
				'log_status' => $row->log_status,
				
			];	
			array_push($logArray, $array);
			
		}*/
		
		return $logList;			
	}
	
	public function get_log_num_rows() {
		$query = $this->db->where("log_status ",  1)
					->get("log_info");	
		$rows = $query->num_rows();
		return $rows;
	}
	
	/*********************************************************/
	//				END: LOG GENERATION
	/*********************************************************/	
}


