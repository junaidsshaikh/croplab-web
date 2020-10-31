<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
      <title>CropLab - Water Analysis</title>
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
                  
                  <!-- end row -->
                  <?php 
				  	if($farmer) {
				  ?>
                  <div class="row">    
                     <div class="col-12">
                     	<div class="card">
                           	<div class="card-body" id="printableArea">
                           		
                              <img src="assets/images/letter_head.png" style="height:250px;width:100%"/>
                              
                               <h4 align="center"><strong>Water Analysis Report</strong></h4>
                              <table class="table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%; border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000">
                              	<tbody>
                                	<tr>
                                    	<td width="15%"><strong>Name of the Farmer</strong></td>
                                    	<td width="1%">:</td>
                                    	<td width="35%"><?= $farmer['water_inward_farmer_name']; ?></td>
                                    	<td width="15%"><strong>Sample ID</strong></td>
                                    	<td width="1%">:</td>
                                    	<td width="33%"><?= $farmer['water_inward_sample_id']; ?></td>
                                    </tr>
                                	<tr>
                                    	<td><strong>Address</strong></td>
                                    	<td>:</td>
                                    	<td colspan="4"><?= $farmer['farmer_address']; ?>, Tal. - <?= $farmer['farmer_city']; ?>, Dist. - <?= $farmer['farmer_district']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Received Through</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['water_inward_received_through']; ?></td>
                                    	<td><strong>Plot No./Gat No.</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['water_inward_plot_gat']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Track ID.</strong> </td>
                                    	<td>:</td>
                                        <td>VAPL/<?= date("y"); ?>/<?= date("m"); ?>/<?= date("d"); ?>/<?= $farmer['water_inward_sample_id']; ?>/<?= $farmer['water_inward_sample']; ?></td>
                                        <td><strong>Crop</strong> </td>
                                    	<td>:</td>
                                    	<td><?= $farmer['water_inward_crop']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Contact Number</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['farmer_mobile']; ?></td>
                                    	<td><strong>Water Source</strong></td>
                                    	<td>:</td>
                                    	<td><?= $farmer['water_inward_water_source']; ?></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>Received Date</strong></td>
                                    	<td>:</td>
                                    	<td><?= nice_date($farmer['water_inward_received_date'], "d-M-Y"); ?></td>
                                    	<td><strong>Analysis Date</strong></td>
                                    	<td>:</td>
                                    	<td><?= nice_date($farmer['water_calculation_date'], "d-M-Y"); ?></td>
                                    </tr>
                                </tbody>
                              </table>	
                              <table class="table_print" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                	<?php 
										$num = 0;
										
										$waterArray = ["water_calculation_ph", "water_calculation_tds", "water_calculation_ec", "water_calculation_ca", "water_calculation_mg", "water_calculation_co3", "water_calculation_hco3", "water_calculation_na", "water_calculation_cl", "water_calculation_no3", "water_calculation_k", "water_calculation_cu","water_calculation_bo", "water_calculation_sar", "water_calculation_rsc", ];
										
										for($i=0; $i<count($stage_details); $i++) {
										    $check_symbol = $water_calculation[$waterArray[$i]];
										    if($water_calculation[$waterArray[$i]] > 0 or $water_calculation[$waterArray[$i]] == 'NIL' or $water_calculation[$waterArray[$i]] == 'Nil' or $check_symbol != 0 or $check_symbol == 'Nil' or (strpos($check_symbol, '<') !== false or strpos($check_symbol, '&lt;') !== false or strpos($check_symbol, '&amp;amp;lt;') !== false)) {
										       
									?>
                                    <tr>                                        
                                        <td align="center"><?= ++$num; ?></td>
                                    	<td><?= $stage_details[$i]['water_parameter_name']; ?> (<span class="hindi_class"><?= $stage_details[$i]['water_parameter_name_marathi']; ?>)</span></td>
                                    	<td align="center"><?= $stage_details[$i]['water_parameter_unit_to_measure']; ?></td>
                                    	<td align="center"><?= $water_calculation[$waterArray[$i]]; ?></td>
                                    	<td align="center"><?= $stage_details[$i]['water_parameter_limit']; ?></td>
                                    	<td align="center">
											<?php 
												$check_for_symbol = $stage_details[$i]['water_parameter_limit'];
												if($water_calculation[$waterArray[$i]] != 'Nil') {
													if (strpos($check_for_symbol, '<') !== false) {
													    $array = explode("<", $stage_details[$i]['water_parameter_limit']);
														if($water_calculation[$waterArray[$i]] < $array[1]) {
															echo "Optimal";
														} else if($water_calculation[$waterArray[$i]] >= $array[1]) {
															echo "High";
														} else {
															echo "-";
														}
													} else if (strpos($check_for_symbol, '-') !== false) {
														$array_dash = explode("-", $stage_details[$i]['water_parameter_limit']);
														if($array_dash[0] != "" and $array_dash[1] != "") {
															if($water_calculation[$waterArray[$i]] >= $array_dash[0] and $water_calculation[$waterArray[$i]] <= $array_dash[1]) {
																echo "Optimal";
															} else if($water_calculation[$waterArray[$i]] > $array_dash[1]) {
																echo "High";
															} else if($water_calculation[$waterArray[$i]] < $array_dash[0] ) {
																echo "Low";
															} else {
																echo "-";
															}
														}
													}
												}
											?>
                                        </td>
                                    </tr>
                                    <?php	 
										    }
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
                                            <?= $water_calculation['user_id']; ?>
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