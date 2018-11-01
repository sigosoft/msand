<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Report</title>
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
                                    <h4 class="page-title float-left">Customer Report</h4>
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


                                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/main_admin/customer_report/show_report" method="post">
											                    	<div class="form-group m-b-25">
                                                    <div class="col-12">
                                                        <label for="notes">Date From</label>
                                                        <input type="date" class="form-control" rows="5" name="date_from" value="<?php echo date('Y-m-d'); ?>">

                                                    </div>
                                                </div>

                                                <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                            <label for="notes">Date To</label>
                                                            <input type="date" class="form-control" rows="5" name="date_to" value="<?php echo date('Y-m-d'); ?>">

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-b-25">
                                                            <div class="col-12">
                                                                <label for="notes">Name</label>
                                                                <select class="form-control" rows="5" name="customer">
                                                                  <option>Select Customer</option>
                                                                  <?php $res=$this->db->get_where('customer')->result_array();
                                                                        foreach($res as $res1){
                                                                   ?>
                                                                  <option value="<?php echo $res1['id']; ?>"><?php echo $res1['name']; ?></option>
                                                                <?php } ?>
                                                                </select>
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

<?php if(!isset($check)) {?>
                        <div class="row">
                            <div class="col-12">

                              <b>Customer : <?php echo $customer; ?></b><br><br>
                                <div class="card-box table-responsive">

                                     <table id="datatable-buttons" class="table table-bordered" >

                                <thead>
                                    <tr><td colspan="10">
                                  <?php  $sq="SELECT `balance` FROM `ledger` WHERE `Transdate`='$from' and `CustomerID`='$customer1' order by LedgerID asc limit 1";
                                  $res111=$this->db->query($sq)->result_array();  
                                  
                                  if($res111==NULL){
                                      $sq2="SELECT `balance` FROM `ledger` WHERE `Transdate`>'$from' and `CustomerID`='$customer1' order by LedgerID asc limit 1";
                                      $res112=$this->db->query($sq2)->result_array(); 
                                      if($res112!=NULL){
                                      
                                       foreach($res112 as $res122){
                                      echo "OB   :"  .$res122['balance'];
                                    }
                                      }
                                      else{
                                      
                                      $sq1="SELECT `ob` FROM `customer` WHERE `id`='$customer1'";
                                      $res11=$this->db->query($sq1)->result_array(); 
                                      
                                       foreach($res11 as $res12){
                                      echo "OB   :"  .$res12['ob'];
                                    }
                                      }
                                  }
                                  else{
                                    
                                     foreach($res111 as $res121){
                                      echo "OB   :"  .$res121['balance'];
                                    }
                                  }
                                    

                                   
                                    ?>
                                  </td></tr>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Invoice No</th>
                                    <th>Vehicle</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Notes</th>
                                </tr>

                                </thead>


                                <tbody>
                                  <?php
                                  $i=1;
                                  $sum=0;
                                  $sum1=0;
                                  //$sales= $this->db->get('sale')->result_array();

                                  foreach($ledger as $row){
                                  ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['Transdate']; ?></td>
                                    <td><?php echo $row['cur_time']; ?></td>
                                    <td><?php echo $row['invoice_no']; ?></td>
                                    <td><?php echo $row['vehicle']; ?></td>
                                    <?php if($row['item']!=NULL){ 
                                    if(isset($row['CustomerID'])){ ?>
                                      <td><?php echo $this->db->get_where('product',array('id'=>$row['item']))->row()->name; ?></td>  
                                    <?php } elseif(isset($row['SupplierID'])){?>
                                    
                                    <td><?php echo $this->db->get_where('raw_material',array('raw_material_id'=>$row['item']))->row()->raw_material_name; ?></td>  
                                   
                                    <?php } } else{?>
                                    <td><?php echo ""; ?></td>  
                                    <?php } ?>
                                    
                                    <td><?php echo $row['quantity']; ?></td>
                                    
                                    
                                    <?php  if($row['in_stat']==1) { ?>
                                          <td><?php echo $row['Amount']; ?></td>
                                          <td></td>
                                        <?php } else  {?>
                                          <td></td>
                                          <td><?php echo $row['Amount']; ?></td>
                                        <?php } ?>
                                        
                                        
                                    <td><?php echo $row['notes']; ?></td>
                                </tr>
                                
                                <?php

                                  if( $row['in_stat']!=1 ) {
                                      $amnt=$sum+$row['Amount'];
                                      $sum=$amnt;
                                  } else {
                                      $amnt1=$sum1+$row['Amount'];
                                      $sum1=$amnt1;
                                  } ?>
                                  
                                  
                              <?php $i++;} ?>
                            
                            </tbody>
                            
                             <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><b>TOTAL</b></b></td><td><b><?php echo ($sum1); ?></b></td><td ><b><?php echo ($sum); ?></b></td><td></td></tr>
                             
                            <tr><td colspan="10">
                                
                                <?php  $sq="SELECT `balance` FROM `ledger` WHERE `Transdate`>'$to' and `CustomerID`='$customer1' order by LedgerID asc limit 1";
                                  $res111=$this->db->query($sq)->result_array();  
                                  
                                  if($res111==NULL){
                                      $sq1="SELECT `balance` FROM `creditor` WHERE `id`='$customer1'";
                                      $res11=$this->db->query($sq1)->result_array(); 
                                      
                                       foreach($res11 as $res12){
                                      echo "CB   :"  .$res12['balance'];
                                    }
                                  }
                                  else{
                                    
                                     foreach($res111 as $res121){
                                      echo "CB   :"  .$res121['balance'];
                                    }
                                  }
                                    

                                   
                                    ?>
                                
                            </td></tr>

                            </table>
                            <!--<a href="<?php echo base_url(); ?>index.php/main_admin/sales_report_print"><button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit" >print</button></a>-->
                                </div>
                            </div>
                        </div> <!-- end row -->
<?php } ?>

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


    </body>
</html>
