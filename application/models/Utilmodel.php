<?php 

/*

	Model class: Utilmodel
	Base class: CI_Model
	Description: 
	
*/

class Utilmodel extends CI_Model {
	
	public function __construct() {
    	parent::__construct();
    	$this->load->model('mastersetupmodel', 'mastermodel');
    	$this->load->model('usersetupmodel', 'usermodel');
		$this->load->model("chemistsetupmodel", "chemistmodel");	
    	$this->load->model('farmersetupmodel', 'farmermodel');
  	}
	
	public function get_max_id($table_name, $table_id) {
	
		$row = $this->db->select_max($table_id)
					->get($table_name)->row_array();
		$max_id = $row[$table_id] + 1; 
		return $max_id;
	
	}
	
	public function get_received_through_by_id_info($received_user_id) {
		$received_name = "";
		$query = $this->mastermodel->find_received_through_info($received_user_id);
		if($query) {	
			$received_name = $query->received_through_name;
		}
		return $received_name;
	}
	
	public function get_sample_type_by_id_info($sample_type_id) {
		$sample_type_name = "";
		$query = $this->mastermodel->find_sample_type_info($sample_type_id);		
		if($query) {	
			$sample_type_name = $query->sample_type_name;
		}
		return $sample_type_name;
	}
	
	public function get_crop_type_by_id_info($crop_id) {
		$crop_name = "";
		$query = $this->mastermodel->find_crop_type_info($crop_id);		
		if($query) {	
			$crop_name = $query->crop_name;
		}
		return $crop_name;
	}
	
	public function get_variety_by_id_info($variety_id) {
		$variety_name = "";
		$query = $this->mastermodel->find_variety_info($variety_id);		
		if($query) {	
			$variety_name = $query->variety_name;
		}
		return $variety_name;
	}
	
	public function get_soil_type_by_id_info($soil_id) {
		$soil_type_name = "";
		$query = $this->mastermodel->find_soil_type_info($soil_id);		
		if($query) {	
			$soil_type_name = $query->soil_type_name;
		}		
		return $soil_type_name;
	}
	
	public function get_stage_by_id_info($stage_id) {
		$stage_name = "";
		$query = $this->mastermodel->find_stage_info($stage_id);		
		if($query) {	
			$stage_name = $query->stage_name;
		}		
		return $stage_name;
	}
	
	public function get_leaf_by_id_info($leaf_id) {
		$leaf_name = "";
		$query = $this->mastermodel->find_leaf_info($leaf_id);		
		if($query) {	
			$leaf_name = $query->leaf_name;
		}		
		return $leaf_name;
	}
	
	public function get_payment_by_id_info($payment_id) {
		$payment_name = "";
		$query = $this->mastermodel->find_payment_info($payment_id);		
		if($query) {	
			$payment_name = $query->payment_name;
		}		
		return $payment_name;
	}
	
	public function get_user_by_id_info($user_id) {
		$inward_by_name = "";
		$query = $this->usermodel->find_user_info($user_id) ;		
		if($query) {	
			$inward_by_name = $query->user_salutation." ".$query->user_first_name." ".$query->user_middle_name." ".$query->user_last_name;
		}		
		return $inward_by_name;
	}
	
	public function get_water_source_by_id_info($water_id) {
		$water_source_name = "";
		$query = $this->mastermodel->find_water_source_info($water_id);		
		if($query) {	
			$water_source_name = $query->water_source_name;
		}	
		return $water_source_name;
	}
	
	public function get_parameter_by_id_info($plant_parameter_id) {
		$plant_parameter_name = "";
		$query = $this->mastermodel->find_parameter_info($plant_parameter_id);		
		if($query) {	
			$plant_parameter_name = $query->parameter_name;
		}	
		return $plant_parameter_name;
	}
	
	public function get_unit_parameter_by_id_info($plant_parameter_id) {
		$parameter_unit_name = "";
		$query = $this->mastermodel->find_parameter_info($plant_parameter_id);		
		if($query) {	
			$parameter_unit_name = $query->parameter_unit_name;
		}	
		return $parameter_unit_name;
	}
	
	public function get_parameter_marathi_by_id_info($plant_parameter_id) {
		$parameter_name_marathi = "";
		$query = $this->mastermodel->find_parameter_info($plant_parameter_id);		
		if($query) {	
			$parameter_name_marathi = $query->parameter_name_marathi;
		}	
		return $parameter_name_marathi;
	}
	
	public function get_soil_parameter_by_id_info($soil_parameter_id) {
		$soil_parameter_name = "";
		$query = $this->mastermodel->find_soil_parameters_info($soil_parameter_id);		
		if($query) {	
			$soil_parameter_name = $query->soil_parameter_name;
		}	
		return $soil_parameter_name;
	}
	
	public function get_farmer_name_by_id_info($farmer_id) {
		$farmer_name = "";
		$query = $this->farmermodel->find_farmer_info($farmer_id);		
		if($query) {	
			$farmer_name = $query->farmer_name;
		}	
		return $farmer_name;
	}
	
	public function get_role_name_by_id_info($role_id) {
		$role_name = "";
		$query = $this->mastermodel->find_user_role_info($role_id);		
		if($query) {	
			$role_name = $query->user_role_name;
		}	
		return $role_name;
	}
	
}


