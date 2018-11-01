<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Admin | Vendor</title>
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
  .f2{
    float:left;
  }
  .modal-dialog {
    max-width: 922px;
    margin: 1.75rem auto;
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
                                    <h4 class="page-title float-left">Vendors</h4>

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
                                                <span><h4>Add Vendors</h4></span>
                                            </h2>


                                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/main_admin/vendor/do_add" method="post">
                                              <div class="form-group m-b-25 clearfix">
                                                <div class="col-12">
                                                      <div class="col-6 fl">
                                                        <label for="notes">Date</label>
                                                        <input type="date" class="form-control" rows="5" name="date" value="<?php echo date('Y-m-d'); ?>" required>

                                                      </div>

                                                      <div class="col-6 fl">
                                                        <label for="notes">Name</label>

                                                        <input type="text" class="form-control" rows="5" name="name" required>
                                                      </div>
                                                      </div>
                                                        </div>
                                                      <div class="form-group m-b-25 clearfix">
                                                      <div class="col-12">
                                                      <div class="col-6 fl">
                                                        <label for="notes">Mobile </label>
                                                        <input type="text" class="form-control" rows="5" name="mobile" required>
                                                      </div>

                                                     <div class="col-6 fl">
                                                        <label for="notes">Amount</label>

                                                        <input type="text" class="form-control" rows="5" name="amount">
                                                      </div>
                                                      </div>

                                                  </div>
                                                  <div class="form-group m-b-25 clearfix">
                                                <div class="col-12">
                                
                                                     <div class="col-6 fl">
                                                        <label for="notes">Notes</label>
                                                        <!--<input type="text" class="form-control" rows="5" name="email">-->
                                                        <textarea name="notes" class="form-control"></textarea>
                                                        <input type="hidden" class="form-control" rows="5" name="logid" value="<?php echo $this->session->userdata('login_id'); ?>">
                                                      </div>
                                                      
                                                      </div>
                                                        </div><br><br><br>

                                                       <label for="notes"><b>Add Products</b></label><br>
                                                        <div class="form-group m-b-25 clearfix">
                                                          <div class="col-12">
                                                            <div class="col-4 fl">
                                                              <label for="notes">Name</label>
                                                              <select class="form-control" rows="5" name="name1" id="name1" onchange="showprice()" >
                                                                <option value="0">Select product</option>
                                                                <?php $res =  $this->db->get('raw_material')->result_array();
                                                                      foreach($res as  $r){
                                                                 ?>
                                                                <option value="<?php echo $r['raw_material_id']; ?>"> <?php echo $r['raw_material_name']; ?> </option>
                                                              <?php } ?>
                                                              </select>
                                                            </div>

                                                                <div class="col-2 fl">
                                                                  <label for="notes">Price</label>
                                                                  <input type="text" class="form-control" rows="5" name="price" id="price"  >
                                                                </div>

                                                                <div class="col-2 fl">
                                                                
                                                                  <input type="hidden" class="form-control" rows="5" name="qty" id="qty" oninput="caltot();" >
                                                                </div>

                                                                <div class="col-2 fl">
                                                                       <input type="hidden" class="form-control" rows="5" name="total" id="total" >
                                                                  <input type="hidden" class="form-control" rows="5" name="logid" id="logid" value="<?php echo $this->session->userdata('login_id'); ?>">
                                                                </div>

                                                                <div class="col-2 fl">
                                                                  <label for="notes"></label>
                                                                  <input type="button" class="form-control" name="TxtAdditem" onclick="additems();" style="background-color:#ff751a;cursor:pointer " value="Add Item">
                                                                </div>

                                                                </div>
                                                          </div>

<br><br>
                                                          <!------------------------------------------------------->
                                                          <div class="box-body">
                                                          <div class="col-md-11">
                                                          <div id="view_vendor_temp_table"><!----Table View--->

                                                          </div><!----Table View--->
                                                          </div>
                                                                      </div>
                                                          <!---------------------------------------->

<br><br>


                                                <div class="form-group account-btn text-center m-t-10">
                                                    <div class="col-12">
														<a href="<?php echo base_url(); ?>index.php/main_admin/vendor"><button type="button" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" >Back</button></a>
                                                        <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Submit</button>
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

        </script>

<script>
function additems()
{

//alert("adsdsdsdfsdf");
     name=document.getElementById("name1").value;
     price=document.getElementById("price").value;
     qty=1;
     total=1;
     logid=document.getElementById("logid").value;
       //alert(name);alert(price);alert(qty);alert(total);alert(logid);

if(name=='' || price=='' || qty=='' || total==''){alert('Please Fill All The Fields');}
else{
   object=new XMLHttpRequest();

     ur="<?php echo base_url();?>index.php/main_admin/addtemppurchase/"+name+"/"+price+"/"+qty+"/"+total+"/"+logid;

     object.open("post",ur,true);
//alert("ok");
     object.send();

      object.onreadystatechange=function()
{

  if(object.readyState==4 && object.status==200)
  {
   document.getElementById("name1").value="";
    document.getElementById("price").value="";
     document.getElementById("qty").value="";
    document.getElementById("total").value="";


  var x=object.responseText.split("||");
  //var val=parseInt(x[1]);
//alert("ooooooooooookkkkkkkkkkkkkk");
//alert(object.responseText);
  document.getElementById("view_vendor_temp_table").innerHTML=x[1];
  }
}

}

}

function caltot(){
  var price = document.getElementById("price").value;
  var qty = document.getElementById("qty").value;
  //alert(price);alert(qty);
  var amt = (price)*(qty);
  //alert(amt);
document.getElementById("total").value = amt;
}

function showprice(){
    var name = document.getElementById("name1").value;
   s=name.value;

//alert(name);

$.ajax({url: '<?php echo base_url(); ?>index.php/Main_admin/add_price/'+name, success: function(result){
    document.getElementById("price").value = result;
    //alert(result);
}});
}


function delete_data(delid)
{
	   //item=document.getElementById("TxtItem").value;
       //qty=document.getElementById("TxtQuantity").value;
       //price=document.getElementById("TxtPrice").value;
	   logid=document.getElementById("logid").value;
	  /* alert(item);
	   	   alert(quantity);

		   	   alert(price);

			   	   alert(logid);*/

	   object=new XMLHttpRequest();

       ur="<?php echo base_url();?>index.php/Main_admin/deletetempreport/"+delid+"/"+logid;

       object.open("post",ur,true);
//alert("ok");
       object.send();

        object.onreadystatechange=function()
	{

		if(object.readyState==4 && object.status==200)
		{
      name=document.getElementById("name1").value;
      price=document.getElementById("price").value;
      qty=document.getElementById("qty").value;
      total=document.getElementById("total").value;
      logid=document.getElementById("logid").value;

		var x=object.responseText.split("||");
		//var val=parseInt(x[1]);
		//document.getElementById("view_sales_temp_table").innerHTML=x[2];
		//alert(x[1]);
		//alert(object.responseText);
		document.getElementById("view_vendor_temp_table").innerHTML=x[1];
		}
	}
}
</script>
    </body>
</html>
