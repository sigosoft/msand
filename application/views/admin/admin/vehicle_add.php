<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Vehicles</title>
        <meta name="Dofody" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
  .fl{
    float:left;
  }
  .modal-dialog {
    max-width: 600px;
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
                                    <h4 class="page-title float-left">Vehicles</h4>

                                    <ol class="breadcrumb float-right">
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

						           <div id="add-record"  tabindex="-1"  aria-labelledby="custom-width-modalLabel"  >
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <h2 class="text-uppercase text-center m-b-30">
                                                <span><h4>Add Vehicle</h4></span>
                                            </h2>


                                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/main_admin/vehicle/do_add" method="post">


											                    	<div class="form-group m-b-25">
                                                    <div class="col-12">
                                                        <label for="notes">Vehicle Name</label>
                                                        <input type="text" class="form-control" rows="5" name="name" >

                                                    </div>
                                                </div>
                                                <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                            <label for="notes">Vehicle Model</label>
                                                            <input type="text" class="form-control" rows="5" name="model" >

                                                        </div>
                                                    </div>

                                                    <div class="form-group m-b-25">
                                                            <div class="col-12">
                                                                <label for="notes">Reg.Number</label>
                                                                <input type="text" class="form-control" rows="5" name="reg" required>

                                                            </div>
                                                        </div>

                                                       <label for="notes"><b>Company Body</b></label>
                                                        <div class="form-group m-b-25 clearfix">

                                                                <div class="col-2 fl">
                                                                    <label for="notes">Length</label>
                                                                    <input type="text" class="form-control" rows="5" name="cl" id="cl" required oninput="show_total();">
                                                                </div>
                                                                <div class="col-1 fl">
                                                                  <label for="notes"></label>
                                                                  &#x2715;
                                                                </div>
                                                                <div class="col-2 fl">
                                                                    <label for="notes">Width</label>
                                                                    <input type="text" class="form-control" rows="5" name="cw" id="cw" required oninput="show_total();">
                                                                </div>
                                                                <div class="col-1 fl">
                                                                    <label for="notes"></label>
                                                                    &#x2715;
                                                                </div>
                                                                <div class="col-2 fl">
                                                                    <label for="notes">Height</label>
                                                                    <input type="text" class="form-control" rows="5" name="ch" id="ch" oninput="show_total();" required>
                                                                </div>
                                                                <div class="col-2 fl">
                                                                    <label for="notes">Total</label>
                                                                    <input type="text" class="form-control" rows="5" name="tl1" id="tl" required>
                                                                </div>
                                                                <div class="col-2 fl">
                                                                    <label for="notes">=</label>
                                                                    <input type="text" class="form-control" rows="5" name="ml1" id="ml" >
                                                                </div>

                                                            </div>


                                                            <label for="notes"><b>Extra Body(Optional)</b></label>
                                                             <div class="form-group m-b-25 clearfix">

                                                                     <div class="col-2 fl">
                                                                         <label for="notes">Length</label>
                                                                         <input type="text" class="form-control" rows="5" name="el" id="el" oninput="show_tot();">
                                                                     </div>
                                                                     <div class="col-1 fl">
                                                                       <label for="notes"></label>
                                                                       &#x2715;
                                                                     </div>
                                                                     <div class="col-2 fl">
                                                                         <label for="notes">Width</label>
                                                                         <input type="text" class="form-control" rows="5" name="ew" id="ew" oninput="show_tot();">
                                                                     </div>
                                                                     <div class="col-1 fl">
                                                                         <label for="notes"></label>
                                                                         &#x2715;
                                                                     </div>
                                                                     <div class="col-2 fl">
                                                                         <label for="notes">Height</label>
                                                                         <input type="text" class="form-control" rows="5" name="eh" id="eh" oninput="show_tot();">
                                                                     </div>
                                                                     <div class="col-2 fl">
                                                                         <label for="notes">Total</label>
                                                                         <input type="text" class="form-control" rows="5" name="tle" id="tle" >
                                                                     </div>
                                                                     <div class="col-2 fl">
                                                                         <label for="notes">=</label>
                                                                         <input type="text" class="form-control" rows="5" name="mle" id="mle" >
                                                                     </div>
                                                                 </div>



                                                <div class="form-group account-btn text-center m-t-10">
                                                    <div class="col-12">
														<a href="<?php echo base_url(); ?>index.php/main_admin/vehicle"><button type="button" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" >Back</button></a>
                                                        <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Add</button>
                                                    </div>
                                                </div>

                                            </form>


                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            </div><!-- /.modal -->





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

function show_total(){
  //alert("sdsdfsdfgsdfgs");
  var cl = document.getElementById("cl").value;
  var cw = document.getElementById("cw").value;
  var ch = document.getElementById("ch").value;

  var total =parseFloat(Math.round(cl*cw*ch)/1728).toFixed(2) ;
  //alert(total);

  document.getElementById("tl").value = total;

}

function show_tot(){
  //alert("sdsdfsdfgsdfgs");
  var el = document.getElementById("el").value;
  var ew = document.getElementById("ew").value;
  var eh = document.getElementById("eh").value;

  var total =parseFloat(Math.round(el*ew*eh)/1728).toFixed(2) ;
//  alert(total);

  document.getElementById("tle").value = total;

}
        </script>

    </body>
</html>
