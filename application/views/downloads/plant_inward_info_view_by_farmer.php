<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
      <title>CropLab - Plant Report</title>
      <meta content="Admin Dashboard" name="description">
      <meta content="Themesbrand" name="author">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <?php 
	  	//$this->view("innerpages/css.php");
	  ?>
      
   </head>
   <body class="fixed-left">
      <!-- Loader 
      <div id="preloader">
         <div id="status">
            <div class="spinner"></div>
         </div>
      </div>
      <!-- Begin page -->
      <div >
         
         <?php 
		 	//$this->view("innerpages/header.php");
			
		 	//$this->view("innerpages/left_menu.php");
		 ?>
         
         <!-- Start right Content here --><!-- ============================================================== -->
         <div class="">
            <!-- Start content -->
            <div class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="page-title-box">
                           <div class="row align-items-center">
                              <div class="col-md-12">
                                 <h4 class="page-title mb-0" align="center">Download Plant Reports</h4>
                                 <!--<ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="#">CropLab</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Plant inward</li>
                                 </ol>-->
                              </div>
                              <div class="col-md-8">
                              	<?php if($error = $this->session->flashdata('error')) {
								?>
                                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Oh snap!</strong>
                                        <?= $error; ?>
                                    </div>
                                <?php	
								} if($success = $this->session->flashdata('success')) {
								?>
                                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Great!</strong>
                                            <?= $success; ?>
                                        </div>
                                <?php	
									} 
								?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <!-- end row -->
                  <div class="row">
                     
                     <!-- end col -->
                     <div class="col-12">
                     	<div class="card">
                           	<div class="card-body">
                                <div class="row">
                                	<div class="col-md-10">
                                    	<h4 class="mt-0 header-title"><?= $farmer_info->farmer_name;?></h4>
                                    </div>
                                    <div class="col-md-2" align="right">
                                    	<a href="<?php echo base_url();?>" class="btn btn-info btn-sm waves-effect waves-light">Back</a>
                                    </div>
                                </div>
                                <table id="plant-inward-table" class="table table-striped table-sm table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <thead>
                                    <tr>
                                       <th width="8%">No. </th>
                                       <th>Date</th>
                                       <th>Sample ID</th>
                                       <th width="10%">#</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 	
                                 </tbody>
                              </table>
                           	</div>
                        </div>   
                     </div>
                     <!-- end col -->
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
      <script type="text/javascript" src="http://www.google.com/jsapi"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- jQuery  -->
      <!-- Required datatable js -->
      <script src="<?= base_url("plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
      <script src="<?= base_url("plugins/datatables/dataTables.bootstrap4.min.js"); ?>"></script>
      <!-- Buttons examples -->
      <!-- Responsive examples -->
      <script src="<?= base_url("plugins/datatables/dataTables.responsive.min.js"); ?>"></script>
      <script src="<?= base_url("plugins/datatables/responsive.bootstrap4.min.js"); ?>"></script>
      <!-- Datatable init js -->
      
      <!-- Plugins js -->
      
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <script src="<?= base_url("assets/js/app.js"); ?>"></script>
      <script type="text/javascript">
		 var id=<?= $farmer_info->farmer_id;?>;
		 var sampleid='<?= $sampleid;?>';
		 //alert(id+'...'+sampleid);
		$(document).ready(function() {
			var plant_inward_info_table = $('#plant-inward-table').DataTable({
				"processing":true,  
			    "serverSide":true,  
				 "paging":   false,
				"ordering": false,
				"info":     false,
				"searching":false,
			    "order":[],  
				"ajax": {
					url : "<?php echo site_url("soiltest/Soiltest/get_reports_by_farmer/") ?>"+id+"/"+sampleid,
					type:"POST"  
				},
				"columnDefs":[  
                {  
                     "targets":[0],  
                     "orderable":false,  
                },  
         	  ], 
				
				
			});
			
			
		});
		
		
		
		
			
		
		
	</script>
   </body>
</html>