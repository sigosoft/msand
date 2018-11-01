<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title> Report</title>
        <meta name="Msand" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="#" name="description" />
        <meta content="Sigosoft" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url(); ?>plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>

    </head>

<style>
  @media print {
  a[href]:after {
    content: none !important;
  }
}
@media print {
  button {
    display: none !important;
  }
  input,
  textarea {
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
  }
}
@media print {
  select {
    display: none !important;
  }
 
}
</style>
    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('header.php'); ?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <?php include('navigation.php'); ?>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left"> Report</h4>
                                    <ol class="breadcrumb float-right">
                                      <!-- <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md"   data-target="#">Add Products</button>-->
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <h2 class="text-uppercase text-center m-b-30">
                                                <span><h4></h4></span>
                                            </h2>


                                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/main_admin/cash_in_out_report/show_report" method="post">
											                    	<div class="form-group m-b-25">
                                                    <div class="col-12">
                                                        <label for="notes"> From Date</label>
                                                        
                                                        <input type="date" class="form-control" name="from" value="<?php echo date('Y-m-d'); ?>">
                                                        

                                                    </div>
                                                    <div class="col-12">
                                                        <label for="notes"> To Date</label>
                                                        
                                                        <input type="date" class="form-control" name="to" value="<?php echo date('Y-m-d'); ?>">
                                                        

                                                    </div>
                                                   
                                                </div>

                                                

                                                <div class="form-group account-btn text-center m-t-10">
                                                    <div class="col-12">
														<button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                                                        <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Show</button>
                                                    </div>
                                                </div>

                                            </form>


                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            <!-- /.modal -->
                            </div><!-- /.modal -->
                            
   <?php if(isset($rest)){ ?>
                            <div class="row">
                            
                            <div class="col-12">
                              <?php
                              ?>
                              <!--<b>TOTAL SALE</b>  <input type="text"  disabled value="<?php echo $amount; ?>"><br><br>-->
                              
                              <br><br>
                                <div class="card-box table-responsive">


                                     <table id="datatable-buttons" class="table table-bordered">

                                <thead>
                                    <?php 
									$r=$this->db->get_where('cash_report',array('date'=>$from))->row()->opening; 
									
									?>
									<tr>
                                        <td colspan="7">Opening Balance  :  <?php echo $r; ?></td>
                                    </tr>
                                <tr>
                                      <th>No</th>
                                      <th>Date</th>
                                      <th>Time</th>
                                      <th>Invoice No</th>
                                      <th>Customer</th>
                                      <th>Credit</th>
                                      <th>Debit</th>
                                </tr>
                                </thead>


                                <tbody>
                                      <?php
                                      $sum=0;
                                      $sum1=0;
                                      $i=1;
                                    //$product= $this->db->get('product')->result_array();

                                    foreach($result as $row){ ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo date('d-M-Y',strtotime($row['Transdate'])); ?></td>
                                    <td><?php echo $row['cur_time']; ?></td>
                                    <td><?php echo $row['invoice_no']; ?></td>
                                    <?php if(isset($row['SupplierID'])){ 
                                    if($row['in_stat']==1){
                                    ?>
                                    
                                      <td><?php echo $this->db->get_where('vendor',array('vendor_id'=>$row['SupplierID']))->row()->name; ?></td>
                                      <td><?php echo $row['Amount']; ?></td>
                                    <td></td>
                                    
                                    <?php } else {?>
                                    
                                    <td><?php echo $this->db->get_where('vendor',array('vendor_id'=>$row['SupplierID']))->row()->name; ?></td>
                                      
                                    <td></td>
                                    <td><?php echo $row['Amount']; ?></td>
                                    <?php } ?>
                                    
                                    
                                    <?php } elseif(isset($row['CustomerID'])) {
                                    if($row['in_stat']==1){
                                    ?>
                                    <td><?php echo $this->db->get_where('customer',array('id'=>$row['CustomerID']))->row()->name; ?></td>
                                    <td><?php echo $row['Amount']; ?></td>
                                    
                                    <td></td>
                                    <?php } else { ?>
                                    
                                    <td><?php echo $this->db->get_where('customer',array('id'=>$row['CustomerID']))->row()->name; ?></td>
                                    <td></td>
                                    <td><?php echo $row['Amount']; ?></td>
                                    
                                    
                                    
                                    <?php } } elseif($row['TransName']=="Expense") {?>
                                    <td></td>
                                    
                                    
                                    <td></td>
                                    <td><?php echo $row['Amount']; ?></td>
                                    <?php } else {?>
                                    <td><?php echo "Guest"; ?></td>
                                    <td><?php echo $row['Amount']; ?></td>
                                    
                                    <td></td>
                                    <?php } ?>
                                  </tr>
                                  
                                  <?php 
                                  
                                  if( $row['in_stat']!=1 ||  $row['ExpenseID'] != NULL) {
                                      $amnt=$sum+$row['Amount'];
                                      $sum=$amnt;
                                  } else { 
                                      $amnt1=$sum1+$row['Amount'];
                                      $sum1=$amnt1;
                                  } ?>
                                  
                                  
                                  <?php $i++;} ?>
                                    </tbody>
                            <tr><td></td><td></td><td></td><td></td><td><b>TOTAL</b></b></td><td><b><?php echo ($sum1); ?></b></td><td ><b><?php echo ($sum); ?></b></td></tr>
                            
                            
                                    <?php 
									$r=$this->db->get_where('cash_report',array('date'=>$to))->row()->closing; 
									
									?>
									<tr>
                                        <td colspan="7">Closing Balance  :  <?php echo $r; ?></td>
                                    </tr>
                                    
                            </table>
                            
                                </div>
                            
                            </div>
                        </div>
                        
                        <?php } ?>


                         <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('footer.php'); ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/metisMenu.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>

        <!-- Required datatable js -->
        <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url(); ?>plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/buttons.print.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url(); ?>plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: true,
                    buttons: ['copy', 'excel']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
    </body>
</html>
