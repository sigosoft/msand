<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Customer</title>
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

                  <div class="row">
                      <div class="col-12">
                          <div class="page-title-box">
                              <h4 class="page-title float-left">Customer</h4>

                              <ol class="breadcrumb float-right">
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
                                  <th>Name</th>
                                  <th>Mobile</th>
                                  <th>Amount</th>
                                  <th>Notes</th>
                                  <!--<th>View</th>-->
                                  <th>Edit Product</th>
                                  <th>Edit Customer</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                      <?php
                                   $i=1;

                                    foreach($customer as $row){ ?>
                                    <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $row['name']; ?></td>
                                  <td><?php echo $row['phone']; ?></td>
                                  <td><?php echo $row['ob']; ?></td>
                                  <td><?php echo $row['notes']; ?></td>


                                  <!--<td><a href="#"  onclick="pro_view(this,'<?php echo $row['id']; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></a></td>-->
                                  
                                  <td><a href="<?php echo base_url(); ?>index.php/main_admin/customer/edit/<?php echo $row['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                  <td><a href="<?php echo base_url(); ?>index.php/main_admin/customer/edit_customer/<?php echo $row['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                  
                                  <!--<td><a href="<?php echo base_url(); ?>index.php/main_admin/customer/edit/<?php echo $row['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                  <td><a href="<?php echo base_url(); ?>index.php/main_admin/customer/delete/<?php echo $row['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>-->
                                    </tr>
                                  <?php $i++;} ?>
                                    </tbody>
                                </table>
                                    </div>
                                </div>
                            </div>  <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->




              <!-- /.modal -->


                     <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content" >
                            <div class="modal-header" >
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" style="text-align:center"><b>Product Details</b></h4>
                     </div>
                     </br>
                     <div class="row"><!----row open-->
                     <div class="col-sm-12"><div style="text-align:center"></div></div>
                     </div><!----row close-->
                     <div class="row"><!----row open-->
                     <div class="col-sm-12" id="Product_table"></div>

                     </div><!----row close-->



                     </div>
                     </div>
                     </div>

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


        <script>
        function pro_view(el,eid){
        $('#myModal').modal('show');
        //alert(eid);
        //var invno = el.parentNode.parentNode.cells[0].textContent;
        //var tablehtml ="";
        //tablehtml +="<table class='table table-striped'><tr><th>Product</th><th>Rate</th><th>Quantity</th><th>Amount</th></tr>";
        //alert(invno);
        $.ajax({
        url: '<?php echo base_url();?>index.php/Main_admin/view_customer_product_details/'+eid,
        type:'POST',
        //contentType: 'application/json',
        dataType: 'text',
        success: function(result){
        $('#Product_table').html(result);
          //$('#oid').html(code);
        }
        });
        }
        </script>

    </body>
</html>
