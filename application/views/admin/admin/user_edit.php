<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Customers</title>
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
                                    <h4 class="page-title float-left">Products</h4>

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
                                                <span><h4>Edit Products</h4></span>
                                            </h2>

                                            <?php foreach($users as $row){ ?>
                                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/main_admin/user/update/<?php echo $row['id'] ;?>" method="post">


											                    	<div class="form-group m-b-25">
                                                    <div class="col-12">
                                                        <label for="notes">Customer Name</label>
                                                        <input type="text" class="form-control" rows="5" name="name" value="<?php echo $row['name']; ?>">

                                                    </div>
                                                </div>
                                                <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                            <label for="notes">Customer Phone Number</label>
                                                            <input type="text" class="form-control" rows="5" name="phone" value="<?php echo $row['phone']; ?>">

                                                        </div>
                                                    </div>

                                                    <div class="form-group m-b-25">
                                                            <div class="col-12">
                                                                <label for="notes">Customer Address</label>
                                                                <textarea class="form-control" name="address"><?php echo $row['address']; ?></textarea>


                                                            </div>
                                                        </div>


                                                <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                            <label for="notes">Psand Price</label>
                                                            <?php
                                                            $res = $this->db->get_where('product',array('name'=>'psand'))->row()->price;
                                                            $res1 = $this->db->get_where('customer',array('id'=>$row['id']))->row()->psand;
                                                            ?>
                                                              <input type="number" class="form-control" rows="5" name="psand" min="<?php  echo $res; ?>" value="<?php  echo $res1; ?>">

                                                        </div>
                                                    </div>

                                                    <div class="form-group m-b-25">
                                                            <div class="col-12">
                                                                <label for="notes">Msand Price</label>
                                                                <?php
                                                                $res = $this->db->get_where('product',array('name'=>'msand'))->row()->price;
                                                                $res1 = $this->db->get_where('customer',array('id'=>$row['id']))->row()->msand;
                                                                ?>
                                                                  <input type="number" class="form-control" rows="5" name="msand" min="<?php  echo $res; ?>" value="<?php  echo $res1; ?>">

                                                              <!--  <input type="text" class="form-control" rows="5" name="msand" value="<?php echo $row['msand']; ?>"> -->

                                                            </div>
                                                        </div>

                                                <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                            <label for="notes">Waste Price</label>

                                                            <?php
                                                            $res = $this->db->get_where('product',array('name'=>'waste'))->row()->price;
                                                            $res1 = $this->db->get_where('customer',array('id'=>$row['id']))->row()->waste;
                                                            ?>
                                                              <input type="number" class="form-control" rows="5" name="waste" min="<?php  echo $res; ?>" value="<?php  echo $res1; ?>">


                                                          <!--  <input type="text" class="form-control" rows="5" name="waste" value="<?php echo $row['waste']; ?>"> -->

                                                        </div>
                                                    </div>

                                                <div class="form-group account-btn text-center m-t-10">
                                                    <div class="col-12">
														<a href="<?php echo base_url(); ?>index.php/main_admin/user"><button type="button" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" >Back</button></a>
                                                        <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Edit</button>
                                                    </div>
                                                </div>

                                            </form>

                                          <?php } ?>
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

        </script>

    </body>
</html>
