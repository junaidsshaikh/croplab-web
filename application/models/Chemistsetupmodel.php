<?php 

/*

	Model class: Chemistsetupmodel
	Base class: CI_Model
	Description: 
	
*/

class Chemistsetupmodel extends CI_Model {
	
	public function __construct() {
    	parent::__construct();
    	$this->load->model('farmersetupmodel', 'farmermodel');
    	$this->load->model('usersetupmodel', 'usermodel');
    	$this->load->model('mastersetupmodel', 'mastermodel');
    	$this->load->model('utilmodel', 'utilmodel');
  	}
	
	public function get_max_id($table_name, $table_id) {
	
		$row = $this->db->select_max($table_id)
					->get($table_name)->row_array();
		$max_id = $row[$table_id] + 1; 
		return $max_id;
	
	}
	
	public function find_plant_calculation_details_info($plant_inward_id) {
		$query = $this->db->where(["plant_inward_id"=> $plant_inward_id])
					->get("plant_calculation_info");	
		$row = $query->row();
		return $row;
	}
	
	public function plant_all_calculations_list_info_view() {
		$query = $this->db->or_where_in(["plant_calculation_status"=>"1", "plant_calculation_status"=>"2"])
					->get("plant_calculation_info");	
		$list = $query->result();
		return $list;
	}
	
	public function plant_all_calculations_num_row() {
		$query = $this->db->or_where_in(["plant_calculation_status"=>"1", "plant_calculation_status"=>"2"])
					->get("plant_calculation_info");	
		$rows = $query->num_rows();
		return $rows;
	}
	
	public function soil_all_calculations_list_info_view() {
		$query = $this->db->or_where_in(["soil_calculation_status"=>"1", "soil_calculation_status"=>"2"])
					->get("soil_calculation_info");	
		$list = $query->result();
		return $list;
	}
	
	public function water_all_calculations_list_info_view() {
		$query = $this->db->or_where_in(["water_calculation_status"=>"1", "water_calculation_status"=>"2"])
					->get("water_calculation_info");	
		$list = $query->result();
		return $list;
	}
	
	public function add_plant_calculation_details_info($plant_inward_id, $plantSampleId, $plantPercentN, $plantNON, $plantNHN, $plantPercentP, $plantPercentK, $plantPercentCa, $plantPercentMg, $plantPercentS, $plantFe, $plantMn, $plantZn, $plantCu, $plantB, $plantMo, $plantPercentNa, $plantPercentCl, $plantPercentCar, $plantPercentBic) {
	
		$plant_calculation_id = $this->get_max_id("plant_calculation_info", "plant_calculation_id");
		$array  =[
				'plant_calculation_id' => $plant_calculation_id,
				'plant_inward_id' => $plant_inward_id,
				'plant_inward_sample_id' => $plantSampleId,
				'plant_calculation_n' => $plantPercentN,
				'plant_calculation_no3' => $plantNON,				
				'plant_calculation_nh4' => $plantNHN,
				'plant_calculation_p' => $plantPercentP,
				'plant_calculation_k' => $plantPercentK,
				'plant_calculation_ca' => $plantPercentCa,
				'plant_calculation_mg' => $plantPercentMg,
				'plant_calculation_s' => $plantPercentS,
				'plant_calculation_fe' => $plantFe,
				'plant_calculation_mn' => $plantMn,
				'plant_calculation_zn' => $plantZn,
				'plant_calculation_cu' => $plantCu,
				'plant_calculation_bo' => $plantB,
				'plant_calculation_mo' => $plantMo,
				'plant_calculation_na' => $plantPercentNa,
				'plant_calculation_cl' => $plantPercentCl,	
				'plant_calculation_car' => $plantPercentCar,	
				'plant_calculation_bic' => $plantPercentBic,	
				'plant_calculation_date' => date("Y-m-d"),								
				'user_id' => $this->session->userdata('login_id'),
				'plant_calculation_ip_address' => $_SERVER['REMOTE_ADDR'],
				'plant_calculation_status' => "1",
		];	
		$rows = $this->db->insert('plant_calculation_info', $array);
		if($rows) 
			return $plant_calculation_id;
		else 
			return 0;
	}
	
	public function update_plant_calculation_details_info($analysis_date, $chemist, $plantSampleId, $plantPercentN, $plantNON, $plantNHN, $plantPercentP, $plantPercentK, $plantPercentCa, $plantPercentMg, $plantPercentS, $plantFe, $plantMn, $plantZn, $plantCu, $plantB, $plantMo, $plantPercentNa, $plantPercentCl, $plantPercentCar, $plantPercentBic) {
		$array  =[
				'plant_calculation_n' => $plantPercentN,
				'plant_calculation_no3' => $plantNON,				
				'plant_calculation_nh4' => $plantNHN,
				'plant_calculation_p' => $plantPercentP,
				'plant_calculation_k' => $plantPercentK,
				'plant_calculation_ca' => $plantPercentCa,
				'plant_calculation_mg' => $plantPercentMg,
				'plant_calculation_s' => $plantPercentS,
				'plant_calculation_fe' => $plantFe,
				'plant_calculation_mn' => $plantMn,
				'plant_calculation_zn' => $plantZn,
				'plant_calculation_cu' => $plantCu,
				'plant_calculation_bo' => $plantB,
				'plant_calculation_mo' => $plantMo,
				'plant_calculation_na' => $plantPercentNa,
				'plant_calculation_cl' => $plantPercentCl,	
				'plant_calculation_car' => $plantPercentCar,	
				'plant_calculation_bic' => $plantPercentBic,	
				//
				'plant_calculation_date' =>$analysis_date,
				'user_id' =>$chemist,
				'plant_calculation_ip_address' => $_SERVER['REMOTE_ADDR']
		];	
		$rows = $this->db
						 ->where("plant_inward_sample_id", $plantSampleId)
						 ->update('plant_calculation_info', $array);
		return $rows;
	}
	
	public function find_plant_calculation_details_by_sample_id_info($plant_inward_sample_id) {
		$query = $this->db->where(["plant_inward_sample_id"=> $plant_inward_sample_id])
					->or_where_in(["plant_calculation_status"=>"1", "plant_calculation_status"=>"2",])
					->get("plant_calculation_info");	
		$row = $query->row();
		return $row;
	}
	
	public function find_plant_calculation_by_smaple_id_info($plant_inward_sample_id) {
		$array = [];
		$query = $this->db->select(["plant_calculation_n", "plant_calculation_no3", "plant_calculation_nh4", "plant_calculation_p", "plant_calculation_k", "plant_calculation_ca", 
		"plant_calculation_mg", "plant_calculation_s", "plant_calculation_fe", "plant_calculation_mn", "plant_calculation_zn", "plant_calculation_cu", "plant_calculation_bo", 
		"plant_calculation_mo", "plant_calculation_na", "plant_calculation_cl", "plant_calculation_car", "plant_calculation_bic", "user_id"])
					->where(["plant_inward_sample_id"=> $plant_inward_sample_id])
					->or_where_in(["plant_calculation_status"=>"1", "plant_calculation_status"=>"2",])
					->get("plant_calculation_info");	
		$row = $query->row();
		if($row) {
			$user_id = $row->user_id;
			$user = $this->utilmodel->get_user_by_id_info($user_id);
			$array  =[
				'plant_calculation_n' => $row->plant_calculation_n,
				'plant_calculation_no3' => $row->plant_calculation_no3,				
				'plant_calculation_nh4' => $row->plant_calculation_nh4,
				'plant_calculation_p' => $row->plant_calculation_p,
				'plant_calculation_k' => $row->plant_calculation_k,
				'plant_calculation_ca' => $row->plant_calculation_ca,
				'plant_calculation_mg' => $row->plant_calculation_mg,
				'plant_calculation_s' => $row->plant_calculation_s,
				'plant_calculation_fe' => $row->plant_calculation_fe,
				'plant_calculation_mn' => $row->plant_calculation_mn,
				'plant_calculation_zn' => $row->plant_calculation_zn,
				'plant_calculation_cu' => $row->plant_calculation_cu,
				'plant_calculation_bo' => $row->plant_calculation_bo,
				'plant_calculation_mo' => $row->plant_calculation_mo,
				'plant_calculation_na' => $row->plant_calculation_na,
				'plant_calculation_cl' => $row->plant_calculation_cl,	
				'plant_calculation_car' => $row->plant_calculation_car,	
				'plant_calculation_bic' => $row->plant_calculation_bic,									
				'user_id' => $user,
			];	
		}
		
		return $array;
	}
	
	public function delete_plant_calculation_info($plant_inward_sample_id) {
		$query = $this->db->delete("plant_calculation_info", ["plant_inward_sample_id" => $plant_inward_sample_id]);
		return $query;
	}
	
	
	
	
	
	public function find_soil_calculation_by_smaple_id_info($soil_inward_sample_id) {
		$array = [];
		$query = $this->db->select(["soil_calculation_ph", "soil_calculation_ec", "soil_calculation_oc", "soil_calculation_n","soil_calculation_p", "soil_calculation_k", "soil_calculation_ca", 
		"soil_calculation_mg", "soil_calculation_s", "soil_calculation_fe", "soil_calculation_mn", "soil_calculation_zn", "soil_calculation_cu", "soil_calculation_bo", "soil_calculation_mo", 
		"soil_calculation_na", "soil_calculation_cl", "soil_calculation_caco3", "soil_calculation_car", "soil_calculation_bcar" ,"soil_calculation_no3", "soil_calculation_nh4", "soil_calculation_bd",
		"soil_calculation_stc", "soil_calculation_stt", "soil_calculation_sts", "soil_calculation_wh", "soil_calculation_cec", "user_id"])
					->where(["soil_inward_sample_id"=> $soil_inward_sample_id])
					->or_where_in(["soil_calculation_status"=>"1", "soil_calculation_status"=>"2",])
					->get("soil_calculation_info");	
		$row = $query->row();
		if($row) {
			$user_id = $row->user_id;
			$user = $this->utilmodel->get_user_by_id_info($user_id);
			$array  =[			
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
				'soil_calculation_bd' => $row->soil_calculation_bd,			
				'soil_calculation_stc' => $row->soil_calculation_stc,			
				'soil_calculation_stt' => $row->soil_calculation_stt,
				'soil_calculation_sts' => $row->soil_calculation_sts,		
				'soil_calculation_wh' => $row->soil_calculation_wh,		
				'soil_calculation_cec' => $row->soil_calculation_cec,
				'user_id' => $user,
			];	
		}
		return $array;
	}
	
	public function find_water_calculation_by_smaple_id_info($water_inward_sample_id) {
		$query = $this->db->select(["water_calculation_ph", "water_calculation_tds", "water_calculation_ec", "water_calculation_ca", "water_calculation_mg", "water_calculation_co3", "water_calculation_hco3", "water_calculation_na", "water_calculation_cl", "water_calculation_no3", "water_calculation_k", "water_calculation_cu","water_calculation_bo", "water_calculation_sar", "water_calculation_rsc", "user_id"])
					->where(["water_inward_sample_id"=> $water_inward_sample_id])
					->or_where_in(["water_calculation_status"=>"1", "water_calculation_status"=>"2",])
					->get("water_calculation_info");	
		$row = $query->row();
		if($row) {
			$user_id = $row->user_id;
			$user = $this->utilmodel->get_user_by_id_info($user_id);
			$array  =[			
				'water_calculation_ph' => $row->water_calculation_ph,
				'water_calculation_tds' => $row->water_calculation_tds,	
				'water_calculation_ec' => $row->water_calculation_ec,		
				'water_calculation_ca' => $row->water_calculation_ca,
				'water_calculation_mg' => $row->water_calculation_mg,
				'water_calculation_co3' => $row->water_calculation_co3,
				'water_calculation_hco3' => $row->water_calculation_hco3,
				'water_calculation_na' => $row->water_calculation_na,
				'water_calculation_cl' => $row->water_calculation_cl,	
				'water_calculation_k' => $row->water_calculation_k,
				'water_calculation_cu' => $row->water_calculation_cu,
				'water_calculation_no3' => $row->water_calculation_no3,
				'water_calculation_bo' => $row->water_calculation_bo,
				'water_calculation_sar' => $row->water_calculation_sar,
				'water_calculation_rsc' => $row->water_calculation_rsc,									
				'user_id' => $user,
			];	
		}
		return $array;
	}
	
	public function find_soil_calculation_details_info($soil_inward_id) {
		$query = $this->db->where(["soil_inward_id"=> $soil_inward_id])
					->or_where_in(["soil_calculation_status"=>"1", "soil_calculation_status"=>"2",])
					->get("soil_calculation_info");	
		$row = $query->row();
		return $row;
	}
	
	public function add_soil_calculation_details_info($soil_inward_id, $soilSampleId, $soilPh, $soilEc, $soilOc, $soilN, $soilPercentP, $soilPercentK, $soilPercentCa, $soilPercentMg, $soilPercentS, $soilFe, $soilMn, $soilZn, $soilCu, $soilB, $soilMo, $soilPercentNa, $soilPercentCl, $soilCaco, $soilCar, $soilBCar, $soilNO, $soilNH, $soilBd, $soilStc, $soilStt, $soilSts, $soilWh, $soilCec) {
	
		$soil_calculation_id = $this->get_max_id("soil_calculation_info", "soil_calculation_id");
		$array  =[
				'soil_calculation_id' => $soil_calculation_id,
				'soil_inward_id' => $soil_inward_id,
				'soil_inward_sample_id' => $soilSampleId,				
				'soil_calculation_ph' => $soilPh,
				'soil_calculation_ec' => $soilEc,
				'soil_calculation_oc' => $soilOc,				
				'soil_calculation_n' => $soilN,
				'soil_calculation_p' => $soilPercentP,
				'soil_calculation_k' => $soilPercentK,
				'soil_calculation_ca' => $soilPercentCa,
				'soil_calculation_mg' => $soilPercentMg,
				'soil_calculation_s' => $soilPercentS,
				'soil_calculation_fe' => $soilFe,
				'soil_calculation_mn' => $soilMn,
				'soil_calculation_zn' => $soilZn,
				'soil_calculation_cu' => $soilCu,
				'soil_calculation_bo' => $soilB,
				'soil_calculation_mo' => $soilMo,
				'soil_calculation_na' => $soilPercentNa,
				'soil_calculation_cl' => $soilPercentCl,					
				'soil_calculation_caco3' => $soilCaco,
				'soil_calculation_car' => $soilCar,	
				'soil_calculation_bcar' => $soilBCar,					
				'soil_calculation_no3' => $soilNO,				
				'soil_calculation_nh4' => $soilNH,		
				'soil_calculation_bd' => $soilBd,
				'soil_calculation_stc' => $soilStc,
				'soil_calculation_stt' => $soilStt,
				'soil_calculation_sts' => $soilSts,				
				'soil_calculation_wh' => $soilWh,
				'soil_calculation_cec' => $soilCec,				
				'soil_calculation_date' => date("Y-m-d"),								
				'user_id' => $this->session->userdata('login_id'),
				'soil_calculation_ip_address' => $_SERVER['REMOTE_ADDR'],
				'soil_calculation_status' => "1",
		];	
		$rows = $this->db->insert('soil_calculation_info', $array);
		if($rows) 
			return $soil_calculation_id;
		else 
			return 0;	
	}
	
	public function update_soil_calculation_details_info($analysis_date, $soilSampleId, $soilPh, $soilEc, $soilOc, $soilN, $soilPercentP, $soilPercentK, $soilPercentCa, $soilPercentMg, $soilPercentS, $soilFe, $soilMn, $soilZn, $soilCu, $soilB, $soilMo, $soilPercentNa, $soilPercentCl, $soilCaco, $soilCar, $soilBCar, $soilNO, $soilNH, $soilBd, $soilStc, $soilStt, $soilSts, $soilWh, $soilCec) {
		$array  =[			
				'soil_calculation_ph' => $soilPh,
				'soil_calculation_ec' => $soilEc,
				'soil_calculation_oc' => $soilOc,				
				'soil_calculation_n' => $soilN,
				'soil_calculation_p' => $soilPercentP,
				'soil_calculation_k' => $soilPercentK,
				'soil_calculation_ca' => $soilPercentCa,
				'soil_calculation_mg' => $soilPercentMg,
				'soil_calculation_s' => $soilPercentS,
				'soil_calculation_fe' => $soilFe,
				'soil_calculation_mn' => $soilMn,
				'soil_calculation_zn' => $soilZn,
				'soil_calculation_cu' => $soilCu,
				'soil_calculation_bo' => $soilB,
				'soil_calculation_mo' => $soilMo,
				'soil_calculation_na' => $soilPercentNa,
				'soil_calculation_cl' => $soilPercentCl,					
				'soil_calculation_caco3' => $soilCaco,
				'soil_calculation_car' => $soilCar,	
				'soil_calculation_bcar' => $soilBCar,					
				'soil_calculation_no3' => $soilNO,				
				'soil_calculation_nh4' => $soilNH,		
				'soil_calculation_bd' => $soilBd,
				'soil_calculation_stc' => $soilStc,
				'soil_calculation_stt' => $soilStt,
				'soil_calculation_sts' => $soilSts,				
				'soil_calculation_wh' => $soilWh,
				'soil_calculation_cec' => $soilCec,		
				//
				'soil_calculation_date' =>$analysis_date,
				'soil_calculation_ip_address' => $_SERVER['REMOTE_ADDR'],
		];	
		$rows = $this->db
						 ->where("soil_inward_sample_id", $soilSampleId)
						 ->update('soil_calculation_info', $array);
		
		return $rows;
	}
	
	public function find_soil_calculation_details_by_sample_id_info($soil_inward_sample_id) {
		$query = $this->db->where(["soil_inward_sample_id"=> $soil_inward_sample_id])
					->or_where_in(["soil_calculation_status"=>"1", "soil_calculation_status"=>"2",])
					->get("soil_calculation_info");	
		$row = $query->row();
		return $row;
	}
	
	public function delete_soil_calculation_info($soil_inward_sample_id) {
		$query = $this->db->delete("soil_calculation_info", ["soil_inward_sample_id" => $soil_inward_sample_id]);
		return $query;
	}
	
	
	
	
	
	
	
	public function find_water_calculation_details_info($water_inward_id) {
		$query = $this->db->where(["water_inward_id"=> $water_inward_id])
					->or_where_in(["water_calculation_status"=>"1", "water_calculation_status"=>"2",])
					->get("water_calculation_info");	
		$row = $query->row();
		
		return $row;
	}
	
	public function add_water_calculation_details_info($waterSampleId, $waterPh, $waterTds, $waterEc, $waterCa, $waterMg, $waterCo, $waterHco, $waterNa, $waterCl, $waterNON, $waterK, $waterCu, $waterBo, $waterSar, $waterRsc, $water_inward_id) {
		$water_calculation_id = $this->get_max_id("water_calculation_info", "water_calculation_id");
		$array  =[
				'water_calculation_id' => $water_calculation_id,
				'water_inward_id' => $water_inward_id,
				'water_inward_sample_id' => $waterSampleId,				
				'water_calculation_ph' => $waterPh,
				'water_calculation_tds' => $waterTds,	
				'water_calculation_ec' => $waterEc,		
				'water_calculation_ca' => $waterCa,
				'water_calculation_mg' => $waterMg,
				'water_calculation_co3' => $waterCo,
				'water_calculation_hco3' => $waterHco,
				'water_calculation_na' => $waterNa,
				'water_calculation_cl' => $waterCl,	
				'water_calculation_k' => $waterK,
				'water_calculation_cu' => $waterCu,
				'water_calculation_no3' => $waterNON,
				'water_calculation_bo' => $waterBo,
				'water_calculation_sar' => $waterSar,
				'water_calculation_rsc' => $waterRsc,						
				'water_calculation_date' => date("Y-m-d"),								
				'user_id' => $this->session->userdata('login_id'),
				'water_calculation_ip_address' => $_SERVER['REMOTE_ADDR'],
				'water_calculation_status' => "1",
		];	
		$rows = $this->db->insert('water_calculation_info', $array);
		
		return $rows;		
	}
	
	public function update_water_calculation_details_info($analysis_date, $waterSampleId, $waterPh, $waterTds, $waterEc, $waterCa, $waterMg, $waterCo, $waterHco, $waterNa, $waterCl, $waterNON, $waterK, $waterCu, $waterBo, $waterSar, $waterRsc) {
		$array  =[		
				'water_calculation_ph' => $waterPh,
				'water_calculation_tds' => $waterTds,	
				'water_calculation_ec' => $waterEc,		
				'water_calculation_ca' => $waterCa,
				'water_calculation_mg' => $waterMg,
				'water_calculation_co3' => $waterCo,
				'water_calculation_hco3' => $waterHco,
				'water_calculation_na' => $waterNa,
				'water_calculation_cl' => $waterCl,	
				'water_calculation_k' => $waterK,
				'water_calculation_cu' => $waterCu,
				'water_calculation_no3' => $waterNON,
				'water_calculation_bo' => $waterBo,
				'water_calculation_sar' => $waterSar,
				'water_calculation_rsc' => $waterRsc,	
				//
				'water_calculation_date' =>$analysis_date,			
				'water_calculation_ip_address' => $_SERVER['REMOTE_ADDR'],
		];	
		$rows = $this->db
						 ->where("water_inward_sample_id", $waterSampleId)
						 ->update('water_calculation_info', $array);
		return $rows;
	}
	
	public function find_water_calculation_details_by_sample_id_info($water_inward_sample_id) {
		$query = $this->db->where(["water_inward_sample_id"=> $water_inward_sample_id])
					->or_where_in(["water_calculation_status"=>"1", "water_calculation_status"=>"2",])
					->get("water_calculation_info");	
		$row = $query->row();
		return $row;
	}
	
	public function delete_water_calculation_info($water_inward_sample_id) {
		$query = $this->db->delete("water_calculation_info", ["water_inward_sample_id" => $water_inward_sample_id]);
		return $query;
	}
	
	/*******************************************************************************/
	
	public function update_plant_calculation_status($plantSampleId, $plantChemist, $plantAnalysisDate) {
		$array  =[						
				'user_id' => $plantChemist,
				'plant_calculation_date' => nice_date($plantAnalysisDate, "Y-m-d"),		
				'plant_calculation_status' => "2",
		];	
		$rows = $this->db
						 ->where("plant_inward_sample_id", $plantSampleId)
						 ->update('plant_calculation_info', $array);
		return $rows;
	}
	
	public function update_soil_calculation_status($soilSampleId, $soilChemist, $soilAnalysisDate) {
		$array  =[						
				'user_id' => $soilChemist,
				'soil_calculation_date' => nice_date($soilAnalysisDate, "Y-m-d"),	
				'soil_calculation_status' => "2",
		];	
		$rows = $this->db
						 ->where("soil_inward_sample_id", $soilSampleId)
						 ->update('soil_calculation_info', $array);
		return $rows;
	}
	public function update_water_calculation_status($waterSampleId, $waterChemist, $waterAnalysisDate) {
		$array  =[						
				'user_id' => $waterChemist,
				'water_calculation_date' => nice_date($waterAnalysisDate, "Y-m-d"),
				'water_calculation_status' => "2",
		];	
		$rows = $this->db
						 ->where("water_inward_sample_id", $waterSampleId)
						 ->update('water_calculation_info', $array);
		return $rows;
	}
}


