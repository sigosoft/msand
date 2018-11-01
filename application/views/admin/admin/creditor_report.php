<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Report</title>
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
            <div class="content-page" >
                <!-- Start content -->
                <div class="content">
                  <div class="row">
                      <div class="col-12">
                          <div class="page-title-box">
                              <h4 class="page-title float-left">Report</h4>
                              <ol class="breadcrumb float-right">
                                <!-- <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md"   data-target="#">Add Products</button>-->
                              </ol>

                              <div class="clearfix"></div>
                          </div>
                      </div>
                  </div>


                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box table-responsive">

                                         <table id="datatable-buttons" class="table table-bordered">
                                    <thead>
                                        
                                    <tr>
                                      <th>No</th>
                                      <th>Date</th>
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

                                    foreach($creditor as $row){ ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo date('d-M-Y'); ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <?php if($row['balance']>0) {?>
                                    <td><?php echo $row['balance']; ?></td>
                                    <td></td>
                                    <?php } else {?>
                                    <td></td>
                                    <td><?php echo $row['balance']; ?></td>
                                    <?php } ?>
                                  </tr>
                                  
                                  <?php
                                  if($row['balance']>0) {
                                      $amnt=$sum+$row['balance'];
                                      $sum=$amnt;
                                  } else { 
                                      $amnt1=$sum1+$row['balance'];
                                      $sum1=$amnt1;
                                  } ?>
                                  
                                  <?php $i++;} ?>
                                    </tbody>
                                    <tr><td></td><td></td><td><b>TOTAL</b></b></td><td><b><?php echo $sum; ?></b></td><td colspan="2"><b><?php echo ($sum1); ?></b></td></tr>
                                </table>
                                    </div>
                                </div>
                            </div> <!-- end row -->


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
