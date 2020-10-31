<?php 

/*

	Model class: Farmersetupmodel
	Base class: CI_Model
	Description: 
	
*/

class Farmer_report_downloadmodel extends CI_Model {
	
	public function __construct() {
    	parent::__construct();
    	$this->load->model('mastersetupmodel', 'mastermodel');
  	}
	
	public function get_farmer_list() {
		$farmerArray = [];					
		$query = $this->db->where(["farmer_status"=>"1"])
					->order_by("farmer_id", "DESC")
					->get("farmer_info");	
		$list = $query->result();
		foreach($list as $row) {
			$city_name = "";
			$district_name = "";
			
			//
			$city_id = $row->farmer_city;
			$city_query = $this->mastermodel->find_city_info($city_id);
			if($city_query) {	
				$city_name = $city_query->city_name;
			}
			//
			$district_id = $row->farmer_district;
			$district_query = $this->mastermodel->find_district_info($district_id);
			if($district_query) {	
				$district_name = $district_query->district_name;
			}
			$array  =[
				'farmer_id' => $row->farmer_id,
				'lab_id' => $row->lab_id,
				'farmer_name' => $row->farmer_name,
				'farmer_mobile' => $row->farmer_mobile,
				'farmer_email' => $row->farmer_email,		
				'farmer_address' => $row->farmer_address,
				'farmer_city' => $city_name,
				'farmer_district' => $district_name,	
				'user_id' => $row->user_id,
				'farmer_ip_address' => $row->farmer_ip_address,
				'farmer_status' => $row->farmer_status,
			];	
			array_push($farmerArray, $array);
		}
		return $farmerArray;
	
	}
	
	public function find_farmer_info($farmer_id) {
	
		$query = $this->db->where(["farmer_id"=>$farmer_id, "farmer_status"=>"1"])
					->get("farmer_info");		
		$labDetails = $query->row();		
		return $labDetails;
		
	}
	
	public function check_farmer_info($txtFarmerMobile, $txtFarmerName) {
		$query = $this->db->where(["farmer_name"=>$txtFarmerName, "farmer_mobile"=>$txtFarmerMobile])
					->get("farmer_info");		
		if($query->num_rows()) {
			return true;
		} else {
			return false;
		}
	}
	
	public function add_farmer_info($data) {
		return $this->db->insert("farmer_info", $data);
		
	}
	
	public function update_farmer_info($txtFarmerName, $txtFarmerMobile, $txtFarmerEmail, $txtFarmerAddress, $txtFarmerCity, $txtFarmerDistrict, $farmer_id) {
		
		$array  =[
				'lab_id' => $this->session->userdata("login_lab_id"),
				'farmer_name' => $txtFarmerName,
				'farmer_mobile' => $txtFarmerMobile,
				'farmer_email' => $txtFarmerEmail,
				'farmer_address' => $txtFarmerAddress,
				'farmer_city' => $txtFarmerCity,
				'farmer_district'=>$txtFarmerDistrict,
				'farmer_ip_address' => $_SERVER['REMOTE_ADDR'],
				'farmer_status' => "1",
		];
		
		$rows = $this->db
						 ->where("farmer_id", $farmer_id)
						 ->update('farmer_info', $array);
		return $rows;
	}
	
	/*public function delete_farmer_info($farmer_id) {
		$query = $this->db->delete("farmer_info", ["farmer_id" => $farmer_id]);
		return $query;
	}*/
	
	public function delete_farmer_info($farmer_id) {
		$array  =[
				'farmer_ip_address' => $_SERVER['REMOTE_ADDR'],
				'farmer_status' => "0",
		];
		
		$rows = $this->db
						 ->where("farmer_id", $farmer_id)
						 ->update('farmer_info', $array);
		return $rows;
	}
	
	
	public function find_farmer_is_exists() {
	    $query = $this->db->select('farmer_name')->from('farmer_info')
						 ->where("farmer_status", "1")
						 ->order_by('farmer_name', 'ASC')
						 ->get();
		$farmers = $query->result();		
		return $farmers;
	}
	
	
	public function find_farmer_info_by_mobile($mobile) {
	
		$query = $this->db->where(["farmer_mobile"=>$mobile, "farmer_status"=>"1"])
					->get("farmer_info");		
		$labDetails = $query->row();		
		return $labDetails;
		
	}
	
	//-----Farmer Report Download-----
 	
	public function get_plant_inward_list($farmerid, $sampleid) {
		$inwardArray = [];
		$farmer_name = "";
		$query = $this->db->where(["plant_inward_status"=>"1", "plant_inward_farmer_name"=>$farmerid, "plant_inward_sample_id"=>$sampleid])
					->order_by("plant_inward_date", "DESC")
					->get("plant_inward_info");	
		$list = $query->result();
		foreach($list as $row) {
			//
			$farmer_id = $row->plant_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
			}
			//
			$received_name = $this->utilmodel->get_received_through_by_id_info($row->plant_inward_received_through);
			//
			$sample_type_name = $this->utilmodel->get_received_through_by_id_info($row->plant_inward_sample_type);
			//
			$crop_name = $this->utilmodel->get_crop_type_by_id_info($row->plant_inward_crop);
			//
			$variety_name = $this->utilmodel->get_variety_by_id_info($row->plant_inward_variety);
			//
			$soil_type_name = $this->utilmodel->get_soil_type_by_id_info($row->plant_inward_soil_type);
			//
			$stage_name = $this->utilmodel->get_stage_by_id_info($row->plant_inward_stage);	
			//
			$leaf_name = $this->utilmodel->get_leaf_by_id_info($row->plant_inward_leaf);		
			//
			$payment_name = $this->utilmodel->get_payment_by_id_info($row->plant_inward_pay_type);	
			
			$array  =[
				'plant_inward_id' => $row->plant_inward_id,
				'lab_id' => $row->lab_id,
				'plant_inward_farmer_name' => $farmer_name,
				'plant_inward_date' => $row->plant_inward_date,
				'plant_inward_received_date' => $row->plant_inward_received_date,
				'plant_inward_received_through' => $received_name,				
				'plant_inward_sample_id' => $row->plant_inward_sample_id,
				'plant_inward_plot_gat' => $row->plant_inward_plot_gat,
				'plant_inward_sample_type' => $sample_type_name,
				'plant_inward_crop' => $crop_name,
				'plant_inward_variety' => $variety_name,
				'plant_inward_soil_type' => $soil_type_name,
				'plant_inward_cutting_date' => $row->plant_inward_cutting_date,
				'plant_inward_pruning_days' => $row->plant_inward_pruning_days,
				'plant_inward_stage' => $stage_name,
				'plant_inward_leaf' => $leaf_name,
				'plant_inward_fee' => $row->plant_inward_fee,
				'plant_inward_pay_type' => $payment_name,
				'plant_inward_farmer_issue' => $row->plant_inward_farmer_issue,		
				'user_id' => $row->user_id,
				'plant_inward_add_date' => $row->plant_inward_add_date,
				'plant_inward_ip_address' => $row->plant_inward_ip_address,
				'plant_inward_status' => $row->plant_inward_status,
			];	
			array_push($inwardArray, $array);
		}
		return $inwardArray;
	}
	
	
	//Soil-------
	public function get_soil_inward_list($farmerid) {
		$inwardArray = [];
		$query = $this->db->where(["soil_inward_status"=>"1",  "soil_inward_farmer_name"=>$farmerid])
					->order_by("soil_inward_date", "DESC")
					->get("soil_inward_info");	
		$farmer_name = "";
		$list = $query->result();
		foreach($list as $row) {
			//
			$farmer_id = $row->soil_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
			}
			
			//
			$received_name = $this->utilmodel->get_received_through_by_id_info($row->soil_inward_received_through);
			//
			$sample_type_name = $this->utilmodel->get_received_through_by_id_info($row->soil_inward_sample_type);
			//
			$crop_name = $this->utilmodel->get_crop_type_by_id_info($row->soil_inward_crop);
			//
			$soil_type_name = $this->utilmodel->get_soil_type_by_id_info($row->soil_inward_soil_type);
			//
			$payment_name = $this->utilmodel->get_payment_by_id_info($row->soil_inward_pay_type);
			
			$array  =[
				'soil_inward_id' => $row->soil_inward_id,
				'lab_id' => $row->lab_id,
				'soil_inward_farmer_name' => $farmer_name,
				'soil_inward_date' => $row->soil_inward_date,
				'soil_inward_received_date' => $row->soil_inward_received_date,
				'soil_inward_received_through' => $received_name,				
				'soil_inward_sample_id' => $row->soil_inward_sample_id,
				'soil_inward_plot_gat' => $row->soil_inward_plot_gat,
				'soil_inward_sample_type' => $sample_type_name,
				'soil_inward_crop' => $crop_name,
				'soil_inward_soil_type' => $soil_type_name,
				'soil_inward_fee' => $row->soil_inward_fee,
				'soil_inward_pay_type' => $payment_name,
				'soil_inward_farmer_issue' => $row->soil_inward_farmer_issue,		
				'user_id' => $row->user_id,
				'soil_inward_add_date' => $row->soil_inward_add_date,
				'soil_inward_ip_address' => $row->soil_inward_ip_address,
				'soil_inward_status' => $row->soil_inward_status,
			];	
			array_push($inwardArray, $array);
		}
		return $inwardArray;
	}
	
	
	//Water
	
	public function get_water_inward_list($farmerid) {
		$inwardArray = [];
		$query = $this->db->where(["water_inward_status"=>"1", "water_inward_farmer_name"=>$farmerid])
					->order_by("water_inward_date", "DESC")
					->get("water_inward_info");	
		$list = $query->result();
		$farmer_name = "";
		foreach($list as $row) {
			//
			$farmer_id = $row->water_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
			}		
			
			//
			$received_name = $this->utilmodel->get_received_through_by_id_info($row->water_inward_received_through);
			//
			$crop_name = $this->utilmodel->get_crop_type_by_id_info($row->water_inward_crop);		
			//
			$payment_name = $this->utilmodel->get_payment_by_id_info($row->water_inward_pay_type);
			//
			$water_source_name = $this->utilmodel->get_water_source_by_id_info($row->water_inward_water_source);	
			
			$array  =[
				'water_inward_id' => $row->water_inward_id,
				'lab_id' => $row->lab_id,
				'water_inward_farmer_name' => $farmer_name,
				'water_inward_date' => $row->water_inward_date,
				'water_inward_received_date' => $row->water_inward_received_date,
				'water_inward_received_through' => $received_name,				
				'water_inward_sample_id' => $row->water_inward_sample_id,
				'water_inward_plot_gat' => $row->water_inward_plot_gat,
				'water_inward_crop' => $crop_name,
				'water_inward_water_source' => $water_source_name,
				'water_inward_fee' => $row->water_inward_fee,
				'water_inward_pay_type' => $payment_name,
				'water_inward_farmer_issue' => $row->water_inward_farmer_issue,		
				'user_id' => $row->user_id,
				'water_inward_add_date' => $row->water_inward_add_date,
				'water_inward_ip_address' => $row->water_inward_ip_address,
				'water_inward_status' => $row->water_inward_status,
			];	
			array_push($inwardArray, $array);
		}
		return $inwardArray;
	}
	
	
	
}


