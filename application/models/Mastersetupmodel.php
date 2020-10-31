<?php 

/*

	Controller class: Mastersetupmodel
	Base class: CI_Model
	Description: 
	
*/

class Mastersetupmodel extends CI_Model {
	
	public function __construct() {
    	parent::__construct();
		//
		$this->load->model("utilmodel");	
  	}
	
	/*********************************************************/
	//				BEGIN: WATER SOURCE
	/*********************************************************/
	public function add_water_source_info($waterSource) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'water_source_name' => $waterSource,
				'user_id' => $this->session->userdata('login_id'),
				'water_source_ip_address' => $_SERVER['REMOTE_ADDR'],
				'water_source_status' => "1",
		];
		$rows = $this->db->insert('water_source_info', $array);
		return $rows;
	
	}
	
	public function get_water_source_list() {
							
		$query = $this->db->where(["water_source_status"=>"1"])
					->get("water_source_info");
		
		$labList = $query->result();
		
		return $labList;
	}
	
	public function find_water_source_info($water_source_id) {
		$query = $this->db->where(["water_source_id"=>$water_source_id, "water_source_status"=>"1"])
					->get("water_source_info");
		
		$labDetails = $query->row();
		
		return $labDetails;
	}
	
	public function update_water_source_info($waterSource, $water_source_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'water_source_name' => $waterSource,
				'user_id' => $this->session->userdata('login_id'),
				'water_source_ip_address' => $_SERVER['REMOTE_ADDR'],
				'water_source_status' => "1",
		];
		$rows = $this->db
						 ->where("water_source_id", $water_source_id)
						 ->update('water_source_info', $array);
		return $rows;
	
	}
	
	public function delete_water_source_info($water_source_id) {
		$query = $this->db->delete("water_source_info", ["water_source_id" => $water_source_id]);
		return $query;
	}
	/*********************************************************/
	//				END: WATER SOURCE
	/*********************************************************/
	
	
	/*********************************************************/
	//				BEGIN: UNIT INFO
	/*********************************************************/	
	public function get_unit_list() {
		$query = $this->db->where(["unit_status"=>"1"])
					->get("unit_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_unit_info($unit_id) {
		$query = $this->db->where(["unit_id"=>$unit_id, "unit_status"=>"1"])
					->get("unit_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_unit_info($unitName) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'unit_name' => $unitName,
				'user_id' => $this->session->userdata('login_id'),
				'unit_ip_address' => $_SERVER['REMOTE_ADDR'],
				'unit_status' => "1",
		];
		$rows = $this->db->insert('unit_info', $array);
		return $rows;
	
	}
	
	public function update_unit_info($unitName, $unit_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'unit_name' => $unitName,
				'user_id' => $this->session->userdata('login_id'),
				'unit_ip_address' => $_SERVER['REMOTE_ADDR'],
				'unit_status' => "1",
		];
		$rows = $this->db
						 ->where("unit_id", $unit_id)
						 ->update('unit_info', $array);
		return $rows;
	
	}
	
	public function delete_unit_info($unit_id) {
		$query = $this->db->delete("unit_info", ["unit_id" => $unit_id]);
		return $query;
	}
	
	/*********************************************************/
	//				END: UNIT INFO
	/*********************************************************/	
	
	
	/*********************************************************/
	//				BEGIN: SAMPLE FROM
	/*********************************************************/	
	public function get_sample_from_list() {
		$query = $this->db->where(["sample_from_status"=>"1"])
					->get("sample_from_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_sample_from_info($sample_from_id) {
		$query = $this->db->where(["sample_from_id"=>$sample_from_id, "sample_from_status"=>"1"])
					->get("sample_from_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_sample_from_info($sampleFrom) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'sample_from_name' => $sampleFrom,
				'user_id' => $this->session->userdata('login_id'),
				'sample_from_ip_address' => $_SERVER['REMOTE_ADDR'],
				'sample_from_status' => "1",
		];
		$rows = $this->db->insert('sample_from_info', $array);
		return $rows;
	
	}
	
	public function update_sample_from_info($sampleFrom, $sample_from_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'sample_from_name' => $sampleFrom,
				'user_id' => $this->session->userdata('login_id'),
				'sample_from_ip_address' => $_SERVER['REMOTE_ADDR'],
				'sample_from_status' => "1",
		];
		$rows = $this->db
						 ->where("sample_from_id", $sample_from_id)
						 ->update('sample_from_info', $array);
		return $rows;
	
	}
	
	public function delete_sample_from_info($sample_from_id) {
		$query = $this->db->delete("sample_from_info", ["sample_from_id" => $sample_from_id]);
		return $query;
	}
	
	/*********************************************************/
	//				END: SAMPLE FROM
	/*********************************************************/	
	
					
	/*********************************************************/
	//				BEGIN: SAMPLE TYPE
	/*********************************************************/	
	public function get_sample_type_list() {
		$query = $this->db->where(["sample_type_status"=>"1"])
					->get("sample_type_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_sample_type_info($sample_type_id) {
		$query = $this->db->where(["sample_type_id"=>$sample_type_id, "sample_type_status"=>"1"])
					->get("sample_type_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_sample_type_info($sampleType) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'sample_type_name' => $sampleType,
				'user_id' => $this->session->userdata('login_id'),
				'sample_type_ip_address' => $_SERVER['REMOTE_ADDR'],
				'sample_type_status' => "1",
		];
		$rows = $this->db->insert('sample_type_info', $array);
		return $rows;
	
	}
	
	public function update_sample_type_info($sampleType, $sample_type_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'sample_type_name' => $sampleType,
				'user_id' => $this->session->userdata('login_id'),
				'sample_type_ip_address' => $_SERVER['REMOTE_ADDR'],
				'sample_type_status' => "1",
		];
		$rows = $this->db
						 ->where("sample_type_id", $sample_type_id)
						 ->update('sample_type_info', $array);
		return $rows;
	
	}
	
	public function delete_sample_type_info($sample_type_id) {
		$query = $this->db->delete("sample_type_info", ["sample_type_id" => $sample_type_id]);
		return $query;
	}	
	/*********************************************************/
	//				END: SAMPLE TYPE
	/*********************************************************/	
	
	
	/*********************************************************/
	//				BEGIN: STAGE INFO
	/*********************************************************/	
	public function get_stage_list() {
		$query = $this->db->where(["stage_status"=>"1"])
					->get("stage_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_stage_info($stage_id) {
		$query = $this->db->where(["stage_id"=>$stage_id, "stage_status"=>"1"])
					->get("stage_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_stage_info($stagePruning, $stageStartDays, $stageEndDays, $stagePeriodInDays, $stageName) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'stage_name' => $stageName,
				'stage_pruning' => $stagePruning,
				'stage_start_days' => $stageStartDays,
				'stage_end_days' => $stageEndDays,
				'stage_period_in_days' => $stagePeriodInDays,
				'user_id' => $this->session->userdata('login_id'),
				'stage_ip_address' => $_SERVER['REMOTE_ADDR'],
				'stage_status' => "1",
		];
		$rows = $this->db->insert('stage_info', $array);
		return $rows;
	
	}
	
	public function update_stage_info($stagePruning, $stageStartDays, $stageEndDays, $stagePeriodInDays, $stageName, $stage_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'stage_name' => $stageName,
				'stage_pruning' => $stagePruning,
				'stage_start_days' => $stageStartDays,
				'stage_end_days' => $stageEndDays,
				'stage_period_in_days' => $stagePeriodInDays,
				'user_id' => $this->session->userdata('login_id'),
				'stage_ip_address' => $_SERVER['REMOTE_ADDR'],
				'stage_status' => "1",
		];
		$rows = $this->db
						 ->where("stage_id", $stage_id)
						 ->update('stage_info', $array);
		return $rows;
	
	}
	
	public function delete_stage_info($stage_id) {
		$query = $this->db->delete("stage_info", ["stage_id" => $stage_id]);
		return $query;
	}	
	/*********************************************************/
	//				END: STAGE INFO
	/*********************************************************/	
	
	
	/*********************************************************/
	//				BEGIN: CROP INFO
	/*********************************************************/	
	public function get_crop_type_list() {
		$query = $this->db->where(["crop_status"=>"1"])
					->get("crop_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_crop_type_info($crop_type_id) {
		$query = $this->db->where(["crop_id"=>$crop_type_id, "crop_status"=>"1"])
					->get("crop_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_crop_type_info($cropType) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'crop_name' => $cropType,
				'user_id' => $this->session->userdata('login_id'),
				'crop_ip_address' => $_SERVER['REMOTE_ADDR'],
				'crop_status' => "1",
		];
		$rows = $this->db->insert('crop_info', $array);
		return $rows;
	
	}
	
	public function update_crop_type_info($cropType, $crop_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'crop_name' => $cropType,
				'user_id' => $this->session->userdata('login_id'),
				'crop_ip_address' => $_SERVER['REMOTE_ADDR'],
				'crop_status' => "1",
		];
		$rows = $this->db
						 ->where("crop_id", $crop_id)
						 ->update('crop_info', $array);
		return $rows;
	
	}
	
	public function delete_crop_type_info($crop_id) {
		$query = $this->db->delete("crop_info", ["crop_id" => $crop_id]);
		return $query;
	}	
	/*********************************************************/
	//				END: CROP INFO
	/*********************************************************/	
	
	
	/*********************************************************/
	//				BEGIN: PAYMENT INFO
	/*********************************************************/	
	public function get_payment_list() {
		$query = $this->db->where(["payment_status"=>"1"])
					->get("payment_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_payment_info($payment_id) {
		$query = $this->db->where(["payment_id"=>$payment_id, "payment_status"=>"1"])
					->get("payment_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_payment_info($paymentType) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'payment_name' => $paymentType,
				'user_id' => $this->session->userdata('login_id'),
				'payment_ip_address' => $_SERVER['REMOTE_ADDR'],
				'payment_status' => "1",
		];
		$rows = $this->db->insert('payment_info', $array);
		return $rows;
	
	}
	
	public function update_payment_info($paymentType, $payment_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'payment_name' => $paymentType,
				'user_id' => $this->session->userdata('login_id'),
				'payment_ip_address' => $_SERVER['REMOTE_ADDR'],
				'payment_status' => "1",
		];
		$rows = $this->db
						 ->where("payment_id", $payment_id)
						 ->update('payment_info', $array);
		return $rows;
	
	}
	
	public function delete_payment_info($payment_id) {
		$query = $this->db->delete("payment_info", ["payment_id" => $payment_id]);
		return $query;
	}
	/*********************************************************/
	//				END: PAYMENT INFO
	/*********************************************************/	
	
	
	
	/*********************************************************/
	//				BEGIN: VARIETY INFO
	/*********************************************************/	
	public function get_variety_list() {
		$query = $this->db->where(["variety_status"=>"1"])
					->get("variety_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_variety_info($variety_id) {
		$query = $this->db->where(["variety_id"=>$variety_id, "variety_status"=>"1"])
					->get("variety_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_variety_info($paymentType) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'variety_name' => $paymentType,
				'user_id' => $this->session->userdata('login_id'),
				'variety_ip_address' => $_SERVER['REMOTE_ADDR'],
				'variety_status' => "1",
		];
		$rows = $this->db->insert('variety_info', $array);
		return $rows;
	
	}
	
	public function update_variety_info($paymentType, $variety_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'variety_name' => $paymentType,
				'user_id' => $this->session->userdata('login_id'),
				'variety_ip_address' => $_SERVER['REMOTE_ADDR'],
				'variety_status' => "1",
		];
		$rows = $this->db
						 ->where("variety_id", $variety_id)
						 ->update('variety_info', $array);
		return $rows;
	
	}
	
	public function delete_variety_info($variety_id) {
		$query = $this->db->delete("variety_info", ["variety_id" => $variety_id]);
		return $query;
	}
	/*********************************************************/
	//				END: VARIETY INFO
	/*********************************************************/	
	
	
	
	/*********************************************************/
	//				BEGIN: SOIL TYPE 
	/*********************************************************/
	public function get_soil_type_list() {
		$query = $this->db->where(["soil_type_status"=>"1"])
					->get("soil_type_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_soil_type_info($soil_type_id) {
		$query = $this->db->where(["soil_type_id"=>$soil_type_id, "soil_type_status"=>"1"])
					->get("soil_type_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_soil_type_info($cropType) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'soil_type_name' => $cropType,
				'user_id' => $this->session->userdata('login_id'),
				'soil_type_ip_address' => $_SERVER['REMOTE_ADDR'],
				'soil_type_status' => "1",
		];
		$rows = $this->db->insert('soil_type_info', $array);
		return $rows;
	
	}
	
	public function update_soil_type_info($cropType, $soil_type_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'soil_type_name' => $cropType,
				'user_id' => $this->session->userdata('login_id'),
				'soil_type_ip_address' => $_SERVER['REMOTE_ADDR'],
				'soil_type_status' => "1",
		];
		$rows = $this->db
						 ->where("soil_type_id", $soil_type_id)
						 ->update('soil_type_info', $array);
		return $rows;
	
	}
	
	public function delete_soil_type_info($soil_type_id) {
		$query = $this->db->delete("soil_type_info", ["soil_type_id" => $soil_type_id]);
		return $query;
	}	
	/*********************************************************/
	//				END: SOIL TYPE 
	/*********************************************************/
	
	
	
	/*********************************************************/
	//				BEGIN: LEAF INFO
	/*********************************************************/
	public function get_leaf_list() {
		$query = $this->db->where(["leaf_status"=>"1"])
					->get("leaf_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_leaf_info($leaf_id) {
		$query = $this->db->where(["leaf_id"=>$leaf_id, "leaf_status"=>"1"])
					->get("leaf_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_leaf_info($leafType) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'leaf_name' => $leafType,
				'user_id' => $this->session->userdata('login_id'),
				'leaf_ip_address' => $_SERVER['REMOTE_ADDR'],
				'leaf_status' => "1",
		];
		$rows = $this->db->insert('leaf_info', $array);
		return $rows;
	
	}
	
	public function update_leaf_info($leafType, $leaf_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'leaf_name' => $leafType,
				'user_id' => $this->session->userdata('login_id'),
				'leaf_ip_address' => $_SERVER['REMOTE_ADDR'],
				'leaf_status' => "1",
		];
		$rows = $this->db
						 ->where("leaf_id", $leaf_id)
						 ->update('leaf_info', $array);
		return $rows;
	
	}
	
	public function delete_leaf_info($leaf_id) {
		$query = $this->db->delete("leaf_info", ["leaf_id" => $leaf_id]);
		return $query;
	}
	/*********************************************************/
	//				END: LEAF INFO
	/*********************************************************/
	
	
	
		
	/*********************************************************/
	//				BEGIN: PLANT PARAMETERS
	/*********************************************************/	   		
	public function get_plant_parameters_list() {
		
		// GET MAX ID
		/*$row = $this->db->select_max("plant_parameter_id")
					->get("plant_parameter_info")->row();
		$maxid = $row->plant_parameter_id+1; 
		print_r($maxid);*/
	
	    $arrayList = [];
	    
		$query = $this->db->where(["plant_parameter_status"=>"1"])
					->get("plant_parameter_info");		
		$list = $query->result();	
		foreach($list as $row) {			
			//
			$sample_type_name = $this->utilmodel->get_sample_type_by_id_info($row->plant_parameter_sample_type);
			//
			$crop_name = $this->utilmodel->get_crop_type_by_id_info($row->plant_parameter_crop);			
			//
			$stage_name = $this->utilmodel->get_stage_by_id_info($row->plant_parameter_stage);	
		    //
		    $parameter_name = $this->utilmodel->get_parameter_by_id_info($row->plant_parameter_name);
		    
		    $array  =[
				'plant_parameter_id' => $row->plant_parameter_id,
				'lab_id' => $row->lab_id,
				'plant_parameter_date' => $row->plant_parameter_date,
				'plant_parameter_crop' => $crop_name,
				'plant_parameter_stage' => $stage_name,
				'plant_parameter_sample_type' => $sample_type_name,
				'plant_parameter_sr_number' => $row->plant_parameter_sr_number,
				'plant_parameter_name' => $parameter_name,
				'plant_parameter_unit' => $row->plant_parameter_unit,
				'plant_parameter_lower' => $row->plant_parameter_lower,
				'plant_parameter_upper' => $row->plant_parameter_upper,
				'plant_parameter_limit' => $row->plant_parameter_limit,
				'user_id' => $row->plant_parameter_id,
				'plant_parameter_status' => $row->plant_parameter_status,
		    ];
		    array_push($arrayList, $array);
		    
		}
		return $arrayList;
	}
	public function find_plant_parameters_info($plant_parameter_id) {
		$query = $this->db->where(["plant_parameter_id"=>$plant_parameter_id, "plant_parameter_status"=>"1"])
					->get("plant_parameter_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_plant_parameter_info($plantCrop, $plantStage, $plantSampleType, $plantDate, $plantParameter, $plantParameterUnit, $plantLower, $plantUpper, $plantLimit) {
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'plant_parameter_crop' => $plantCrop,
				'plant_parameter_stage' => $plantStage,
				'plant_parameter_sample_type' => $plantSampleType,
				'plant_parameter_date' => nice_date($plantDate, "Y-m-d"),
				'plant_parameter_name' => $plantParameter,
				'plant_parameter_unit' => $plantParameterUnit,
				'plant_parameter_lower' => $plantLower,
				'plant_parameter_upper' => $plantUpper,
				'plant_parameter_limit' => $plantLimit,
				'user_id' => $this->session->userdata('login_id'),
				'plant_parameter_ip_address' => $_SERVER['REMOTE_ADDR'],
				'plant_parameter_status' => "1",
		];
		$rows = $this->db->insert('plant_parameter_info', $array);
		return $rows;
	}
	
	public function update_plant_parameter_info($plantCrop, $plantStage, $plantSampleType, $plantDate, $plantParameter, $plantParameterUnit, $plantLower, $plantUpper, $plantLimit, $plant_parameter_id) {
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'plant_parameter_crop' => $plantCrop,
				'plant_parameter_stage' => $plantStage,
				'plant_parameter_sample_type' => $plantSampleType,
				'plant_parameter_date' => nice_date($plantDate, "Y-m-d"),
				'plant_parameter_name' => $plantParameter,
				'plant_parameter_unit' => $plantParameterUnit,
				'plant_parameter_lower' => $plantLower,
				'plant_parameter_upper' => $plantUpper,
				'plant_parameter_limit' => $plantLimit,
				'user_id' => $this->session->userdata('login_id'),
				'plant_parameter_ip_address' => $_SERVER['REMOTE_ADDR'],
				'plant_parameter_status' => "1",
		];
		$rows = $this->db
						 ->where("plant_parameter_id", $plant_parameter_id)
						 ->update('plant_parameter_info', $array);
		return $rows;
	}
	
	public function delete_plant_parameters_info($plant_parameter_id) {
		$query = $this->db->delete("plant_parameter_info", ["plant_parameter_id" => $plant_parameter_id]);
		return $query;
	}
	/*********************************************************/
	//				END: PLANT PARAMETERS
	/*********************************************************/	
	
	
	
	/*********************************************************/
	//				BEGIN: SOIL PARAMETERS
	/*********************************************************/	  	
	public function get_soil_parameters_list() {
		$arrayList = [];
		$query = $this->db->where(["soil_parameter_status"=>"1"])
					->get("soil_parameter_info");		
		$list = $query->result();		
		foreach($list as $row) {			
		    //
		    $parameter_name = $this->utilmodel->get_parameter_by_id_info($row->soil_parameter_name);
			$array  =[
				'soil_parameter_id' => $row->soil_parameter_id,
				'lab_id' => $row->lab_id,
				'soil_parameter_name' => $parameter_name,
				'soil_parameter_description' => $row->soil_parameter_description,
				'soil_parameter_unit_to_measure' => $row->soil_parameter_unit_to_measure,
				'soil_parameter_limit' => $row->soil_parameter_limit,
				'user_id' => $row->user_id,
				'soil_parameter_ip_address' => $row->soil_parameter_ip_address,
				'soil_parameter_timestamp' => $row->soil_parameter_timestamp,
				'soil_parameter_status' => $row->soil_parameter_status,
			];
			
			array_push($arrayList, $array);
		}
		return $arrayList;
	}
	
	public function find_soil_parameters_info($soil_parameter_id) {
		$query = $this->db->where(["soil_parameter_id"=>$soil_parameter_id, "soil_parameter_status"=>"1"])
					->get("soil_parameter_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_soil_parameters_info($soilSampleType, $soilDescription, $soilUnitMeasure, $soilLimit) {
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'soil_parameter_name' => $soilSampleType,
				'soil_parameter_description' => $soilDescription,
				'soil_parameter_unit_to_measure' => $soilUnitMeasure,
				'soil_parameter_limit' => $soilLimit,
				'user_id' => $this->session->userdata('login_id'),
				'soil_parameter_ip_address' => $_SERVER['REMOTE_ADDR'],
				'soil_parameter_status' => "1",
		];
		$rows = $this->db->insert('soil_parameter_info', $array);
		return $rows;
	}
	
	public function update_soil_parameter_info($soilSampleType, $soilDescription, $soilUnitMeasure, $soilLimit, $soil_parameter_id) {
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'soil_parameter_name' => $soilSampleType,
				'soil_parameter_description' => $soilDescription,
				'soil_parameter_unit_to_measure' => $soilUnitMeasure,
				'soil_parameter_limit' => $soilLimit,
				'user_id' => $this->session->userdata('login_id'),
				'soil_parameter_ip_address' => $_SERVER['REMOTE_ADDR'],
				'soil_parameter_status' => "1",
		];
		$rows = $this->db
						 ->where("soil_parameter_id", $soil_parameter_id)
						 ->update('soil_parameter_info', $array);
		return $rows;
	}
	
	public function delete_soil_parameters_info($soil_parameter_id) {
		$query = $this->db->delete("soil_parameter_info", ["soil_parameter_id" => $soil_parameter_id]);
		return $query;
	}
	/*********************************************************/
	//				END: SOIL PARAMETERS
	/*********************************************************/	 
	
	
	/*********************************************************/
	//				BEGIN: WATER PARAMETERS
	/*********************************************************/	  
	public function get_water_parameters_list() {
		$arrayList = [];
		$query = $this->db->where(["water_parameter_status"=>"1"])
					->get("water_parameter_info");		
		$list = $query->result();	
		foreach($list as $row) {			
		    //
		    $parameter_name = $this->utilmodel->get_parameter_by_id_info($row->water_parameter_name);
			$array  =[
				'water_parameter_id' => $row->water_parameter_id,
				'lab_id' => $row->lab_id,
				'water_parameter_name' => $parameter_name,
				'water_parameter_description' => $row->water_parameter_description,
				'water_parameter_unit_to_measure' => $row->water_parameter_unit_to_measure,
				'water_parameter_limit' => $row->water_parameter_limit,
				'user_id' => $row->user_id,
				'water_parameter_ip_address' => $row->water_parameter_ip_address,
				'water_parameter_timestamp' => $row->water_parameter_timestamp,
				'water_parameter_status' => $row->water_parameter_status,
			];
			
			array_push($arrayList, $array);
		}	
		return $arrayList;
	}
	
	public function find_water_parameters_info($water_parameter_id) {
		$query = $this->db->where(["water_parameter_id"=>$water_parameter_id, "water_parameter_status"=>"1"])
					->get("water_parameter_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_water_parameters_info($waterSampleType, $waterDescription, $waterUnitMeasure, $waterLimit) {
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'water_parameter_name' => $waterSampleType,
				'water_parameter_description' => $waterDescription,
				'water_parameter_unit_to_measure' => $waterUnitMeasure,
				'water_parameter_limit' => $waterLimit,
				'user_id' => $this->session->userdata('login_id'),
				'water_parameter_ip_address' => $_SERVER['REMOTE_ADDR'],
				'water_parameter_status' => "1",
		];
		$rows = $this->db->insert('water_parameter_info', $array);
		return $rows;
	}
	
	public function update_water_parameter_info($waterSampleType, $waterDescription, $waterUnitMeasure, $waterLimit, $water_parameter_id) {
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'water_parameter_name' => $waterSampleType,
				'water_parameter_description' => $waterDescription,
				'water_parameter_unit_to_measure' => $waterUnitMeasure,
				'water_parameter_limit' => $waterLimit,
				'user_id' => $this->session->userdata('login_id'),
				'water_parameter_ip_address' => $_SERVER['REMOTE_ADDR'],
				'water_parameter_status' => "1",
		];
		$rows = $this->db
						 ->where("water_parameter_id", $water_parameter_id)
						 ->update('water_parameter_info', $array);
		return $rows;
	}
	
	public function delete_water_parameters_info($water_parameter_id) {
		$query = $this->db->delete("water_parameter_info", ["water_parameter_id" => $water_parameter_id]);
		return $query;
	}
	/*********************************************************/
	//				END: WATER PARAMETERS
	/*********************************************************/	  
	
	
	
	/*********************************************************/
	//				BEGIN: USER ROLE
	/*********************************************************/
	public function add_user_role_info($userRole) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'user_role_name' => $userRole,
				'user_id' => $this->session->userdata('login_id'),
				'user_role_ip_address' => $_SERVER['REMOTE_ADDR'],
				'user_role_status' => "1",
		];
		$rows = $this->db->insert('user_role_info', $array);
		return $rows;
	
	}
	
	public function get_user_role_list() {
							
		$query = $this->db->where(["user_role_status"=>"1"])
					->get("user_role_info");
		
		$labList = $query->result();
		
		return $labList;
	}
	
	public function find_user_role_info($user_role_id) {
		$query = $this->db->where(["user_role_id"=>$user_role_id, "user_role_status"=>"1"])
					->get("user_role_info");
		
		$labDetails = $query->row();
		
		return $labDetails;
	}
	
	public function update_user_role_info($userRole, $user_role_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'user_role_name' => $userRole,
				'user_id' => $this->session->userdata('login_id'),
				'user_role_ip_address' => $_SERVER['REMOTE_ADDR'],
				'user_role_status' => "1",
		];
		$rows = $this->db
						 ->where("user_role_id", $user_role_id)
						 ->update('user_role_info', $array);
		return $rows;
	
	}
	
	public function delete_user_role_info($user_role_id) {
		$query = $this->db->delete("user_role_info", ["user_role_id" => $user_role_id]);
		return $query;
	}
	/*********************************************************/
	//				END: USER ROLE
	/*********************************************************/
	
	
	
	/*********************************************************/
	//				BEGIN: PARAMETER INFO
	/*********************************************************/
	
	public function add_parameter_info($parameterInfo, $parameterMarathiInfo){
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'parameter_name' => $parameterInfo,
				'parameter_name_marathi' =>$parameterMarathiInfo,
				'user_id' => $this->session->userdata('login_id'),
				'parameter_ip_address' => $_SERVER['REMOTE_ADDR'],
				'parameter_status' => "1",
		];
		$rows = $this->db->insert('parameter_type_info', $array);
		return $rows;
	
	}
	
	public function get_parameter_list(){
	
		$query = $this->db->where(["parameter_status"=>"1"])
						->get("parameter_type_info");
						
		$parameterList = $query->result();
		
		return $parameterList;				
	}
	
	public function find_parameter_info($parameter_id) {
		$query = $this->db->where(["parameter_id"=>$parameter_id, "parameter_status"=>"1"])
					->get("parameter_type_info");
		
		$parameterDetails = $query->row();
		
		return $parameterDetails;
	}
	
	public function update_parameter_info($parameter_id, $parameterInfo, $parameterMarathiInfo) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'parameter_name' => $parameterInfo,
				'parameter_name_marathi' =>$parameterMarathiInfo,
				'user_id' => $this->session->userdata('login_id'),
				'parameter_ip_address' => $_SERVER['REMOTE_ADDR'],
				'parameter_status' => "1",
		];
		$rows = $this->db
						 ->where("parameter_id", $parameter_id)
						 ->update('parameter_type_info', $array);
						 
		return $rows;
	
	}
	
	public function delete_parameter_info($parameter) {
		$query = $this->db->delete("parameter_type_info", ["parameter_id" => $parameter]);
		return $query;
	}
	
	/*********************************************************/
	//				END: PARAMETER INFO
	/*********************************************************/
	
	/*********************************************************/
	//				BEGIN: CITY INFO
	/*********************************************************/
	
	public function get_city_list() {
		$query = $this->db->where(["city_status"=>"1"])
					->get("city_info");		
		$list = $query->result();		
		return $list;
	}
	
	public function find_city_info($city_id) {
		$query = $this->db->where(["city_id"=>$city_id, "city_status"=>"1"])
					->get("city_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_city_info($cityName, $districtName) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'city_name' => $cityName,
				'district_id' => $districtName,
				'user_id' => $this->session->userdata('login_id'),
				'city_ip_address' => $_SERVER['REMOTE_ADDR'],
				'city_status' => "1",
		];
		$rows = $this->db->insert('city_info', $array);
		return $rows;
	
	}
	
	public function update_city_info($cityType, $districtName, $city_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'city_name' => $cityType,
				'district_id' => $districtName,
				'user_id' => $this->session->userdata('login_id'),
				'city_ip_address' => $_SERVER['REMOTE_ADDR'],
				'city_status' => "1",
		];
		$rows = $this->db
						 ->where("city_id", $city_id)
						 ->update('city_info', $array);
		return $rows;
	
	}
	
	public function delete_city_info($city_id) {
		$query = $this->db->delete("city_info", ["city_id" => $city_id]);
		return $query;
	}
	
	public function get_district_by_city_list() {
		$listArray = [];
		$query = $this->db->where(["city_status"=>"1"])
					->get("city_info");		
		$list = $query->result();	
		foreach($list as $row) {
			$district_id = $row->district_id;
			$district_query = $this->find_district_info($district_id);		
			if($district_query) {	
				$district_name = $district_query->district_name;
			}	
			$array = [
				'city_id' => $row->city_id,
				'lab_id' => $row->lab_id,
				'city_name' => $row->city_name,
				'district_id' => $district_name,
				'user_id' => $row->user_id,
				'city_status' => $row->city_status
			];
			array_push($listArray, $array);
		}
		return $listArray;
	}
	
	
	/*********************************************************/
	//				END: CITY INFO
	/*********************************************************/
	
	
	/*********************************************************/
	//				BEGIN: DISTRICT INFO
	/*********************************************************/
	
	public function get_district_list() {
		$query = $this->db->where(["district_status"=>"1"])
					 ->order_by('district_name','ASC')
					->get("district_info");		
		$list = $query->result();	
		return $list;
	}
	
	
	public function find_district_info($district_id) {
		$query = $this->db->where(["district_id"=>$district_id, "district_status"=>"1"])
					->get("district_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_district_info($districtName) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'district_name' => $districtName,
				'user_id' => $this->session->userdata('login_id'),
				'district_ip_address' => $_SERVER['REMOTE_ADDR'],
				'district_status' => "1",
		];
		$rows = $this->db->insert('district_info', $array);
		return $rows;
	
	}
	
	public function update_district_info($districtType, $district_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'district_name' => $districtType,
				'user_id' => $this->session->userdata('login_id'),
				'district_ip_address' => $_SERVER['REMOTE_ADDR'],
				'district_status' => "1",
		];
		$rows = $this->db
						 ->where("district_id", $district_id)
						 ->update('district_info', $array);
		return $rows;
	
	}
	
	public function delete_district_info($district_id) {
		$query = $this->db->delete("district_info", ["district_id" => $district_id]);
		return $query;
	}
	
	/*********************************************************/
	//				END: DISTRICT INFO
	/*********************************************************/
	
	
	
	/*********************************************************/
	//				BEGIN: RECEIVED THROUGH INFO
	/*********************************************************/
	
	public function get_received_through_list() {
		$query = $this->db->where(["received_through_status"=>"1"])
					 ->order_by('received_through_name','ASC')
					->get("received_through_info");		
		$list = $query->result();	
		return $list;
		
	}
	
	public function find_received_through_info($received_id) {
		$query = $this->db->where(["received_through_id"=>$received_id, "received_through_status"=>"1"])
					->get("received_through_info");		
		$rows = $query->row();		
		return $rows;
	}
	
	public function add_received_through_info($receivedThrough) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'received_through_name' => $receivedThrough,
				'user_id' => $this->session->userdata('login_id'),
				'received_through_ip_address' => $_SERVER['REMOTE_ADDR'],
				'received_through_status' => "1",
		];
		$rows = $this->db->insert('received_through_info', $array);
		return $rows;
	
	
	}
	
	public function update_received_through_info($received, $received_through_id) {
	
		$array  =[
				'lab_id' => $this->session->userdata('login_lab_id'),
				'received_through_name' => $received,
				'user_id' => $this->session->userdata('login_id'),
				'received_through_ip_address' => $_SERVER['REMOTE_ADDR'],
				'received_through_status' => "1",
		];
		$rows = $this->db
						 ->where("received_through_id", $received_through_id)
						 ->update('received_through_info', $array);
		return $rows;
	
	}
	
	public function delete_received_through_info($received_through_id) {
		$query = $this->db->delete("received_through_info", ["received_through_id" => $received_through_id]);
		return $query;
	}
	
	/*********************************************************/
	//				END: RECEIVED THROUGH INFO
	/*********************************************************/
	
	public function find_city_city_by_district($data) {
		$rows = [];
		$query = $this->db->where(["district_id"=>$data, "city_status"=>"1"])
					->get("city_info");		
		$rows = $query->result_array();		
		return $rows;
	}
	
	
	public function find_plant_parameters_by_stage_info($plant_parameter_stage, $plant_inward_crop, $plant_inward_sample_type) {
		$arrayList = [];
		$query = $this->db->where(["plant_parameter_stage"=>$plant_parameter_stage, "plant_parameter_status"=>"1", "plant_parameter_crop"=>$plant_inward_crop, "plant_parameter_sample_type"=>$plant_inward_sample_type])
					->get("plant_parameter_info");		
		$list = $query->result();		
		foreach($list as $row) {
		
			$sample_type_name = $this->utilmodel->get_sample_type_by_id_info($row->plant_parameter_sample_type);
			//
			$crop_name = $this->utilmodel->get_crop_type_by_id_info($row->plant_parameter_crop);
			//
			$plant_parameter_name = $this->utilmodel->get_parameter_by_id_info($row->plant_parameter_name);
			//
			$parameter_name_marathi = $this->utilmodel->get_parameter_marathi_by_id_info($row->plant_parameter_name);
			//
			//$plant_parameter_unit = $this->utilmodel->get_unit_parameter_by_id_info($row->plant_parameter_name);
			//
			$stage_name = $this->utilmodel->get_stage_by_id_info($row->plant_parameter_stage);	
			
			$array = [
				'plant_parameter_id' => $row->plant_parameter_id,
				'lab_id' => $row->lab_id,
				'plant_parameter_crop' => $crop_name,
				'plant_parameter_stage' => $stage_name,
				'plant_parameter_sample_type' => $sample_type_name,
				'plant_parameter_sr_number' => $row->plant_parameter_sr_number,
				'plant_parameter_name' => $plant_parameter_name,
				'parameter_name_marathi' => $parameter_name_marathi,
				//'plant_parameter_unit' => $plant_parameter_unit,
				'plant_parameter_unit' => $row->plant_parameter_unit,
				'plant_parameter_lower' => $row->plant_parameter_lower,
				'plant_parameter_upper' => $row->plant_parameter_upper,
				'plant_parameter_limit' => $row->plant_parameter_limit,
				'plant_parameter_status' => $row->plant_parameter_status,
			];
			array_push($arrayList, $array);
		}
		return $arrayList;
	}
	
	public function find_soil_parameters_by_stage_info() {
		$arrayList = [];
		$query = $this->db->where(["soil_parameter_status"=>"1"])
					->get("soil_parameter_info");		
		$list = $query->result();		
		foreach($list as $row) {
			//
			$parameter_name_english = $this->utilmodel->get_parameter_by_id_info($row->soil_parameter_name);
			//
			$parameter_name_marathi = $this->utilmodel->get_parameter_marathi_by_id_info($row->soil_parameter_name);
			
			$array = [
				'soil_parameter_id' => $row->soil_parameter_id,
				'lab_id' => $row->lab_id,
				'soil_parameter_name' => $parameter_name_english,
				'soil_parameter_name_marathi' => $parameter_name_marathi,
				'soil_parameter_unit_to_measure' => $row->soil_parameter_unit_to_measure,
				'soil_parameter_limit' => $row->soil_parameter_limit,
			];
			array_push($arrayList, $array);
		}
		return $arrayList;
	}
	
	public function find_water_parameters_by_stage_info() {
		$arrayList = [];
		$query = $this->db->where(["water_parameter_status"=>"1"])
					->get("water_parameter_info");		
		$list = $query->result();		
		foreach($list as $row) {
			//
			$parameter_name_english = $this->utilmodel->get_parameter_by_id_info($row->water_parameter_name);
			//
			$parameter_name_marathi = $this->utilmodel->get_parameter_marathi_by_id_info($row->water_parameter_name);
			
			$array = [
				'water_parameter_id' => $row->water_parameter_id,
				'lab_id' => $row->lab_id,
				'water_parameter_name' => $parameter_name_english,
				'water_parameter_name_marathi' => $parameter_name_marathi,
				'water_parameter_unit_to_measure' => $row->water_parameter_unit_to_measure,
				'water_parameter_limit' => $row->water_parameter_limit,
			];
			array_push($arrayList, $array);
		}
		return $arrayList;
	}
}


