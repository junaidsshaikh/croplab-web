<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
      <title>CropLab - Soil Analysis</title>
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
				font-size: 11pt;
				
		  	}
			.declaration_message {
				font-size:9pt;
			}
			.hindi_class {
							  	font-family: "Hind", sans-serif;
							  	src: url("https://fonts.googleapis.com/css?family=Hind") format("truetype");
								font-size: 9pt;
						 }
			
		
    </style>
      
   </head>
   <body class="fixed-left">
      <!-- Loader 
      <div id="preloader">
         <div id="status">
            <div class="spinner"></div>
         </div>
      </div>
      <!-- Begin page -->
      <div id="wrapper">
         
        
         
         <!-- Start right Content here --><!-- ============================================================== -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container-fluid">
                  
                  
                  <?php 
				  	if($farmer) {
				  ?>
                  <div class="row">    
                     <div class="col-12">
                     	<div class="card">
                           	<div class="card-body" id="printableArea">
                               <img src="assets/images/letter_head.png" style="height:210px;width:100%"/>
                               <h4 align="center"><strong>Soil Analysis Report</strong></h4>
                              <table class="table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%; border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000">
                              	<tbody>
                                	<tr>
                                    	<td width="18%"><strong>Name of the Farmer</strong></td>
                                    	<td width="1%">:</td>
                                    	<td colspan="4"><?= $farmer['soil_inward_farmer_name']; ?></td>
                                    </tr>
                                	<tr>
                                    	<td><strong>Address</strong></td>
                                    	<td>:</td>
                                    	<td colspan="4"><?= $farmer['farmer_address']; ?>, Tal. - <?= $farmer['farmer_city']; ?>, Dist. - <?= $farmer['farmer_district']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Received Through</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['soil_inward_received_through']; ?></td>
                                    	<td><strong>Plot No./Gat No.</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['soil_inward_plot_gat']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Track ID</strong> </td>
                                    	<td>:</td>
                                    	<td>VAPL/<?= date("y"); ?>/<?= date("m"); ?>/<?= date("d"); ?>/<?= $farmer['soil_inward_sample_id']; ?>/<?= $farmer['soil_inward_sample']; ?></td>
                                        <td><strong>Crop</strong> </td>
                                    	<td>:</td>
                                    	<td><?= $farmer['soil_inward_crop']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Received Date</strong></td>
                                    	<td>:</td>
                                    	<td><?= nice_date($farmer['soil_inward_received_date'], "d-M-Y"); ?></td>
                                    	<td><strong>Analysis Date</strong></td>
                                    	<td>:</td>
                                    	<td><?= nice_date($farmer['soil_calculation_date'], "d-M-Y"); ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Contact Number</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['farmer_mobile']; ?></td>
                                    	<td width="18%"><strong>Sample ID</strong></td>
                                    	<td width="1%">:</td>
                                    	<td width="32%"><?= $farmer['soil_inward_sample_id']; ?></td>
                                    </tr>
                                </tbody>
                              </table>	
                              <table class="table_print" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                              	<thead>
                                	<tr align="center">
                                    	<th width="6%">Sr. No.</th>
                                    	<th width="45%">Parameter</th>
                                    	<th width="8%">Unit</th>
                                    	<th width="10%">Actual Result</th>
                                    	<th width="20%">Limit</th>
                                    	<th width="10%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr>
                                    	<th><strong>A</strong></th>
                                    	<th colspan="5"><strong>CHEMICAL PROPERTIES</strong></th>
                                    </tr>
                                     <?php 
										$num = 0;
										$soilArray = ["soil_calculation_ph", "soil_calculation_ec", "soil_calculation_oc", "soil_calculation_n","soil_calculation_p", "soil_calculation_k", 
										"soil_calculation_ca", "soil_calculation_mg", "soil_calculation_s", "soil_calculation_fe", "soil_calculation_mn", "soil_calculation_zn", "soil_calculation_cu", 
										"soil_calculation_bo", "soil_calculation_mo", "soil_calculation_na", "soil_calculation_cl", "soil_calculation_caco3", "soil_calculation_car", 
										"soil_calculation_bcar" ,"soil_calculation_no3", "soil_calculation_nh4", "soil_calculation_bd", "soil_calculation_stc", "soil_calculation_stt", 
										"soil_calculation_sts", "soil_calculation_wh", "soil_calculation_cec"];
										for($i=0; $i<count($stage_details); $i++) {
									?>
									<?php
									  $check_symbol = $soil_calculation[$soilArray[$i]];
									    if( $check_symbol != 0 or $check_symbol == 'Nil' or (strpos($check_symbol, '<') !== false or strpos($check_symbol, '&lt;') !== false or strpos($check_symbol, '&amp;amp;lt;') !== false)) {
	                                ?>
                                    <tr>                                        
                                        <td align="center"><?= ++$num; ?></td>
                                    	<td><?= $stage_details[$i]['soil_parameter_name']; ?> (<span class="hindi_class"><?= $stage_details[$i]['soil_parameter_name_marathi']; ?></span>)</td>
                                    	<td align="center"><?= $stage_details[$i]['soil_parameter_unit_to_measure']; ?></td>
                                    	<td align="center">
                                    	    <?php if(($num==7) or ($num==8)){
                                    	        echo round($soil_calculation[$soilArray[$i]]);
                                    	        
                                    	    }else{
                                    	        
                                    	        echo $soil_calculation[$soilArray[$i]];
                                    	    }
                                    	    
                                    	    ?>
											
											<?php 
											    
											    $check_symbol = $soil_calculation[$soilArray[$i]];
											    if (strpos($check_symbol, '<') !== false) {
											        $array = explode("<", $check_symbol);
											        $soil_calculation_data = $array[0];
											    } else {
											        $soil_calculation_data = $soil_calculation[$soilArray[$i]];
											    }
											    //echo $soil_calculation_data;
											?>
                                    	    
                                    	</td>
                                    	<td align="center"><?= $stage_details[$i]['soil_parameter_limit']; ?></td>
                                    	<td align="center">
                                        <?php 
											$check_for_symbol = $stage_details[$i]['soil_parameter_limit'];
											
											if($soil_calculation_data != 'Nil') {
												if (strpos($check_for_symbol, '<') !== false) {
													$array = explode("<", $stage_details[$i]['soil_parameter_limit']);
													
													if($soil_calculation_data < $array[1]) {
														echo "Optimal";
													} else if($soil_calculation_data > $array[1]) {
														echo "High";
													} else {
														echo "-";
													}
													
												} else if (strpos($check_for_symbol, '-') !== false) {
													$array = explode(" - ", $stage_details[$i]['soil_parameter_limit']);
													// and $array[0] != "" and $array[1] != ""
													if($array[0] != "-") {
    													if(($soil_calculation_data >= $array[0]) and ($soil_calculation_data <= $array[1])) {
    														echo "Optimal";
    													} else if($soil_calculation_data > $array[1]) {
    														echo "High";
    													} else if($soil_calculation_data < $array[0]) {
    													//print_r($array);
    														echo "Low";
    													} else {
    														echo "-";
    													}
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
									    }
									?>
                                    <?php	
										}
									?>
                                </tbody>
                              </table>
                              <p align="justify" class="declaration_message">Please note that the results given in the Analysis Report are only valid for the sample presented. Our reports are given on the basis of our expert's knowledge and advance technology. Whilst all resonable care has been taken to ensure that our results are accurate,we have not taken into account many other factors that could greatly affect the crop and hence in no event we shall be liable for any damages, whatsoever. We are not bound to attend any litigation in any court. Our reports are just for the knowledge of farmers and not to be used as evidence in any court . </p>
                              
                              <table style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                              	<tbody>
                                 	<tr class="text-center">
                                    	<td width="50%" align="center">
                                            <br>
                                        	Analyzed by
                                            <br>
                                            <?= $soil_calculation['user_id']; ?>
                                        </td>
                                    	<td width="50%" align="center"> 
                                        	<br>
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