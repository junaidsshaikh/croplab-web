<section class="page_breadcrumbs ds parallax section_padding_top_40 section_padding_bottom_40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Download <span style="text-transform:capitalize"><?php echo $uri;?></span> Report </h2>
                
            </div>
        </div>
    </div>
</section>
      <div id="wrapper">
         
         
         
         <!-- Start right Content here --><!-- ============================================================== -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="page-title-box">
                           <div class="row align-items-center">
                           	  <?php 
							  	$type="";
							  	if($uri=='plant'){
									$type="Plant";
									
								} 
								if($uri=='soil'){
									$type="Soil";
									
								} 
								if($uri=='water'){
									$type="Water";
									
								} 
							  ?>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
                  
                  
                  <div class="row">
                     <div class="col-12">
                        <div class="card">
                           <div class="card-body" >
                           	<?= form_open('soiltest/Soiltest/get_reports_by_mobile_num/'.$uri, 'autocomplete="off"'); ?>
                           	   <div class="row">
                               	<div class="col-md-3"></div>
                     			<div class="col-md-6">
                                	<div class="row" style="margin-top:10px">
                                    	<div class="col-md-6">
                                        <label>Sample ID</label>
                                        <input type="text" class="form-control"  name="txtSampleId" id="txtSampleId" maxlength="10" tabindex="1"  style="font-weight:800;font-size:20px;color:#000000" required>
                                        </div> 
                                        <div class="col-md-6">
                                        <label>Mobile Number</label> <span id="errmsgmob" style="color:#FF0000"></span>
                                        <input type="text" class="form-control"  name="txtmobile" id="txtmobile" maxlength="10" tabindex="1"  style="font-weight:800;font-size:20px;color:#000000" required>
                                        </div> 
                                        
                                     </div>
                                	
                                </div>
                                <div class="col-md-3"></div>
                               
                               </div> 
                               <div class="row" style="margin-top:10px">
                     			<div class="col-md-12" align="center">
                                	
                                	<button type="submit" class="btn btn-info waves-effect waves-light">Search</button>
                                </div>
                               
                               </div>
                               
                           </div>
                           <?= form_close(); ?>   
                        </div>
                     </div>
                  </div>
                  
               </div>
               <!-- container-fluid -->
            </div>
            <!-- content -->
            
            <?php 
				//$this->view("innerpages/footer.php");
			?>
            
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here -->
      </div>
      <!-- END wrapper -->
      
      <?php 
	  	//$this->view("innerpages/js.php");
	  ?>
      <script type="text/javascript">
			$(document).ready(function() {
			
				  $("#txtmobile").keypress(function (e) {
					 //if the letter is not digit then display error and don't type anything
					 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
						//display error message
						$("#errmsgmob").html("Numbers Only").show().fadeOut("slow");
							   return false;
					}
				   });
				   
				   
					
					
				 });
				 
				
				 
				 //
				
	  </script>		
      