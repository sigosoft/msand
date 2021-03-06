<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Customers</title>
        <meta name="Msansd" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
                                    <h4 class="page-title float-left">Expense</h4>

                                    <ol class="breadcrumb float-right">
                                       <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md"  data-toggle="modal" data-target="#add-record">Add Expense</button>
                                      <!-- <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md"   data-target="#">Add Products</button>-->
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

						           <div id="add-record" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <h2 class="text-uppercase text-center m-b-30">
                                                <span><h4>Expense</h4></span>
                                            </h2>


                                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/main_admin/expense/add" method="post">


											                    	<div class="form-group m-b-25">
                                                    <div class="col-12">
                                                        <label for="notes">Expense Name</label>
                                                        <input type="text" class="form-control" rows="5" name="name" >

                                                    </div>
                                                </div>
                                                <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                            <label for="notes">Expense category</label>
                                                            <select class="form-control" rows="5" name="category" required>
                                                              <option value="0">Select Category</option>
                                                              <?php $res = $this->db->get('expense_category')->result_array();
                                                                    foreach($res as $r){?>
                                                              <option value="<?php echo $r['exp_catid']; ?>"><?php echo $r['name']; ?></option>
                                                            <?php } ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                            <label for="notes">Amount</label>
                                                            <input type="number" class="form-control" rows="5" name="amount" required>

                                                        </div>
                                                    </div>



                                                    <div class="form-group m-b-25">
                                                            <div class="col-12">
                                                                <label for="notes">Notes</label>
                                                                <textarea class="form-control" rows="5" name="notes"></textarea>

                                                            </div>
                                                        </div>

                                                        <div class="form-group m-b-25">
                                                                <div class="col-12">
                                                                    <label for="notes">Date</label>
                                                                    <input type="date" class="form-control" rows="5" name="date" value="<?php echo date('Y-m-d'); ?>">

                                                                </div>
                                                            </div>

                                                <div class="form-group account-btn text-center m-t-10">
                                                    <div class="col-12">
														<button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                                                        <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Add</button>
                                                    </div>
                                                </div>

                                            </form>


                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            </div><!-- /.modal -->


                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">

                                     <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Cancel</th>
								    <!--<th>Delete</th>-->
                                </tr>
                                </thead>


                                <tbody>
                                  <?php
                                  $i=1;
                                //$product= $this->db->get('product')->result_array();

                                  foreach($expense as $row){ ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo $row['expense_name']; ?></td>
                                    <td><?php echo $this->db->get_where('expense_category',array('exp_catid'=>$row['category']))->row()->name;  ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <!--<td><a href="<?php echo base_url(); ?>index.php/main_admin/expense/edit/<?php echo $row['expense_id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                    <td><a href="<?php echo base_url(); ?>index.php/main_admin/expense/delete/<?php echo $row['expense_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>-->
                                    <td><a href="<?php echo base_url();?>index.php/main_admin/expense/status_cancel_expense/<?php echo $row['expense_id']; ?>"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a></td>
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
