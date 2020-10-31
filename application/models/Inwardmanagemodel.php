<?php 

/*

	Model class: Settingsmodel
	Base class: CI_Model
	Description: 
	
*/

class Inwardmanagemodel extends CI_Model {
	
	public function __construct() {
    	parent::__construct();
    	$this->load->model('farmersetupmodel', 'farmermodel');
    	$this->load->model('usersetupmodel', 'usermodel');
    	$this->load->model('mastersetupmodel', 'mastermodel');
		$this->load->model("chemistsetupmodel", "chemistmodel");	
		
		//
		$this->load->model("utilmodel");	
  	}
	
	public function get_max_id($table_name, $table_id) {
	
		$row = $this->db->select_max($table_id)
					->get($table_name)->row_array();
		$max_id = $row[$table_id] + 1; 
		return $max_id;
	
	}
	
	/*********************************************************/
	//				BEGIN: PLANT INWARD
	/*********************************************************/	 
	public function get_user_profile($user_id) {
							
		$query = $this->db->where(["user_id"=>$user_id, "user_status"=>"1"])
					->get("user_info");		
		$row = $query->row();		
		return $row;
	
	}
	
	public function get_plant_inward_list() {
		$inwardArray = [];
		$farmer_name = "";
		$query = $this->db->where(["plant_inward_status"=>"1"])
					->order_by("plant_inward_id", "DESC")
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
	
	public function plant_all_inward_num_row() {
		$query = $this->db->where(["plant_inward_status"=>"1"])
					->get("plant_inward_info");	
		$rows = $query->num_rows();
		return $rows;
	}
	
	public function find_edit_plant_inward_info($plant_inward_id) {
		$query = $this->db->where(["plant_inward_status"=>"1", "plant_inward_id"=> $plant_inward_id])
					->get("plant_inward_info");	
		$row = $query->row();
		return $row;
	}
	
	public function find_plant_inward_info($plant_inward_id) {
		$query = $this->db->where(["plant_inward_status"=>"1", "plant_inward_id"=> $plant_inward_id])
					->get("plant_inward_info");	
		$row = $query->row();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		if($row) {
			//
			$farmer_id = $row->plant_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
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
			//
			$inward_by_name = $this->utilmodel->get_user_by_id_info($row->user_id);
			
			$rupee_to_word = $this->convertToIndianCurrency($row->plant_inward_fee);
			
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
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
				'plant_inward_by' => $inward_by_name,
				'plant_inward_pay_id' => $row->plant_inward_pay_type,
				'rupee_to_word' => $rupee_to_word
			];	
		}
		return $array;
	}
	
	public function get_plant_inward_list_by_farmer_id_and_date($farmerId, $plantDate) {
		$arrayList = [];
		$query = $this->db->where(["plant_inward_status"=>"1", "plant_inward_farmer_name"=> $farmerId, "plant_inward_date"=> nice_date($plantDate, "Y-m-d")])
					->get("plant_inward_info");	
		$list = $query->result();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		foreach($list as $row) {
			//
			$farmer_id = $row->plant_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
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
			//
			$inward_by_name = $this->utilmodel->get_user_by_id_info($row->user_id);
			
			$rupee_to_word = $this->convertToIndianCurrency($row->plant_inward_fee);
			
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
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
				'plant_inward_by' => $inward_by_name,
				'plant_inward_pay_id' => $row->plant_inward_pay_type,
				'rupee_to_word' => $rupee_to_word
			];	
			array_push($arrayList, $array);
		}
		return $arrayList;
	}
	
	public function get_lab_info() {
		$query = $this->db->where(["lab_status"=>"1"])
					->get("lab_info");		
		$row = $query->row();		
		return $row;
	}
	
	public function add_plant_sample_info($plantFarmerName, $newPlantDate, $newPlantReceivedDate, $plantReceivedUser, $plantSampleId, $plantPlot, $plantSampleType, $plantCrop, $plantVariety, $plantSoilType, $newPlantCuttingDate, $plantPruningDays, $plantStage, $plantLeaf, $plantFees, $plantPayType, $plantFarmerIssue, $plantSampleIdType) {		
		
		$plantId = $this->get_max_id("plant_inward_info", "plant_inward_id");
		$array  =[
				'plant_inward_id' => $plantId,
				'lab_id' => $this->session->userdata("login_lab_id"),
				'plant_inward_farmer_name' => $plantFarmerName,
				'plant_inward_date' => $newPlantDate,
				'plant_inward_received_date' => $newPlantReceivedDate,
				'plant_inward_received_through' => $plantReceivedUser,				
				'plant_inward_sample_id' => $plantSampleId,		
				'plant_inward_sample_type_id' => $plantSampleIdType,
				'plant_inward_plot_gat' => $plantPlot,
				'plant_inward_sample_type' => $plantSampleType,
				'plant_inward_crop' => $plantCrop,
				'plant_inward_variety' => $plantVariety,
				'plant_inward_soil_type' => $plantSoilType,
				'plant_inward_cutting_date' => $newPlantCuttingDate,
				'plant_inward_pruning_days' => $plantPruningDays,
				'plant_inward_stage' => $plantStage,
				'plant_inward_leaf' => $plantLeaf,
				'plant_inward_fee' => $plantFees,
				'plant_inward_pay_type' => $plantPayType,
				'plant_inward_farmer_issue' => $plantFarmerIssue,				
				'user_id' => $this->session->userdata('login_id'),
				'plant_inward_add_date' => date("Y-m-d"),
				'plant_inward_ip_address' => $_SERVER['REMOTE_ADDR'],
				'plant_inward_status' => "1",
		];	
		$rows = $this->db->insert('plant_inward_info', $array);
		if($rows) 
			return $plantId;
		else 
			return 0;
	}
	
	public function update_plant_sample_info($plantFarmerName, $newPlantDate, $newPlantReceivedDate, $plantReceivedUser, $plantSampleId, $plantPlot, $plantSampleType, $plantCrop, $plantVariety, $plantSoilType, $newPlantCuttingDate, $plantPruningDays, $plantStage, $plantLeaf, $plantFees, $plantPayType, $plantFarmerIssue, $plant_inward_id, $plantSampleIdType) {
		$array  =[
				'lab_id' => $this->session->userdata("login_lab_id"),
				'plant_inward_farmer_name' => $plantFarmerName,
				'plant_inward_date' => $newPlantDate,
				'plant_inward_received_date' => $newPlantReceivedDate,
				'plant_inward_received_through' => $plantReceivedUser,				
				'plant_inward_sample_id' => $plantSampleId,
				'plant_inward_sample_type_id' => $plantSampleIdType,
				'plant_inward_plot_gat' => $plantPlot,
				'plant_inward_sample_type' => $plantSampleType,
				'plant_inward_crop' => $plantCrop,
				'plant_inward_variety' => $plantVariety,
				'plant_inward_soil_type' => $plantSoilType,
				'plant_inward_cutting_date' => $newPlantCuttingDate,
				'plant_inward_pruning_days' => $plantPruningDays,
				'plant_inward_stage' => $plantStage,
				'plant_inward_leaf' => $plantLeaf,
				'plant_inward_fee' => $plantFees,
				'plant_inward_pay_type' => $plantPayType,
				'plant_inward_farmer_issue' => $plantFarmerIssue,				
				'user_id' => $this->session->userdata('login_id'),
				'plant_inward_add_date' => date("Y-m-d"),
				'plant_inward_ip_address' => $_SERVER['REMOTE_ADDR'],
				'plant_inward_status' => "1",
		];	
		$rows = $this->db
						 ->where("plant_inward_id", $plant_inward_id)
						 ->update('plant_inward_info', $array);
		if($rows) 
			return $plant_inward_id;
		else 
			return 0;
	}
	
	public function get_plant_inward_farmer_info($plantFarmerId) {
		$array = [];
		$query_inward = $this->db->where(["plant_inward_id"=>$plantFarmerId])
					->get("plant_inward_info");	
		$row_inward = $query_inward->row();
		$farmer_name = "";
		if($row_inward) {
			$farmer_id = $row_inward->plant_inward_name;
			// FARMER
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
			}
			// RECEIVED USER
			$received_name = $this->utilmodel->get_received_through_by_id_info($row->plant_inward_received_through);
			
			$array = ['plant_inward_name'=>$farmer_name, 'plant_inward_received_through'=>$received_name, 'plant_inward_date'=>$row_inward->plant_inward_date, 'plant_inward_received_date'=>$row_inward->plant_inward_received_date];
		}
		return $array;
	}
	
	public function delete_plant_inward_info($plant_inward_id) {
		$query = $this->db->delete("plant_inward_info", ["plant_inward_id" => $plant_inward_id]);
		return $query;
	}
	/*********************************************************/
	//				END: PLANT INWARD
	/*********************************************************/	 
	
	
	
	/*********************************************************/
	//				BEGIN: SOIL INWARD
	/*********************************************************/	 
	
	public function get_soil_inward_list() {
		$inwardArray = [];
		$query = $this->db->where(["soil_inward_status"=>"1"])
					->order_by("soil_inward_id", "DESC")
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
	
	public function add_soil_sample_info($soilFarmerName, $newPlantDate, $newPlantReceivedDate, $soilReceivedUser, $soilSampleId, $soilPlot, $soilCrop, $soilSoilType, $soilFees, $soilPayType, $soilFarmerIssue, $soilSampleIdType) {
	
		$soilId = $this->get_max_id("soil_inward_info", "soil_inward_id");
		$array  =[
				'soil_inward_id' => $soilId,
				'lab_id' => $this->session->userdata("login_lab_id"),
				'soil_inward_farmer_name' => $soilFarmerName,
				'soil_inward_date' => $newPlantDate,
				'soil_inward_received_date' => $newPlantReceivedDate,
				'soil_inward_received_through' => $soilReceivedUser,				
				'soil_inward_sample_id' => $soilSampleId,			
				'soil_inward_sample_type_id' => $soilSampleIdType,
				'soil_inward_plot_gat' => $soilPlot,
				'soil_inward_crop' => $soilCrop,
				'soil_inward_soil_type' => $soilSoilType,
				'soil_inward_fee' => $soilFees,
				'soil_inward_pay_type' => $soilPayType,
				'soil_inward_farmer_issue' => $soilFarmerIssue,				
				'user_id' => $this->session->userdata('login_id'),
				'soil_inward_add_date' => date("Y-m-d"),
				'soil_inward_ip_address' => $_SERVER['REMOTE_ADDR'],
				'soil_inward_status' => "1",
		];	
		$rows = $this->db->insert('soil_inward_info', $array);
		if($rows) 
			return $soilId;
		else 
			return 0;
	}
	
	public function find_soil_inward_info($soil_inward_id) {
		$query = $this->db->where(["soil_inward_status"=>"1", "soil_inward_id"=> $soil_inward_id])
					->get("soil_inward_info");	
		$row = $query->row();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		if($row) {
			//
			$farmer_id = $row->soil_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
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
			//
			$inward_by_name = $this->utilmodel->get_user_by_id_info($row->user_id);
			
			$rupee_to_word = $this->convertToIndianCurrency($row->soil_inward_fee);
			
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
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
				'soil_inward_by' => $inward_by_name,
				'soil_inward_pay_id' => $row->soil_inward_pay_type,
				'rupee_to_word' => $rupee_to_word
			];	
		}
		return $array;
	}
	
	public function get_soil_inward_list_by_farmer_id_and_date($farmer_id, $soilDate){
		$arrayList = [];
		$query = $this->db->where(["soil_inward_status"=>"1", "soil_inward_farmer_name"=> $farmer_id, "soil_inward_date"=> nice_date($soilDate, "Y-m-d")])
					->get("soil_inward_info");	
		$list = $query->result();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		foreach($list as $row) {
			//
			$farmer_id = $row->soil_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
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
			//
			$inward_by_name = $this->utilmodel->get_user_by_id_info($row->user_id);
			
			$rupee_to_word = $this->convertToIndianCurrency($row->soil_inward_fee);
			
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
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
				'soil_inward_by' => $inward_by_name,
				'soil_inward_pay_id' => $row->soil_inward_pay_type,
				'rupee_to_word' => $rupee_to_word
			];	
			array_push($arrayList, $array);
		}
		return $arrayList;
	}
	
	public function soil_all_inward_num_row() {
		$query = $this->db->where(["soil_inward_status"=>"1"])
					->get("soil_inward_info");	
		$rows = $query->num_rows();
		return $rows;
	}
	
	public function find_edit_soil_inward_info($soil_inward_id) {
		$query = $this->db->where(["soil_inward_status"=>"1", "soil_inward_id"=> $soil_inward_id])
					->get("soil_inward_info");	
		$row = $query->row();
		return $row;
	}
	
	public function update_soil_sample_info($soilFarmerName, $newSoilDate, $newSoilReceivedDate, $soilReceivedUser, $soilSampleId, $soilPlot, $soilCrop, $soilSoilType, $soilFees, $soilPayType, $soilFarmerIssue, $soil_inward_id, $soilSampleIdType) {
		$array  =[
				'lab_id' => $this->session->userdata("login_lab_id"),
				'soil_inward_farmer_name' => $soilFarmerName,
				'soil_inward_date' => $newSoilDate,
				'soil_inward_received_date' => $newSoilReceivedDate,
				'soil_inward_received_through' => $soilReceivedUser,				
				'soil_inward_sample_id' => $soilSampleId,
				'soil_inward_sample_type_id' => $soilSampleIdType,
				'soil_inward_plot_gat' => $soilPlot,
				'soil_inward_crop' => $soilCrop,
				'soil_inward_soil_type' => $soilSoilType,
				'soil_inward_fee' => $soilFees,
				'soil_inward_pay_type' => $soilPayType,
				'soil_inward_farmer_issue' => $soilFarmerIssue,				
				'user_id' => $this->session->userdata('login_id'),
				'soil_inward_add_date' => date("Y-m-d"),
				'soil_inward_ip_address' => $_SERVER['REMOTE_ADDR'],
				'soil_inward_status' => "1",
		];	
		$rows = $this->db
						 ->where("soil_inward_id", $soil_inward_id)
						 ->update('soil_inward_info', $array);
		if($rows) 
			return $soil_inward_id;
		else 
			return 0;
	}
	
	public function delete_soil_inward_info($soil_inward_id) {
		$query = $this->db->delete("soil_inward_info", ["soil_inward_id" => $soil_inward_id]);
		return $query;
	}
	/*********************************************************/
	//				END: SOIL INWARD
	/*********************************************************/	 
	
	
	
	/*********************************************************/
	//				BEGIN: WATER INWARD
	/*********************************************************/	
	public function get_water_inward_list() {
		$inwardArray = [];
		$query = $this->db->where(["water_inward_status"=>"1"])
					->order_by("water_inward_id", "DESC")
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
	
	public function add_water_sample_info($waterFarmerName, $newWaterDate, $newWaterReceivedDate, $waterReceivedUser, $waterSampleId, $waterPlot, $waterCrop, $waterSource, $waterFees, $waterPayType, $waterFarmerIssue, $waterSampleIdType) {
	
		$waterId = $this->get_max_id("water_inward_info", "water_inward_id");
		$array  =[
				'water_inward_id' => $waterId,
				'lab_id' => $this->session->userdata("login_lab_id"),
				'water_inward_farmer_name' => $waterFarmerName,
				'water_inward_date' => $newWaterDate,
				'water_inward_received_date' => $newWaterReceivedDate,
				'water_inward_received_through' => $waterReceivedUser,				
				'water_inward_sample_id' => $waterSampleId,		
				'water_inward_sample_type_id' => $waterSampleIdType,
				'water_inward_plot_gat' => $waterPlot,
				'water_inward_water_source' => $waterSource,
				'water_inward_crop' => $waterCrop,
				'water_inward_fee' => $waterFees,
				'water_inward_pay_type' => $waterPayType,
				'water_inward_farmer_issue' => $waterFarmerIssue,				
				'user_id' => $this->session->userdata('login_id'),
				'water_inward_add_date' => date("Y-m-d"),
				'water_inward_ip_address' => $_SERVER['REMOTE_ADDR'],
				'water_inward_status' => "1",
		];	
		$rows = $this->db->insert('water_inward_info', $array);
		if($rows) 
			return $waterId;
		else 
			return 0;
	}
	
	public function find_water_inward_info($water_inward_id) {
		$query = $this->db->where(["water_inward_status"=>"1", "water_inward_id"=> $water_inward_id])
					->get("water_inward_info");	
		$row = $query->row();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		if($row) {
			//
			$farmer_id = $row->water_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
			}
			
			//
			$received_name = $this->utilmodel->get_received_through_by_id_info($row->water_inward_received_through);
			//
			$crop_name = $this->utilmodel->get_crop_type_by_id_info($row->water_inward_crop);		
			//
			$payment_name = $this->utilmodel->get_payment_by_id_info($row->water_inward_pay_type);
			//
			$water_source_name = $this->utilmodel->get_water_source_by_id_info($row->water_inward_water_source);	
			//
			$inward_by_name = $this->utilmodel->get_user_by_id_info($row->user_id);
			
			$rupee_to_word = $this->convertToIndianCurrency($row->water_inward_fee);
			
			$array  =[
				'water_inward_id' => $row->water_inward_id,
				'lab_id' => $row->lab_id,
				'water_inward_farmer_name' => $farmer_name,
				'water_inward_date' => $row->water_inward_date,
				'water_inward_received_date' => $row->water_inward_received_date,
				'water_inward_received_through' => $received_name,				
				'water_inward_sample_id' => $row->water_inward_sample_id,	
				'water_inward_sample_type_id' => $row->water_inward_sample_type_id,
				'water_inward_plot_gat' => $row->water_inward_plot_gat,
				'water_inward_water_source' => $water_source_name,
				'water_inward_crop' => $crop_name,
				'water_inward_fee' => $row->water_inward_fee,
				'water_inward_pay_type' => $payment_name,
				'water_inward_farmer_issue' => $row->water_inward_farmer_issue,		
				'user_id' => $row->user_id,
				'water_inward_add_date' => $row->water_inward_add_date,
				'water_inward_ip_address' => $row->water_inward_ip_address,
				'water_inward_status' => $row->water_inward_status,
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
				'water_inward_by' => $inward_by_name,
				'water_inward_pay_id' => $row->water_inward_pay_type,
				'rupee_to_word' => $rupee_to_word
			];	
		}
		return $array;
	}
	
	public function get_water_inward_list_by_farmer_id_and_date($farmerId, $waterDate) {
		$arrayList = [];
		$query = $this->db->where(["water_inward_status"=>"1", "water_inward_farmer_name"=> $farmerId, "water_inward_date"=> nice_date($waterDate, "Y-m-d")])
					->get("water_inward_info");	
		$list = $query->result();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		foreach($list as $row) {
			//
			$farmer_id = $row->water_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
			}
			
			//
			$received_name = $this->utilmodel->get_received_through_by_id_info($row->water_inward_received_through);
			//
			$crop_name = $this->utilmodel->get_crop_type_by_id_info($row->water_inward_crop);		
			//
			$payment_name = $this->utilmodel->get_payment_by_id_info($row->water_inward_pay_type);
			//
			$water_source_name = $this->utilmodel->get_water_source_by_id_info($row->water_inward_water_source);	
			//
			$inward_by_name = $this->utilmodel->get_user_by_id_info($row->user_id);
			
			$rupee_to_word = $this->convertToIndianCurrency($row->water_inward_fee);
			
			$array  =[
				'water_inward_id' => $row->water_inward_id,
				'lab_id' => $row->lab_id,
				'water_inward_farmer_name' => $farmer_name,
				'water_inward_date' => $row->water_inward_date,
				'water_inward_received_date' => $row->water_inward_received_date,
				'water_inward_received_through' => $received_name,				
				'water_inward_sample_id' => $row->water_inward_sample_id,	
				'water_inward_sample_type_id' => $row->water_inward_sample_type_id,
				'water_inward_plot_gat' => $row->water_inward_plot_gat,
				'water_inward_water_source' => $water_source_name,
				'water_inward_crop' => $crop_name,
				'water_inward_fee' => $row->water_inward_fee,
				'water_inward_pay_type' => $payment_name,
				'water_inward_farmer_issue' => $row->water_inward_farmer_issue,		
				'user_id' => $row->user_id,
				'water_inward_add_date' => $row->water_inward_add_date,
				'water_inward_ip_address' => $row->water_inward_ip_address,
				'water_inward_status' => $row->water_inward_status,
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
				'water_inward_by' => $inward_by_name,
				'water_inward_pay_id' => $row->water_inward_pay_type,
				'rupee_to_word' => $rupee_to_word
			];	
			array_push($arrayList, $array);
		}
		return $arrayList;
	}
	
	public function water_all_inward_num_row() {
		$query = $this->db->where(["water_inward_status"=>"1"])
					->get("water_inward_info");	
		$rows = $query->num_rows();
		return $rows;
	}
	
	public function find_edit_water_inward_info($water_inward_id) {
		$query = $this->db->where(["water_inward_status"=>"1", "water_inward_id"=> $water_inward_id])
					->get("water_inward_info");	
		$row = $query->row();
		return $row;
	}
	
	public function update_water_sample_info($waterFarmerName, $newWaterDate, $newWaterReceivedDate, $waterReceivedUser, $waterSampleId, $waterPlot, $waterCrop, $waterSource, $waterFees, $waterPayType, $waterFarmerIssue, $water_inward_id, $waterSampleIdType) {
		$array  =[
				'lab_id' => $this->session->userdata("login_lab_id"),
				'water_inward_farmer_name' => $waterFarmerName,
				'water_inward_date' => $newWaterDate,
				'water_inward_received_date' => $newWaterReceivedDate,
				'water_inward_received_through' => $waterReceivedUser,				
				'water_inward_sample_id' => $waterSampleId,
				'water_inward_sample_type_id' => $waterSampleIdType,
				'water_inward_plot_gat' => $waterPlot,
				'water_inward_water_source' => $waterSource,
				'water_inward_crop' => $waterCrop,
				'water_inward_fee' => $waterFees,
				'water_inward_pay_type' => $waterPayType,
				'water_inward_farmer_issue' => $waterFarmerIssue,				
				'user_id' => $this->session->userdata('login_id'),
				'water_inward_add_date' => date("Y-m-d"),
				'water_inward_ip_address' => $_SERVER['REMOTE_ADDR'],
				'water_inward_status' => "1",
		];	
		
		$rows = $this->db
						 ->where("water_inward_id", $water_inward_id)
						 ->update('water_inward_info', $array);
		if($rows) 
			return $water_inward_id;
		else 
			return 0;
	}
	
	public function delete_water_inward_info($water_inward_id) {
		$query = $this->db->delete("water_inward_info", ["water_inward_id" => $water_inward_id]);
		return $query;
	}
	/*********************************************************/
	//				END: WATER INWARD
	/*********************************************************/	
	
	
	public function get_plant_inward_list_for_calculation() {
		$inwardArray = [];
		$query = $this->db->where(["plant_inward_status"=>"1"])
					->order_by("plant_inward_id", "DESC")
					->get("plant_inward_info");	
		$list = $query->result();
		$farmer_name = "";
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
				
			//
			$plant_calculation_status = "<span class='badge badge-warning'>Pending</span>";
			$plant_inward_id = $row->plant_inward_id;
			$plant_query = $this->chemistmodel->find_plant_calculation_details_info($plant_inward_id);		
			if($plant_query) {	
				$plant_calculation_status = "<span class='badge badge-success'>Completed</span>";
			}		
			
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
				'plant_calculation_status' => $plant_calculation_status,
			];	
			array_push($inwardArray, $array);
		}
		return $inwardArray;
	}
	
	
	public function get_soil_inward_list_for_calculation() {
		$inwardArray = [];
		$query = $this->db->where(["soil_inward_status"=>"1"])
					->order_by("soil_inward_id", "DESC")
					->get("soil_inward_info");	
		$list = $query->result();
		$farmer_name = "";
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
				
			//
			$soil_calculation_status = "<span class='badge badge-warning'>Pending</span>";
			$soil_inward_id = $row->soil_inward_id;
			$soil_query = $this->chemistmodel->find_soil_calculation_details_info($soil_inward_id);		
			if($soil_query) {	
				$soil_calculation_status = "<span class='badge badge-success'>Completed</span>";
			}		
			
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
				'soil_calculation_status' => $soil_calculation_status,
			];	
			array_push($inwardArray, $array);
		}
		return $inwardArray;
	}
	
	
	
	public function get_water_inward_list_for_calculation() {
		$inwardArray = [];
		$query = $this->db->where(["water_inward_status"=>"1"])
					->order_by("water_inward_id", "DESC")
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
				
			//
			$water_calculation_status = "<span class='badge badge-warning'>Pending</span>";
			$water_inward_id = $row->water_inward_id;
			$water_query = $this->chemistmodel->find_water_calculation_details_info($water_inward_id);		
			if($water_query) {	
				$water_calculation_status = "<span class='badge badge-success'>Completed</span>";
			}			
			
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
				'water_calculation_status' => $row->water_inward_status,
				'water_inward_status' => $water_calculation_status,
			];	
			array_push($inwardArray, $array);
		}
		return $inwardArray;
	}
	
	
	
	public function find_stage_by_number_of_days($data) {
		$rows = [];
		$query = $this->db
					->where("stage_start_days <=".$data)
					->where("stage_end_days >=".$data)
					->where("stage_status", "1")
					->get("stage_info");		
		$rows = $query->result_array();		
		return $rows;
	}
	
	
	
	public function find_plant_inward_by_sample_id_info($plant_inward_sample_id) {
		$array = [];
		$query = $this->db->where(["plant_inward_status"=>"1", "plant_inward_sample_id"=> $plant_inward_sample_id])
					->get("plant_inward_info");	
		$row = $query->row();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		if($row) {
			//
			$farmer_id = $row->plant_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
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
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
			];	
		}
		return $array;
	}
	
	
	public function find_water_inward_by_sample_id_info($water_inward_sample_id) {
		$array=[];
		$query = $this->db->where(["water_inward_status"=>"1", "water_inward_sample_id"=> $water_inward_sample_id])
					->get("water_inward_info");	
		$row = $query->row();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		if($row) {
			//
			$farmer_id = $row->water_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
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
				'water_inward_water_source' => $water_source_name,
				'water_inward_crop' => $crop_name,
				'water_inward_fee' => $row->water_inward_fee,
				'water_inward_pay_type' => $payment_name,
				'water_inward_farmer_issue' => $row->water_inward_farmer_issue,		
				'user_id' => $row->user_id,
				'water_inward_add_date' => $row->water_inward_add_date,
				'water_inward_ip_address' => $row->water_inward_ip_address,
				'water_inward_status' => $row->water_inward_status,
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
			];	
		}
		return $array;
	}
	
	
	public function find_soil_inward_by_sample_id_info($soil_inward_sample_id) {
		$query = $this->db->where(["soil_inward_status"=>"1", "soil_inward_sample_id"=> $soil_inward_sample_id])
					->get("soil_inward_info");	
		$row = $query->row();
		$farmer_name = $farmer_city = $farmer_mobile = $farmer_address = $farmer_district = $city_name = $district_name = "";
		if($row) {
			//
			$farmer_id = $row->soil_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_city = $farmer_query->farmer_city;
				$farmer_mobile = $farmer_query->farmer_mobile;
				$farmer_address = $farmer_query->farmer_address;
				$farmer_district = $farmer_query->farmer_district;
				//
				$city_query = $this->mastermodel->find_city_info($farmer_city);
				if($city_query) {	
					$city_name = $city_query->city_name;
				}
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {	
					$district_name = $district_query->district_name;
				}
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
				//--------------------------------------------------------------
				'farmer_city' => $city_name,
				'farmer_address' => $farmer_address,
				'district_name' => $district_name,
				'farmer_mobile' => $farmer_mobile,
			];	
		}
		return $array;
	}
	
	
	
	
	
	public function find_plant_plot_by_farmer_id($farmr_id) {
		$rows = [];
		$query = $this->db->select("plant_inward_plot_gat")
					->where("plant_inward_farmer_name =".$farmr_id)
					->group_by("plant_inward_plot_gat")
					->get("plant_inward_info");		
		$rows = $query->result_array();		
		return $rows;
	}
	
	public function find_soil_plot_by_farmer_id($farmr_id) {
		$rows = [];
		$query = $this->db->select("soil_inward_plot_gat")
					->where("soil_inward_farmer_name =".$farmr_id)
					->group_by("soil_inward_plot_gat")
					->get("soil_inward_info");		
		$rows = $query->result_array();		
		return $rows;
	}
	
	public function find_water_plot_by_farmer_id($farmr_id) {
		$rows = [];
		$query = $this->db->select("water_inward_plot_gat")
					->where("water_inward_farmer_name =".$farmr_id)
					->group_by("water_inward_plot_gat")
					->get("water_inward_info");		
		$rows = $query->result_array();		
		return $rows;
	}
	
	public function find_plant_sample_id_is_exists($sample_id) {
		$query = $this->db
						->where(["plant_inward_sample_id" => $sample_id])
						->get("plant_inward_info");		
		$rows = $query->num_rows();	
		return $rows;	
	}
	
	public function find_water_sample_id_is_exists($sample_id) {
		$query = $this->db
						->where(["water_inward_sample_id" => $sample_id])
						->get("water_inward_info");		
		$rows = $query->num_rows();	
		return $rows;	
	}
	
	public function find_soil_sample_id_is_exists($sample_id) {
		$query = $this->db
						->where(["soil_inward_sample_id" => $sample_id])
						->get("soil_inward_info");		
		$rows = $query->num_rows();	
		return $rows;	
	}
	
	public function get_plant_received_date($sample_id) {
		$query = $this->db->select('plant_inward_received_date')
						->where(["plant_inward_sample_id" => $sample_id])
						->get("plant_inward_info");		
		$rows = $query->row();
		
		if($rows) {
		    $array = [
		        'plant_inward_received_date' => nice_date($rows->plant_inward_received_date, 'd-m-Y')
		        ];
		}
		
		return $array;	
	}
	
	
	public function get_soil_received_date($sample_id) {
		$query = $this->db->select('soil_inward_received_date')
						->where(["soil_inward_sample_id" => $sample_id])
						->get("soil_inward_info");		
		$rows = $query->row();
		
		if($rows) {
		    $array = [
		        'soil_inward_received_date' => nice_date($rows->soil_inward_received_date, 'd-m-Y')
		        ];
		}
		
		return $array;	
	}
	
	
	public function get_water_received_date($sample_id) {
		$query = $this->db->select('water_inward_received_date')
						->where(["water_inward_sample_id" => $sample_id])
						->get("water_inward_info");		
		$rows = $query->row();
		
		if($rows) {
		    $array = [
		        'water_inward_received_date' => nice_date($rows->water_inward_received_date, 'd-m-Y')
		        ];
		}
		
		return $array;	
	}
	
	public function convertToIndianCurrency($number){
	
		$no = round($number);
		$decimal = round($number - ($no = floor($number)), 2) * 100;    
		$digits_length = strlen($no);    
		$i = 0;
		$str = array();
		$words = array(
			0 => '',
			1 => 'One',
			2 => 'Two',
			3 => 'Three',
			4 => 'Four',
			5 => 'Five',
			6 => 'Six',
			7 => 'Seven',
			8 => 'Eight',
			9 => 'Nine',
			10 => 'Ten',
			11 => 'Eleven',
			12 => 'Twelve',
			13 => 'Thirteen',
			14 => 'Fourteen',
			15 => 'Fifteen',
			16 => 'Sixteen',
			17 => 'Seventeen',
			18 => 'Eighteen',
			19 => 'Nineteen',
			20 => 'Twenty',
			30 => 'Thirty',
			40 => 'Forty',
			50 => 'Fifty',
			60 => 'Sixty',
			70 => 'Seventy',
			80 => 'Eighty',
			90 => 'Ninety');
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($i < $digits_length) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += $divider == 10 ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
				$str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
			} else {
				$str [] = null;
			}  
		}
		
		$Rupees = implode(' ', array_reverse($str));
		$paise = ($decimal) ? "And Paise " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])  : '';
		return ($Rupees ? 'Rupees ' . $Rupees : '') . $paise . " Only";
	
	}
	
	/***********************************************************************************************************************/
	
	public function get_plant_inward_pagination($limit, $offset) {
		$inwardArray = [];
		$query = $this->db
							->select(['*'])
							->from('plant_inward_info')
							->limit($limit, $offset)
							->get();
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
	
	public function get_plant_inward_num_rows() {
		$query = $this->db
							->select(['*'])
							->from('plant_inward_info')
							->get();
		
		$artilces = $query->num_rows();
		
		return $artilces;
	}
	

	public function get_plant_inward_from_ajax() {
		$inwardArray = [];
		$query = $this->db
							->select(['*'])
							->from('plant_inward_info')
							->get();
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
	//******************
	public function plant_all_calculations_list_info_view() {
		$query = $this->db->where(["plant_calculation_status"=>"1"])
					->get("plant_calculation_info");	
		$list = $query->result();
		return $list;
	}

}


