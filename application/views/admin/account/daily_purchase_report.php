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
                              <h4 class="page-title float-left">Daily Report : <?php echo date('d-M-Y'); ?></h4>
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

                                         <table id="datatable" class="table table-bordered">
                                    <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Time</th>
                                    <th>Invoice No</th>
                                    <th>Item</th>
                                    <th>Customer</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Cancel</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                      <?php
                                      $i=1;
                                    //$product= $this->db->get('product')->result_array();

                                    foreach($purchase as $row){ ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['cur_date']; ?></td>
                                    <td><?php echo $row['invoice_no']; ?></td>
                                    <td><?php echo $this->db->get_where('raw_material',array('raw_material_id'=>$row['product']))->row()->raw_material_name; ?></td>
                                    <td><?php echo $this->db->get_where('vendor',array('vendor_id'=>$row['customer']))->row()->name; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                    <!--<td><a href="<?php echo base_url();?>index.php/main_admin/status_cancel_purchase/<?php echo $row['sales_id']; ?>"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a></td>-->
                                    
                                    <?php if($row['status']=='1' && $row['show_cancel_status']=='1'){ ?>
                                      <td><a href="<?php echo base_url();?>index.php/account/status_cancel_purchase/<?php echo $row['sales_id']; ?>"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a></td>
                                      <?php } else {?>
                                    <td>Cancelled</a></td>
                                    <?php } ?>
                                    
                                    
                                  </tr>
                                  <?php $i++;} ?>
                                    </tbody>
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
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

    </body>
</html>
