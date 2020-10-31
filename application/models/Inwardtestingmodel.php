<?php 

/*

	Model class: Usersetupmodel
	Base class: CI_Model
	Description: 
	
*/

class Inwardtestingmodel extends CI_Model {
	
	public function __construct() {
    	parent::__construct();
    	$this->load->model('farmersetupmodel', 'farmermodel');
    	$this->load->model('usersetupmodel', 'usermodel');
		
		//
		$this->load->model("utilmodel");	
  	}
	
	/*********************************************************/
	//				BEGIN: PLANT TESTING
	/*********************************************************/
	public function if_plant_sampl_id_exist($id){
		$query = $this->db->where(["plant_inward_sample_id"=>$id, "plant_calculation_status"=>"2"])
					->get("plant_calculation_info");		
		$list = $query->result();	
		return $list;
	}
	
	public function get_sample_id_list() {
		$query = $this->db->select(['plant_inward_info.plant_inward_sample_id'])
					->from('plant_inward_info')
					->join('plant_calculation_info', 'plant_calculation_info.plant_inward_sample_id = plant_inward_info.plant_inward_sample_id')
					->where(["plant_calculation_info.plant_calculation_status"=>"1"])
					->order_by("plant_inward_info.plant_inward_sample_id", 'ASC')
					->get();				
		$list = $query->result();	
		return $list;
	}
	
	public function get_chemist_list() {
							
		$query = $this->db->where(["user_role"=>"3", "user_status"=>"1"])
					->get("user_info");		
		$list = $query->result();	
		return $list;
	}
	
	public function find_plant_analysis_info($plantSampleId, $plantAnalysisDate) {
		$query = $this->db->where(["plant_inward_sample_id"=>$plantSampleId, "plant_calculation_date"=>nice_date($plantAnalysisDate, "Y-m-d"), "plant_calculation_status"=>"1"])
					->get("plant_calculation_info");		
		$rows = $query->row();	
		return $rows;
	}
	
	public function find_plant_analysis_by_sample_id($plantSampleId) {
	
		$query = $this->db->select(["plant_calculation_info.plant_inward_sample_id"])
						->from("plant_calculation_info")
						->join("plant_inward_info", "plant_inward_info.plant_inward_sample_id = plant_calculation_info.plant_inward_sample_id")
						->where(["plant_calculation_info.plant_inward_sample_id"=>$plantSampleId])
					->get();	
		
		$rows = $query->row();	
		
		return $rows;
	}
	
	public function find_plant_inward_by_smaple_id($sampleId) {
		$query = $this->db->select('*')
					->from('plant_inward_info')
					->join('plant_calculation_info', 'plant_calculation_info.plant_inward_sample_id = plant_inward_info.plant_inward_sample_id')
					->where(["plant_calculation_info.plant_inward_sample_id"=> $sampleId, "plant_inward_info.plant_inward_sample_id"=> $sampleId])
					->get();
		$rows = $query->row();
		return $rows;
	}	
	
	
	public function find_plant_inward_by_smaple_id_info($sampleId) {
		$array = [];
		$query = $this->db->select('plant_inward_info.plant_inward_id, plant_inward_info.plant_inward_farmer_name, plant_inward_info.plant_inward_date, plant_inward_info.plant_inward_received_date, plant_inward_info.plant_inward_received_through, plant_inward_info.plant_inward_sr_number, plant_inward_info.plant_inward_sample_id, plant_inward_info.plant_inward_plot_gat, plant_inward_info.plant_inward_sample_type, plant_inward_info.plant_inward_crop, plant_inward_info.plant_inward_variety, plant_inward_info.plant_inward_soil_type, plant_inward_info.plant_inward_cutting_date, plant_inward_info.plant_inward_pruning_days, plant_inward_info.plant_inward_stage, plant_inward_info.plant_inward_leaf, plant_inward_info.plant_inward_fee, plant_inward_info.plant_inward_pay_type, plant_inward_info.plant_inward_farmer_issue, plant_inward_info.user_id, plant_inward_info.plant_inward_add_date, plant_inward_info.plant_inward_status, plant_calculation_info.plant_calculation_id, plant_calculation_info.plant_inward_sample, plant_calculation_info.plant_calculation_date, plant_calculation_info.plant_calculation_status')
					->from('plant_inward_info')
					->join('plant_calculation_info', 'plant_calculation_info.plant_inward_sample_id = plant_inward_info.plant_inward_sample_id')
					->where(["plant_inward_info.plant_inward_sample_id"=> $sampleId, "plant_calculation_info.plant_inward_sample_id"=> $sampleId])
					->or_where_in(["plant_inward_info.plant_inward_status"=>"1", "plant_inward_info.plant_inward_status"=>"2"])
					->get();
		$row = $query->row();
		if($row) {
			//
			$farmer_id = $row->plant_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_address = $farmer_query->farmer_address;				
				$farmer_mobile = $farmer_query->farmer_mobile;
				//
				$farmer_taluka = $farmer_query->farmer_city;
				$taluka_query = $this->mastermodel->find_city_info($farmer_taluka);
				if($taluka_query) {
					$farmer_city = $taluka_query->city_name;
				}
				//
				$farmer_district = $farmer_query->farmer_district;
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {
					$farmer_district = $district_query->district_name;
				}
			}				
			
			//
			$received_name = $this->utilmodel->get_received_through_by_id_info($row->plant_inward_received_through);
			//
			$sample_type_name = $this->utilmodel->get_sample_type_by_id_info($row->plant_inward_sample_type);
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
			
		}
		
		$array = [
			'plant_inward_id' => $row->plant_inward_id,
			'plant_inward_farmer_name' => $farmer_name,
			'plant_inward_date' => $row->plant_inward_date,
			'plant_inward_received_date' => $row->plant_inward_received_date,
			'plant_inward_received_through' => $received_name,
			'plant_inward_sr_number' => $row->plant_inward_sr_number,
			'plant_inward_sample_id' => $row->plant_inward_sample_id,
			'plant_inward_plot_gat' => $row->plant_inward_plot_gat,
			'plant_inward_sample_type_id' => $row->plant_inward_sample_type,
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
			'user_id' => $inward_by_name,
			'plant_inward_add_date' =>  $row->plant_inward_add_date,
			'plant_inward_status' => $row->plant_inward_status,
			'plant_calculation_id' => $row->plant_calculation_id,
			'plant_inward_sample' => $row->plant_inward_sample,
			'plant_calculation_date' => $row->plant_calculation_date,
			'plant_calculation_status' => $row->plant_calculation_status,
			//--------------------------------------------------------------
			'farmer_city' => $farmer_city,
			'farmer_address' => $farmer_address,
			'farmer_district' => $farmer_district,
			'farmer_mobile' => $farmer_mobile,
		];
		
		return $array;
	}
	
	/*********************************************************/
	//				END: PLANT TESTING
	/*********************************************************/
	
	
	/*********************************************************/
	//				BEGIN: SOIL TESTING
	/*********************************************************/
	
	public function get_soil_sample_id_list() {
		$query = $this->db->select(['soil_inward_info.soil_inward_sample_id'])
					->from('soil_inward_info')
					->join('soil_calculation_info', 'soil_calculation_info.soil_inward_sample_id = soil_inward_info.soil_inward_sample_id')
					->where(["soil_calculation_info.soil_calculation_status"=>"1"])
					->order_by("soil_inward_info.soil_inward_sample_id", 'ASC')
					->get();
		$list = $query->result();	
		return $list;
	}
	
	public function find_soil_analysis_info($soilSampleId, $soilAnalysisDate) {
		$query = $this->db->where(["soil_inward_sample_id"=>$soilSampleId, "soil_calculation_date"=>nice_date($soilAnalysisDate, "Y-m-d"), "soil_calculation_status"=>"1"])
					->get("soil_calculation_info");		
		$rows = $query->row();	
		return $rows;
	}
	
	public function find_soil_analysis_by_sample_id($soilSampleId) {
		$query = $this->db->select(["soil_calculation_info.soil_inward_sample_id"])
						->from("soil_calculation_info")
						->join("soil_inward_info", "soil_inward_info.soil_inward_sample_id = soil_calculation_info.soil_inward_sample_id")
						->where(["soil_calculation_info.soil_calculation_status"=>"1", "soil_calculation_info.soil_inward_sample_id"=>$soilSampleId,])
					->get();	
		
		$rows = $query->row();	
		return $rows;
	}
	
	public function find_soil_inward_by_smaple_id_info($soilSampleId) {
		$array = [];
		$query = $this->db->select('*')
					->from('soil_inward_info')
					->join('soil_calculation_info', 'soil_calculation_info.soil_inward_sample_id = soil_inward_info.soil_inward_sample_id')
					->where(["soil_inward_info.soil_inward_status"=>"1", "soil_inward_info.soil_inward_sample_id"=> $soilSampleId])
					->get();
		$row = $query->row();
		if($row) {
			//
			$farmer_id = $row->soil_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_address = $farmer_query->farmer_address;				
				$farmer_mobile = $farmer_query->farmer_mobile;
				//
				$farmer_taluka = $farmer_query->farmer_city;
				$taluka_query = $this->mastermodel->find_city_info($farmer_taluka);
				if($taluka_query) {
					$farmer_city = $taluka_query->city_name;
				}
				//
				$farmer_district = $farmer_query->farmer_district;
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {
					$farmer_district = $district_query->district_name;
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
			
		}
		
		$array = [
			'soil_inward_id' => $row->soil_inward_id,
			'lab_id' => $row->lab_id,
			'soil_inward_farmer_name' => $farmer_name,
			'soil_inward_date' => $row->soil_inward_date,
			'soil_inward_received_date' => $row->soil_inward_received_date,
			'soil_inward_received_through' => $received_name,
			'soil_inward_sr_number' => $row->soil_inward_sr_number,
			'soil_inward_sample_id' => $row->soil_inward_sample_id,
			'soil_inward_plot_gat' => $row->soil_inward_plot_gat,
			'soil_inward_sample_type' => $sample_type_name,
			'soil_inward_crop' => $crop_name,
			'soil_inward_soil_type' => $soil_type_name,
			'soil_inward_fee' => $row->soil_inward_fee,
			'soil_inward_pay_type' => $payment_name,
			'soil_inward_farmer_issue' => $row->soil_inward_farmer_issue,
			'user_id' => $inward_by_name,
			'soil_inward_add_date' =>  $row->soil_inward_add_date,
			'soil_inward_status' => $row->soil_inward_status,
			'soil_calculation_id' => $row->soil_calculation_id,
			'soil_inward_sample' => $row->soil_inward_sample,
			'soil_calculation_ph' => $row->soil_calculation_ph,
			'soil_calculation_ec' => $row->soil_calculation_ec,
			'soil_calculation_oc' => $row->soil_calculation_oc,
			'soil_calculation_n' => $row->soil_calculation_n,
			'soil_calculation_p' => $row->soil_calculation_p,
			'soil_calculation_k' => $row->soil_calculation_k,
			'soil_calculation_ca' => $row->soil_calculation_ca,
			'soil_calculation_mg' => $row->soil_calculation_mg,
			'soil_calculation_s' => $row->soil_calculation_s,
			'soil_calculation_fe' => $row->soil_calculation_fe,
			'soil_calculation_mn' => $row->soil_calculation_mn,
			'soil_calculation_zn' => $row->soil_calculation_zn,
			'soil_calculation_cu' => $row->soil_calculation_cu,
			'soil_calculation_bo' => $row->soil_calculation_bo,
			'soil_calculation_mo' => $row->soil_calculation_mo,
			'soil_calculation_na' => $row->soil_calculation_na,
			'soil_calculation_cl' => $row->soil_calculation_cl,
			'soil_calculation_caco3' => $row->soil_calculation_caco3,
			'soil_calculation_car' => $row->soil_calculation_car,
			'soil_calculation_bcar' => $row->soil_calculation_bcar,
			'soil_calculation_no3' => $row->soil_calculation_no3,
			'soil_calculation_nh4' => $row->soil_calculation_nh4,
			'soil_calculation_stc' => $row->soil_calculation_stc,
			'soil_calculation_stt' => $row->soil_calculation_stt,
			'soil_calculation_sts' => $row->soil_calculation_sts,
			'soil_calculation_wh' => $row->soil_calculation_wh,
			'soil_calculation_cec' => $row->soil_calculation_cec,
			'soil_calculation_date' => $row->soil_calculation_date,
			'soil_calculation_status' => $row->soil_calculation_status,
			//--------------------------------------------------------------
			'farmer_city' => $farmer_city,
			'farmer_address' => $farmer_address,
			'farmer_district' => $farmer_district,
			'farmer_mobile' => $farmer_mobile,
		];
		
		return $array;
	}
	
	
	/*********************************************************/
	//				END: SOIL TESTING
	/*********************************************************/
	
	/*********************************************************/
	//				BEGIN: WATER TESTING
	/*********************************************************/
	
	public function get_water_sample_id_list() {
		$query = $this->db->select(['water_inward_info.water_inward_sample_id'])
					->from('water_inward_info')
					->join('water_calculation_info', 'water_calculation_info.water_inward_sample_id = water_inward_info.water_inward_sample_id')
					->where(["water_calculation_info.water_calculation_status"=>"1"])
					->order_by("water_inward_info.water_inward_sample_id", 'ASC')
					->get();			
		$list = $query->result();	
		return $list;
	}
	
	public function find_water_analysis_info($waterSampleId) {
		$query = $this->db->where(["water_inward_sample_id"=>$waterSampleId, "water_calculation_status"=>"1"])
					->get("water_calculation_info");		
		$rows = $query->row();	
		return $rows;
	}
	
	public function find_water_inward_by_smaple_id_info($waterSampleId) {
		$array = [];
		$query = $this->db->select('*')
					->from('water_inward_info')
					->join('water_calculation_info', 'water_calculation_info.water_inward_sample_id = water_inward_info.water_inward_sample_id')
					->where(["water_inward_info.water_inward_status"=>"1", "water_inward_info.water_inward_sample_id"=> $waterSampleId])
					->get();
		$row = $query->row();
		if($row) {
			//
			$farmer_id = $row->water_inward_farmer_name;
			$farmer_query = $this->farmermodel->find_farmer_info($farmer_id);
			if($farmer_query) {	
				$farmer_name = $farmer_query->farmer_name;
				$farmer_address = $farmer_query->farmer_address;				
				$farmer_mobile = $farmer_query->farmer_mobile;
				//
				$farmer_taluka = $farmer_query->farmer_city;
				$taluka_query = $this->mastermodel->find_city_info($farmer_taluka);
				if($taluka_query) {
					$farmer_city = $taluka_query->city_name;
				}
				//
				$farmer_district = $farmer_query->farmer_district;
				$district_query = $this->mastermodel->find_district_info($farmer_district);
				if($district_query) {
					$farmer_district = $district_query->district_name;
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
			
		}
		
		$array = [
			'water_inward_id' => $row->water_inward_id,
			'lab_id' => $row->lab_id,
			'water_inward_farmer_name' => $farmer_name,
			'water_inward_date' => $row->water_inward_date,
			'water_inward_received_date' => $row->water_inward_received_date,
			'water_inward_received_through' => $received_name,
			'water_inward_sr_number' => $row->water_inward_sr_number,
			'water_inward_sample_id' => $row->water_inward_sample_id,
			'water_inward_plot_gat' => $row->water_inward_plot_gat,
			'water_inward_crop' => $crop_name,
			'water_inward_water_source' => $water_source_name,
			'water_inward_fee' => $row->water_inward_fee,
			'water_inward_pay_type' => $payment_name,
			'water_inward_farmer_issue' => $row->water_inward_farmer_issue,
			'user_id' => $inward_by_name,
			'water_inward_add_date' =>  $row->water_inward_add_date,
			'water_inward_status' => $row->water_inward_status,
			'water_calculation_id' => $row->water_calculation_id,
			'water_inward_sample' => $row->water_inward_sample,
			'water_calculation_ph' => $row->water_calculation_ph,
			'water_calculation_tds' => $row->water_calculation_tds,
			'water_calculation_ec' => $row->water_calculation_ec,
			'water_calculation_ca' => $row->water_calculation_ca,
			'water_calculation_mg' => $row->water_calculation_mg,
			'water_calculation_co3' => $row->water_calculation_co3,
			'water_calculation_hco3' => $row->water_calculation_hco3,
			'water_calculation_na' => $row->water_calculation_na,
			'water_calculation_cl' => $row->water_calculation_cl,
			'water_calculation_no3' => $row->water_calculation_no3,
			'water_calculation_k' => $row->water_calculation_k,
			'water_calculation_cu' => $row->water_calculation_cu,
			'water_calculation_bo' => $row->water_calculation_bo,
			'water_calculation_sar' => $row->water_calculation_sar,
			'water_calculation_rsc' => $row->water_calculation_rsc,
			'water_calculation_date' => $row->water_calculation_date,
			'water_calculation_status' => $row->water_calculation_status,
			//--------------------------------------------------------------
			'farmer_city' => $farmer_city,
			'farmer_address' => $farmer_address,
			'farmer_district' => $farmer_district,
			'farmer_mobile' => $farmer_mobile,
		];
		
		return $array;
	}
	
	/*********************************************************/
	//				END: WATER TESTING
	/*********************************************************/
	
	
	
}


