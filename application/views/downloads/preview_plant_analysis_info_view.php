<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
      <title>CropLab - Plant Analysis</title>
      <meta content="Admin Dashboard" name="description">
      <meta content="Themesbrand" name="author">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      
      <?php 
	  	//$this->view("innerpages/css.php");
	  	//$this->view("innerpages/print_css.php");
	  ?>
      
	  <link href="https://fonts.googleapis.com/css?family=Hind:400,700&amp;subset=devanagari,latin-ext" rel="stylesheet">
      
	  <style type="text/css">
	  	
        .table_print {
              width: 100%;
            }
            
            .table_print td, .table_print th {
              border: 1px solid #000000;
              padding: 2px;
            }
            
            
            .table_print th {
              padding-top: 3px;
              padding-bottom: 3px;
              text-align: left;
              background-color: #FFF;
              color: black;
            }
      	 
		  	body {
				font-size: 10pt;
				
		  	}
			.declaration_message {
				font-size:8.5pt;
			}
			.hindi_class {
							  	font-family: "Hind", sans-serif;
							  	src: url("https://fonts.googleapis.com/css?family=Hind") format("truetype");
								font-size: 9pt;
						 }
			
		
    </style>
	  
      
   </head>
   <body class="fixed-left">
      
      
         
         <!-- Start right Content here --><!-- ============================================================== -->
         <div class="">
            <!-- Start content -->
            <div class="content">
               <div class="container-fluid">
                  
                  
                  <?php 
				  	if($stage_details) {
				  ?>
                  <div class="row">    
                     <div class="col-12">
                     	<div class="card">
                           	<div class="card-body" id="printableArea">
                           		
                              <img src="assets/images/letter_head.png" style="height:210px;width:100%"/>
                              <h4 align="center"><strong><?= $farmer['plant_inward_sample_type']; ?> Analysis Report</strong></h4>
                              <table class="table-sm " style="border-collapse: collapse; border-spacing: 0; width: 100%; border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000">
                              	<tbody>
                                	<tr>
                                    	<td width="18%"><strong>Name of the Farmer</strong></td>
                                    	<td width="1%">:</td>
                                    	<td width="32%"><?= $farmer['plant_inward_farmer_name']; ?></td>
                                    	<td width="18%"><strong>Sample ID</strong></td>
                                    	<td width="1%">:</td>
                                    	<td width="32%"><?= $farmer['plant_inward_sample_id']; ?></td>
                                    </tr>
                                	<tr>
                                    	<td><strong>Address</strong></td>
                                    	<td>:</td>
                                    	<td colspan="4"><?= $farmer['farmer_address']; ?>, Tal. - <?= $farmer['farmer_city']; ?>, Dist. - <?= $farmer['farmer_district']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Received Through</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['plant_inward_received_through']; ?></td>
                                    	<td><strong>Plot No./Gat No.</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['plant_inward_plot_gat']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Track ID.</strong> </td>
                                    	<td>:</td>
                                    	<td>VAPL/<?= date("y"); ?>/<?= date("m"); ?>/<?= date("d"); ?>/<?= $farmer['plant_inward_sample_id']; ?>/<?= $farmer['plant_inward_sample']; ?></td>
                                    	<td><strong>Variety</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['plant_inward_variety']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Crop</strong> </td>
                                    	<td>:</td>
                                    	<td><?= $farmer['plant_inward_crop']; ?></td>
                                    	<td><strong>No. of Days</strong></td>
                                    	<td>:</td>
                                    	<td>
                                        	<?php 
												$pruning_message = "";
												if($farmer['plant_inward_crop'] == "Grape") {
													if($farmer['plant_inward_stage'] =="April") {
														$pruning_message = "Days After April Pruning";
													} else if($farmer['plant_inward_stage'] =="Post Harvesting") {
														$pruning_message = "Days After Harvesting";
													} else if($farmer['plant_inward_stage'] =="Recut") {
														$pruning_message = "Days After Recut";
													} else if($farmer['plant_inward_stage'] =="Recut") {
														$pruning_message = "";
													} else {
														$pruning_message = "Days After Fruit Pruning";
													}
											?>
											<?= $farmer['plant_inward_pruning_days']." ".$pruning_message; ?> 
                                            <?php	
												} else {
											?>
											-
                                            <?php	
												}
											?>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Contact Number</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['farmer_mobile']; ?></td>
                                    	<td><strong>Leaf Position</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['plant_inward_leaf']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Received Date</strong></td>
                                    	<td>:</td>
                                    	<td><?= nice_date($farmer['plant_inward_received_date'], "d-M-Y"); ?></td>
                                    	<td><strong>Analysis Date</strong></td>
                                    	<td>:</td>
                                    	<td><?= nice_date($farmer['plant_calculation_date'], "d-M-Y"); ?></td>
                                    </tr>
                                </tbody>
                              </table>	
                              <table class="table_print" style="border-collapse: collapse; border-spacing: 0; width: 100%; border:1px solid #DEE2E6;">
                              	<thead>
                                	<tr align="center">
                                    	<th width="6%">Sr. No.</th>
                                    	<th width="44%">Parameter</th>
                                    	<th width="6%">Unit</th>
                                    	<th width="11%">Actual Result</th>
                                    	<th width="24%">Standards - <?= $farmer['plant_inward_stage']; ?></th>
                                    	<th width="8%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
										$num = 0;
										$plantArray = ["plant_calculation_n", "plant_calculation_no3", "plant_calculation_nh4", "plant_calculation_p", "plant_calculation_k", "plant_calculation_ca", 
										"plant_calculation_mg", "plant_calculation_s", "plant_calculation_fe", "plant_calculation_mn", "plant_calculation_zn", "plant_calculation_cu",
										"plant_calculation_bo", "plant_calculation_mo", "plant_calculation_na", "plant_calculation_cl", "plant_calculation_car", "plant_calculation_bic"];
									
										for($i=0; $i<count($plantArray); $i++) {
										
										if($i==0) {
									?>
                                    <tr>
                                    	<th></th>
                                    	<th colspan="5"><strong>MAJOR NUTRIENTS</strong></th>
                                    </tr>
                                    <?php	
										} if($i==5) {	
									?>
                                    <tr>
                                    	<th></th>
                                    	<th colspan="5"><strong>SECONDARY NUTRIENTS</strong></th>
                                    </tr>
                                    <?php	
										} if($i==8) {	
									?>
                                    <tr>
                                    	<th></th>
                                    	<th colspan="5"><strong>MICRO NUTRIENTS</strong></th>
                                    </tr>
                                    <?php	
										} if($i==14) {	
									?>
                                    <tr>
                                    	<th></th>
                                    	<th colspan="5"><strong>OTHER</strong></th>
                                    </tr>
                                    <?php	
										}	
									?>
									<?php 
									    $check_symbol = $plant_calculation[$plantArray[$i]];
									    if($check_symbol != 0 or $check_symbol == 'Nil' or (strpos($check_symbol, '<') !== false or strpos($check_symbol, '&lt;') !== false or strpos($check_symbol, '&amp;amp;lt;') !== false)) {
									        //if($farmer['plant_inward_sample_type'] == $stage_details[$i]['plant_parameter_sample_type']) {
									        $array = explode("-", $stage_details[$i]['plant_parameter_limit']);
									?>
                                	<tr>
                                    	<td align="center"><?= ++$num; ?></td>
                                    	<td><?= $stage_details[$i]['plant_parameter_name']; ?> (<span class="hindi_class"><?= $stage_details[$i]['parameter_name_marathi']; ?></span>)</td>
                                    	<td align="center"><?= $stage_details[$i]['plant_parameter_unit']; ?></td>
                                    	<td align="center">
											<?= $plant_calculation[$plantArray[$i]]; ?>
											
											<?php 
											    
											    $check_symbol = $plant_calculation[$plantArray[$i]];
											    if (strpos($check_symbol, '<') !== false) {
											        $array = explode("<", $check_symbol);
											        $plant_calculation_data = $array[0];
											    } else {
											        $plant_calculation_data = $plant_calculation[$plantArray[$i]];
											    }
											    //echo $plant_calculation_data;
											?>
                                        </td>
                                    	<td align="center"><?= $stage_details[$i]['plant_parameter_limit']; ?></td>
                                    	<td align="center">
                                        <?php 
                                            $check_for_symbol = $stage_details[$i]['plant_parameter_limit'];
                                            
                                            if($plant_calculation_data != 'Nil') {
                                                
                                                if (strpos($check_for_symbol, '<') !== false) {
                                                    
                                                    $array = explode("<", $stage_details[$i]['plant_parameter_limit']);
                                                    if($plant_calculation_data < $array[1]) {
														echo "Optimal";
													} else if($plant_calculation_data > $array[1]) {
														echo "High";
													} else {
														echo "-";
													}
                                                       
                                                } else if (strpos($check_for_symbol, '-') !== false) {
													$array = explode("-", $stage_details[$i]['plant_parameter_limit']);
                                                
                                                    if($plant_calculation_data >= $stage_details[$i]['plant_parameter_lower'] and $plant_calculation_data <= $stage_details[$i]['plant_parameter_upper'] and $array[0] != "" and $array[1] != "") {
    													echo "Optimal";
    												} else if($plant_calculation_data >= $stage_details[$i]['plant_parameter_lower'] and $plant_calculation_data >= $stage_details[$i]['plant_parameter_upper'] and $array[0] != "" and $array[1] != "") {
    													echo "High";
    												} else if($plant_calculation_data < $stage_details[$i]['plant_parameter_lower'] and $array[0] != "" and $array[1] != "") {
    													echo "Low";
    												} else {
    													echo "-";
    												}
                                                    
                                                } else {
													echo "-";
												}
                                            }
                                            
										?>
                                        </td>
                                    </tr>
									<?php
									        //}
							            }
									?>
                                    <?php	
										}
									?>
                              </table>
                              <p align="justify" class="declaration_message">Please note that the results given in the Analysis Report are only valid for the sample presented. Our reports are given on the basis of our expert's knowledge and advance technology. Whilst all resonable care has been taken to ensure that our results are accurate,we have not taken into account many other factors that could greatly affect the crop and hence in no event we shall be liable for any damages, whatsoever. We are not bound to attend any litigation in any court. Our reports are just for the knowledge of farmers and not to be used as evidence in any court . 
                              <br>
                              [*NR - Not Required]
                              </p>
                              
                              <table style="border-collapse: collapse; border-spacing: 0; width: 100%;margin-top:0;padding-top:0">
                              	<tbody>
                                 	<tr class="text-center">
                                    	<td width="50%" align="center">
                                        	Analyzed by
                                            <br>
                                            <?= $plant_calculation['user_id']; ?>
                                        </td>
                                    	<td width="50%" align="center">
                                        	Checked by
                                            <br>
                                            Mrs. Rucha Kulkarni
                                        </td>
                                    </tr>
                                 </tbody>
                              </table>
                           	</div>
                           	
                            
                            
                        </div>   
                     </div>
                     <!-- end col -->
                  </div>
                  <?php 
				  	}
				  ?>
               </div>
               <!-- container-fluid -->
            </div>
            <!-- content -->
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here -->
      </div>
      <!-- END wrapper -->
     
      
   </body>
</html>