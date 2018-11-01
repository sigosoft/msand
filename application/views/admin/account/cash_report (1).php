<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Sales Report</title>
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
                                    <h4 class="page-title float-left">Cash Report</h4>
                                    <ol class="breadcrumb float-right">
                                      <!-- <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md"   data-target="#">Add Products</button>-->
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->



<?php  $d=date('Y-m-d'); if(isset($this->db->get_where('cash_report',array('date'=>$d))->row()->opening)){ ?>
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <h2 class="text-uppercase text-center m-b-30">
                                                <span><h4></h4></span>
                                            </h2>


                                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/main_admin/Cash_report/close_account" method="post">
                                              <div class="form-group m-b-25">
                                                   <div class="col-12">
                                                       <label for="notes"><b>Date</b></label>

                                                       <input type="date" class="form-control" rows="5" name="date" value="<?php echo date('Y-m-d'); ?>" disabled>
                                                   </div>
                                               </div>
<?php
$d=date('Y-m-d');
$opening=$this->db->get_where('cash_report',array('date'=>$d))->row()->opening;

$this->db->select_sum('amount');
$res=$this->db->get_where('cash_in',array('date'=>$d,'cash_in_status'=>1));
$data1= $res->row();
$cash_in =  $data1->amount;

$this->db->select_sum('amount');
$res=$this->db->get_where('cash_out',array('date'=>$d,'cash_out_status'=>1));
$data2= $res->row();
$cash_out =  $data2->amount;

$closing=$opening+$cash_in-$cash_out;
$res = $this->db->get_where('cash_report',array('date'=>$d))->result_array();
foreach($res as $row) {?>
                                               <div class="form-group m-b-25">
                                                    <div class="col-12">
                                                        <label for="notes"><b>Opening Balance</b></label>
                                                        <input type="text" class="form-control" rows="5" name="open_bal" value="<?php echo $opening; ?>" disabled>
                                                    </div>
                                                </div>

                                                    <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                            <label for="notes"><b>Cash In</b></label>
                                                            <input type="text" class="form-control" rows="5" name="cash_in" value="<?php echo $cash_in; ?>" disabled>
                                                        </div>
                                                    </div>
                                                      <div class="form-group m-b-25">
                                                            <div class="col-12">
                                                                <label for="notes"><b>Cash Out</b></label>
                                                                <input type="text" class="form-control" rows="5" name="cash_out" value="<?php echo $cash_out; ?>" disabled>
                                                            </div>
                                                        </div>
                                                           <div class="form-group m-b-25">
                                                                <div class="col-12">
                                                                    <label for="notes"><b>Closing Balance</b></label>
                                                                    <input type="text" class="form-control" rows="5" name="close_bal" value="<?php echo $closing; ?>" disabled>
                                                                </div>
                                                            </div>
<?php } ?>
                                                <div class="form-group account-btn text-center m-t-10">
                                                    <div class="col-12">
														                            <!--<button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>-->
                                                        <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Close Account</button>
                                                    </div>
                                                </div>

                                            </form>


                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
<?php } ?>

                            <!-- /.modal -->
                            </div><!-- /.modal -->


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
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

    </body>
</html>
