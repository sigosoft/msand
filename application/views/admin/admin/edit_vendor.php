<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Vendors</title>
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

                  <div class="row">
                      <div class="col-12">
                          <div class="page-title-box">
                              <h4 class="page-title float-left">Vendors</h4>

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
                                  <th>Product</th>
                                  <th>Price</th>
                                  <th>Update</th>
                                  
                                    </tr>
                                    </thead>


                                    <tbody>
                                      <?php
                                   $i=1;

                                    foreach($vendor as $row){ ?>
                                    <tr>
                                  <td><?php echo $i; ?></td>
                                  <td>
                                      <select class="form-control" id="name<?php echo $i; ?>" name="name<?php echo $i; ?>">
                                          <?php $resss =  $this->db->get('raw_material')->result_array(); 
                                          foreach($resss as $ress2){?>
                                          
                                          <option value="<?=$ress2['raw_material_id']?>" <?php if($row['name'] ==  $ress2['raw_material_id']){echo "selected";} ?>><?=$ress2['raw_material_name']?></option>
                                          
                                          <?php } ?>
                                          
                                      </select>
                                      
                                  
                                  </td>
                                  <td><input type="text" class="form-control" value="<?php echo $row['price']; ?>" id="price<?php echo $i; ?>" name="price<?php echo $i; ?>" style="width:100px">
                                  <input type="hidden" value="<?php echo $row['vendor_products_id']; ?>" id="prod<?php echo $i; ?>" name="prod<?php echo $i; ?>" style="width:70px">
                                  </td>
                                  


                                 
                                  <td><button class="btn btn-success" onclick="update_data(<?php echo $i; ?>);">Update</button></td>
                                  <!--<td><a href="<?php echo base_url(); ?>index.php/main_admin/vendor/delete/<?php echo $row['vendor_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>-->
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
        url: '<?php echo base_url();?>index.php/Main_admin/view_product_details/'+eid,
        type:'POST',
        //contentType: 'application/json',
        dataType: 'text',
        success: function(result){
        $('#Product_table').html(result);
          //$('#oid').html(code);
        }
        });
        }
        
        
        function update_data(i){
            
            
        var name = document.getElementById('name'+i).value;
        var price = document.getElementById('price'+i).value;
        var prod_id = document.getElementById('prod'+i).value;
        
        $.ajax({
        url: '<?php echo base_url();?>index.php/Main_admin/vendor_update/'+name+"/"+price+"/"+prod_id,
        type:'POST',
        //contentType: 'application/json',
        dataType: 'text',
        success: function(result){
        location.reload();
        }
        });
        }
        </script>

    </body>
</html>
