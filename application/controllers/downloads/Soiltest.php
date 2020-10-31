<?php 

/*

	Controller class: Settings
	Base class: MY_Controller
	Description: 
	
*/

class Soiltest extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->library("pdf");	
		$this->load->model("inwardtestingmodel", "testingmodel");
		$this->load->model("inwardmanagemodel", "inwardmodel");	
		$this->load->model("farmersetupmodel", "farmermodel");	
		$this->load->model("farmer_report_downloadmodel", "farmerreportmodel");	
		$this->load->model("mastersetupmodel","mastermodel");	
    	$this->load->model('usersetupmodel', 'usermodel');	
		$this->load->model("chemistsetupmodel", "chemistmodel");	
		$this->load->model("settingsmodel");	
		$this->load->model("utilmodel");	
		
	}
	
	public function index() {
		$this->load->view('soil_test_module/soilt_test_view');
	}
	
	public function test($sand, $clay){
		if($sand=="" or $sand<0 or $sand>100)
			echo "Wrong Input Sand";
		if($clay=="" or $clay<0 or $clay>100)
			echo "Wrong Input Clay";	
		
		$sand=$sand/100;
		$clay=$clay/100;
		
		
		$tot=$sand+$clay;
		if($tot>1){
		 echo "Data Is Not proper <br/>";
		}else{
			$silt=1-$tot;
			$this->result($sand,$clay,$silt);
		}
		
		
		
		
		
		
		
		
		
	}
	
	
	/*public function result($sand,$clay,$silt){
		echo "<br/>Sand:".$sand*100 ."<br/>Clay:".$clay*100 ."<br/>Silt:".$silt*100 ."<br/> Soil Type: ";
		
		if( ($silt+1.5*$clay)<.15 ){
			echo "<strong>SAND</strong>";
			
		}else if( (($silt+1.5*$clay)>=.15)&(($silt+2*$clay)<.3) ){
			echo "<strong>LOAMY SAND</strong>";
			
		}else if( ($clay>=0.07) & ($clay<=0.2) & ($sand>0.52) & (($silt+2*$clay)>=0.3) ){
			echo "<strong>SANDY LOAM</strong>";
			
		}else if( ($clay<0.07) & ($silt < 0.5) & (($silt+2*$clay)>=0.3) ){
			echo "<strong>SANDY LOAM</strong>";
		
		}else if( ($clay>=0.07) & ($clay<=0.27) & ($silt>=0.28) & ($silt<0.5) & ($sand<=0.52) ){
			echo "<strong>LOAM</strong>";
		
		}else if( (($silt>=0.5) & $clay>=0.12 & $clay<0.27) | ($silt>=0.5 & $silt<0.8 & $clay<0.12) ){
			echo "<strong>SILT LOAM</strong>";
		
		}else if( $silt>=0.8 & $clay<0.12 ){
			echo "<strong>SILT</strong>";
		
		}else if( $clay>=0.2 & $clay<0.35 & $silt<0.28 & $sand>0.45 ){
			echo "<strong>SANDY CLAY LOAM</strong>";
		
		}else if( $clay>=0.27 & $clay <0.4 & $sand>0.2 & $sand<=0.45 ){
			echo "<strong>CLAY LOAM</strong>";
		
		}else if( $clay>=0.27 & $clay<0.4 & $sand<=0.2 ){
			echo "<strong>SILTY CLAY LOAM</strong>";
		
		}else if( $clay>=0.35 & $sand>=0.45 ){
			echo "<strong>SANDY CLAY</strong>";
		
		}else if( $clay>=0.4 & $silt>=0.4 ){
			echo "<strong>SILTY CLAY</strong>";
		
		}else if( $clay>= 0.4 & $sand<=0.45 & $silt<0.4 ){
			echo "<strong>CLAY</strong>";
		
		}
	
	}*/
	
	public function result(){
		$result="";
		//echo "<br/>Sand:".$sand*100 ."<br/>Clay:".$clay*100 ."<br/>Silt:".$silt*100 ."<br/> Soil Type: ";
		$sand=$this->input->post('sand')/100;
		$clay=$this->input->post('clay')/100;
		$silt=$this->input->post('silt');
		if($sand and $clay and $silt){
		
			if( ($sand+$clay)>1) {
				$result=["result"=>"<strong>Texture Category Not Found</strong>"];
			}else if( ($silt+1.5*$clay)<.15 ){
				$result=["result"=>"<strong>SAND</strong>"];
				
			}else if( (($silt+1.5*$clay)>=.15)&(($silt+2*$clay)<.3) ){
				$result=["result"=>"<strong>LOAMY SAND</strong>"];
				
			}else if( ($clay>=0.07) & ($clay<=0.2) & ($sand>0.52) & (($silt+2*$clay)>=0.3) ){
				$result=["result"=>"<strong>SANDY LOAM</strong>"];
				
			}else if( ($clay<0.07) & ($silt < 0.5) & (($silt+2*$clay)>=0.3) ){
				$result=["result"=>"<strong>SANDY LOAM</strong>"];
			
			}else if( ($clay>=0.07) & ($clay<=0.27) & ($silt>=0.28) & ($silt<0.5) & ($sand<=0.52) ){
				$result=["result"=>"<strong>LOAM</strong>"];
			
			}else if( (($silt>=0.5) & $clay>=0.12 & $clay<0.27) | ($silt>=0.5 & $silt<0.8 & $clay<0.12) ){
				$result=["result"=>"<strong>SILTY LOAM</strong>"];
			
			}else if( $silt>=0.8 & $clay<0.12 ){
				$result=["result"=>"<strong>SILT</strong>"];
			
			}else if( $clay>=0.2 & $clay<0.35 & $silt<0.28 & $sand>0.45 ){
				$result=["result"=>"<strong>SANDY CLAY LOAM</strong>"];
			
			}else if( $clay>=0.27 & $clay <0.4 & $sand>0.2 & $sand<=0.45 ){
				$result=["result"=>"<strong>CLAY LOAM</strong>"];
			
			}else if( $clay>=0.27 & $clay<0.4 & $sand<=0.2 ){
				$result=["result"=>"<strong>SILTY CLAY LOAM</strong>"];
			
			}else if( $clay>=0.35 & $sand>=0.45 ){
				$result=["result"=>"<strong>SANDY CLAY</strong>"];
			
			}else if( $clay>=0.4 & $silt>=0.4 ){
				$result=["result"=>"<strong>SILTY CLAY</strong>"];
			
			}else if( $clay>= 0.4 & $sand<=0.45 & $silt<0.4 ){
				$result=["result"=>"<strong>CLAY</strong>"];
			
			}else{
				$result=["result"=>"<strong>Texture Category Not Found</strong>"];
			}	
		
		}
		
		echo json_encode($result);
		
	
	}
	
	
	//Get plant report view
	public function report_view_farmer(){
		$this->load->view("soil_test_module/report_view");
	
	}
	
	
	//Get Plant report By farmer Mobile Number
	public function get_reports_by_mobile_num(){
			$mobile=$this->input->post('txtmobile');
			$sampleid=$this->input->post('txtSampleId');
			
			if($mobile>0){
			$farmer_info=$this->farmerreportmodel->find_farmer_info_by_mobile($mobile);
			//print_r($farmer_info->farmer_id);
				 //For Plant
				 if($this->uri->segment(3)=='plant'){
					if($farmer_info){
						$this->load->view("soil_test_module/plant_inward_info_view_by_farmer",["farmer_info"=>$farmer_info, "sampleid"=>$sampleid]);
					}else{
					echo "Mobile Number Not Exist";
				
					}
				 }
				 
				 //For Soil
				 if($this->uri->segment(3)=='soil'){
					if($farmer_info){
						$this->load->view("soil_test_module/soil_inward_info_view_by_farmer",["farmer_info"=>$farmer_info]);
					}else{
					echo "Mobile Number Not Exist";
				
					}
				 }
				 
				 //For Water
				 if($this->uri->segment(3)=='water'){
					if($farmer_info){
						$this->load->view("soil_test_module/water_inward_info_view_by_farmer",["farmer_info"=>$farmer_info]);
					}else{
					echo "Mobile Number Not Exist";
				
					}
				 }
				 	
			}else{
				echo "Enter Mobile Number";
			
			}
	}
	
	
	/*public function plant_inward_info() {
		//$plantInwards = $this->inwardmodel->get_plant_inward_list();
		$this->load->view("plant_inward_info_view_by_farmer");
		
	}*/
	
	public function get_reports_by_farmer($id, $sampleid) {
		$arrayList = [];
		$draw = intval($this->input->get("draw"));
       	$start = intval($this->input->get("start"));
       	$length = intval($this->input->get("length"));
		
		
		
		$plantinwards = $this->farmerreportmodel->get_plant_inward_list($id, $sampleid);
		$i=0;
		foreach($plantinwards as $inward) {
				$action = '
			<a href="'.base_url("Soiltest/get_plant_analysis_info/".$inward["plant_inward_sample_id"]) .'" class="btn btn-primary btn-sm" title="Print"><i class="dripicons-download">	</i>Download</a>	
			';
			
				
			$arrayList[] = array(
				++$i,
				nice_date($inward["plant_inward_date"], 'd-m-Y'), 
				'<strong>'.$inward["plant_inward_sample_id"].'</strong>',
				$action,
			);
		}
		
		$output = array(
                 "draw" => $draw,
                 "recordsTotal" => count($plantinwards),
                 "recordsFiltered" => count($plantinwards),
                 "data" => $arrayList
            );
		
		
		
		echo json_encode($output);
		
	}
	
	
	public function get_plant_analysis_info($plantSampleId) {
		if($this->if_plant_sample_id_exist($plantSampleId)){
    		$plant_inward = $this->find_plant_inward_by_smaple_id($plantSampleId);
    		$farmer_inward = $this->find_plant_inward_by_smaple_id_info($plantSampleId);
    		$plant_calculation = $this->find_plant_calculation_by_smaple_id_info($plantSampleId);
    		$stage_details = $this->mastermodel->find_plant_parameters_by_stage_info($plant_inward->plant_inward_stage, $plant_inward->plant_inward_crop, $plant_inward->plant_inward_sample_type);
    		
    		//echo "<pre>";
    		//print_r($plant_inward->plant_inward_stage);
    		//print_r($plant_inward->plant_inward_crop);
    		//print_r($farmer_inward);
    		if($stage_details) {
    			$this->load->view("soil_test_module/preview_plant_analysis_info_view", ["stage_details"=> $stage_details, "plant_calculation"=> $plant_calculation, "farmer"=>$farmer_inward]);
				$html = $this->output->get_output();
			
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
				
				$filename = $plantSampleId.".pdf";
				$this->pdf->stream($filename, array("Attachment"=> 1));	
    		}
		}else{
			echo "<h2> Sample Id Does Not found or Chemist is not assigned...!</h2>";
			//redirect("Reports/plant_report_info");
		}
		
	}
	
	public function find_plant_calculation_by_smaple_id_info($plantSampleId) {
		$result = $this->chemistmodel->find_plant_calculation_by_smaple_id_info($plantSampleId);
		return $result;
	}
	
	public function if_plant_sample_id_exist($plantSampleId){
		$plant_id=$this->testingmodel->if_plant_sampl_id_exist($plantSampleId);
		return $plant_id;
	}
	
	public function find_plant_inward_by_smaple_id_info($sampleId) {
		$result=$this->testingmodel->find_plant_inward_by_smaple_id_info($sampleId);
		return $result;
	}
	
	public function find_plant_inward_by_smaple_id($plantSampleId) {
		$result=$this->testingmodel->find_plant_inward_by_smaple_id($plantSampleId);
		return $result;
	}
	
	
	//Soil
	
	public function get_soil_inward_info($id) {
		$arrayList = [];
		$draw = intval($this->input->get("draw"));
       	$start = intval($this->input->get("start"));
       	$length = intval($this->input->get("length"));
		
		$soilinwards = $this->farmerreportmodel->get_soil_inward_list($id);
		$i=0;
		foreach($soilinwards as $inward) {
				$action = '<a href="'.base_url("Soiltest/get_soil_analysis_info/".$inward["soil_inward_sample_id"]) .'" class="btn btn-primary btn-sm" title="Print"><i class="dripicons-download">		</i>Download</a>	';
			
				
			$arrayList[] = array(
				++$i,
				nice_date($inward["soil_inward_date"], 'd-m-Y'), 
				$inward["soil_inward_sample_id"],
				$action,
			);
		}
		
		$output = array(
                 "draw" => $draw,
                 "recordsTotal" => count($soilinwards),
                 "recordsFiltered" => count($soilinwards),
                 "data" => $arrayList
            );
		
		
		
		echo json_encode($output);
		
	}		
	
	
	public function get_soil_analysis_info($soilSampleId) {
		$soil_inward = $this->find_soil_inward_by_smaple_id_info($soilSampleId);	
		$stage_details = $this->mastermodel->find_soil_parameters_by_stage_info();
		$soil_calculation = $this->find_soil_calculation_by_smaple_id_info($soilSampleId);
		$this->load->view("soil_test_module/preview_soil_analysis_info_view", ["stage_details"=> $stage_details, "soil_calculation"=> $soil_calculation, "farmer"=>$soil_inward]);
				$html = $this->output->get_output();
			
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
				
				$filename = $soilSampleId.".pdf";
				$this->pdf->stream($filename, array("Attachment"=> 1));
		
	}
	
	public function find_soil_calculation_by_smaple_id_info($plantSampleId) {
		$result = $this->chemistmodel->find_soil_calculation_by_smaple_id_info($plantSampleId);
		return $result;
	}
	
	public function find_soil_inward_by_smaple_id_info($soilSampleId) {
		$result=$this->testingmodel->find_soil_inward_by_smaple_id_info($soilSampleId);
		return $result;
	}
	
	//Water---
	
	public function get_water_inward_info($id) {
		$arrayList = [];
		$draw = intval($this->input->get("draw"));
       	$start = intval($this->input->get("start"));
       	$length = intval($this->input->get("length"));
		
		$waterinwards = $this->farmerreportmodel->get_water_inward_list($id);
		$i=0;
		foreach($waterinwards as $inward) {
				$action = '<a href="'.base_url("Soiltest/get_water_analysis_info/".$inward["water_inward_sample_id"]) .'" class="btn btn-primary btn-sm" title="Print"><i class="dripicons-download">		</i>Download</a>';
			
				
			$arrayList[] = array(
				++$i,
				nice_date($inward["water_inward_date"], 'd-m-Y'), 
				$inward["water_inward_sample_id"],
				$action,
			);
		}
		
		$output = array(
                 "draw" => $draw,
                 "recordsTotal" => $this->inwardmodel->water_all_inward_num_row(),
                 "recordsFiltered" => $this->inwardmodel->water_all_inward_num_row(),
                 "data" => $arrayList
            );
		
		
		
		echo json_encode($output);
		
	}
	
	
	public function find_water_calculation_by_smaple_id_info($waterSampleId) {
		$result = $this->chemistmodel->find_water_calculation_by_smaple_id_info($waterSampleId);
		return $result;
	}
	
	public function find_water_inward_by_smaple_id_info($waterSampleId) {
		$result=$this->testingmodel->find_water_inward_by_smaple_id_info($waterSampleId);
		return $result;
	}
	
	public function get_water_analysis_info($waterSampleId) {
		$water_inward = $this->find_water_inward_by_smaple_id_info($waterSampleId);		
		$stage_details = $this->mastermodel->find_water_parameters_by_stage_info();
		$water_calculation = $this->find_water_calculation_by_smaple_id_info($waterSampleId);
		//echo "<pre>";
		//print_r($soil_calculation);
		$this->load->view("soil_test_module/preview_water_analysis_info_view", ["stage_details"=> $stage_details, "water_calculation"=> $water_calculation, "farmer"=>$water_inward]);
				$html = $this->output->get_output();
			
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'portrait');
				$this->pdf->render();
				
				$filename = $waterSampleId.".pdf";
				$this->pdf->stream($filename, array("Attachment"=> 1));
		
	}
	
	
	
	
	//////////////
	

	
	
					   
	
}


