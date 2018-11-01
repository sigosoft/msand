<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Bill</title>
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

        <link href="<?php echo base_url(); ?>assets/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    </head>

<style>
  .fl{
    float:left;
  }
  .col-6{
      float:left;
  }
  .mt30{
    margin-top: 30px;
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
                                    <h4 class="page-title float-left">CASH IN</h4>

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
                                                <span><h4>CASH IN</h4></span>
                                            </h2>

                                            <div class="form-group m-b-25 clearfix">

                                             <div class="col-6 fl">
                                              <label for="notes" ><b>Customer</b></label>
                                              <input type="radio" name="rad" onclick="show_customer();" checked="checked">
                                             </div>
                                             <div class="col-6 fl">
                                               <label for="notes" ><b>Vendor</b></label>
                                               <input type="radio" name="rad" onclick="show_vendor();">
                                             </div>
                                             </div>

                                            <div id="cust1" >
                                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/account/cash_in/do_add" method="post">
                                                <div class="form-group m-b-25">
                                                        <div class="col-12">
                                                              <div class="form-group m-b-25 clearfix">

                                                                      <div class="col-8 fl">
                                                                          <label for="notes" ><b>Customer</b></label>
                                                                          <select class="form-control selectpicker " data-live-search="true" onchange="show_balance();" name="customer" id="customer">
                                                                          <option value="0">select Customer</option>
                                                                          <?php $r = $this->db->get('customer')->result_array();
                                                                                foreach($r as $res) {?>
                                                                          <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>
                                                                        <?php } ?>
                                                                      </select>
                                                                          <!--<input type="text"   rows="5" name="rad" id="rad" required value="customer" onclick="show_customer();">-->
                                                                      </div>
                                                                      <div class="col-4 fl">
                                                                          <label for="notes" ><b>Balance</b></label>

                                                                          <input type="text" class="form-control"   name="balance" id="balance" required onclick="show_customer();">
                                                                      </div>

                                                                  </div>

                                                                      <div class="form-group m-b-25 clearfix">

                                                                              <div class="col-12 fl">
                                                                                  <label for="notes" ><b>Amount</b></label>

                                                                                  <input type="number" class="form-control"   name="amount" id="amount" required >
                                                                              </div>

                                                                          </div>

                                                        </div>
                                                    </div>

                                                        <div class="form-group m-b-25">
                                                                <div class="col-12">

                                                                      <div class="form-group m-b-25 clearfix">

                                                                              <div class="col-12 ">
                                                                                  <label for="notes" ><b>Notes</b></label>
                                                                                  <textarea class="form-control"  name="notes"></textarea>
                                                                              </div>


                                                                          </div>

                                                                </div>
                                                            </div>


                                                <div class="form-group account-btn text-center m-t-10">
                                                    <div class="col-12">
														<a href="<?php echo base_url(); ?>index.php/account/bill"><button type="button" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" >Back</button></a>
                                                        <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Print</button>
                                                    </div>
                                                </div>

                                            </form>
                                          </div>

                                          <div id="vend1" style="display:none">
                                          <form class="form-horizontal " action="<?php echo base_url(); ?>index.php/account/cash_in/vendor_do_add" method="post">

                                           <div class="form-group m-b-25 clearfix "  >
                                                                   <div class="col-12 fl">
                                                                       <label for="notes" ><b>Vendor</b></label>
                                                                       <select class="form-control selectpicker" data-live-search="true" onchange="show_balance1();"  name="customer1" id="customer1">
                                                                       <option value="0">select Vendor</option>
                                                                       <?php $r = $this->db->get('vendor')->result_array();
                                                                             foreach($r as $res) {?>
                                                                       <option value="<?php echo $res['vendor_id']; ?>"><?php echo $res['name']; ?></option>
                                                                     <?php } ?>
                                                                   </select>
                                                                       <!--<input type="text"   rows="5" name="rad" id="rad" required value="customer" onclick="show_customer();">-->
                                                                   </div>
                                                                   <div class="col-4 fl">
                                                                       
                                                                       <input type="hidden" class="form-control"   name="balance1" id="balance1" required >
                                                                   </div>
                                                               </div>
                                                                   <div class="form-group m-b-25 clearfix " >
                                                                           <div class="col-12 fl">
                                                                               <label for="notes" ><b>Amount</b></label>
                                                                               <input type="number" class="form-control"   name="amount1" id="amount" required >
                                                                           </div>

                                                                   </div>

                                                           <div class="form-group m-b-25">
                                                             <div class="col-12">
                                                                   <div class="form-group m-b-25 clearfix " >

                                                                           <div class="col-12 ">
                                                                               <label for="notes" ><b>Notes</b></label>
                                                                               <textarea class="form-control"  name="notes1"></textarea>
                                                                           </div>
                                                                       </div>
                                                             </div>
                                                           </div>
                                               <div class="form-group account-btn text-center m-t-10" >
                                                   <div class="col-12">
                          <a href="<?php echo base_url(); ?>index.php/account/bill"><button type="button" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" >Back</button></a>
                                                       <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Print</button>
                                                   </div>
                                               </div>
                                                 </form>
                                               </div>


                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            </div><!-- /.modal -->


                            <div class="row"><!----row open-->
                            <div class="col-sm-12" id="Product_table"></div>

                            </div><!----row close-->



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

        <script src="<?php echo base_url(); ?>assets/bootstrap-select/bootstrap-select.min.js"></script>

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
var prices;
  function show_details(a){
//$('#myModal').modal('show');
//alert(a.value);
    eid = a.value;
    $.ajax({
    url: '<?php echo base_url();?>index.php/Account/view_product_details/'+eid,
    type:'POST',
    //contentType: 'application/json',
    dataType: 'text',
    success: function(result){
    $('#Product_table').html(result);
      //$('#oid').html(code);
      //alert(result);
    }
    });
  }


  function show_customer(){
    //alert("ok");

    var a = document.getElementById("rad").value;
    /*if( a == "customer"){
      //document.getElementById("disp").style.display = "block";
      alert(a);
    }*/
    var b = "msand";
    alert(prices.b);
}

function show_balance(){
  var cust_id = document.getElementById("customer").value;
  //alert(bal);
  /*$.ajax({
          method: "POST",
          url: "<?php echo site_url('account/getPrices');?>",
          dataType : "json",
          data : { user_id : bal },
          success : function( data ){
            prices = data;
          }
        });*/
        $.ajax({url: '<?php echo base_url(); ?>index.php/account/show_customer_balance/'+cust_id, success: function(result){
            document.getElementById("balance").value = result;
            //alert(result);
        }});

}

function show_price(){
  var product = document.getElementById("product").value;
   document.getElementById("price").value = prices.psand;
}

function calc_total(){
  var qty = document.getElementById("qty").value;
  var price = document.getElementById("price").value;
  var tot = (qty*price);
  document.getElementById("total").value = tot;
}

function show_customer(){
  document.getElementById("vend1").style.display = "none";
  document.getElementById("cust1").style.display = "block";
}
function show_vendor(){
document.getElementById("cust1").style.display = "none";
document.getElementById("vend1").style.display = "block";

}
function show_balance1(){
  var cust_id = document.getElementById("customer1").value;
  //alert(id);

        $.ajax({url: '<?php echo base_url(); ?>index.php/account/getPrices_vendor_products/'+cust_id, success: function(result){
          document.getElementById("balance1").value = result;
            //alert(result);
        }});


}
</script>
    </body>
</html>
