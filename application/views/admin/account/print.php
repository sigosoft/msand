<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
body {
  background: rgb(204,204,204);
}
div {
    display: block;
}

page {
	position: relative;
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}

	.container-fluid{
		padding-right: 15px;
    	padding-left: 15px;
    	margin-right: auto;
    	margin-left: auto;
	}
	.container {
    	width: 90%;
	}
	.container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
	.row {
		width: 100%;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
	}
	.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
	.clearfix:after, .dl-horizontal dd:after, .container:after, .container-fluid:after, .row:after, .form-horizontal .form-group:after, .btn-toolbar:after, .btn-group-vertical>.btn-group:after, .nav:after, .navbar:after, .navbar-header:after, .navbar-collapse:after, .pager:after, .panel-body:after, .modal-header:after, .modal-footer:after {
    clear: both;
}
	.clearfix:before, .clearfix:after, .dl-horizontal dd:before, .dl-horizontal dd:after, .container:before, .container:after, .container-fluid:before, .container-fluid:after, .row:before, .row:after, .form-horizontal .form-group:before, .form-horizontal .form-group:after, .btn-toolbar:before, .btn-toolbar:after, .btn-group-vertical>.btn-group:before, .btn-group-vertical>.btn-group:after, .nav:before, .nav:after, .navbar:before, .navbar:after, .navbar-header:before, .navbar-header:after, .navbar-collapse:before, .navbar-collapse:after, .pager:before, .pager:after, .panel-body:before, .panel-body:after, .modal-header:before, .modal-header:after, .modal-footer:before, .modal-footer:after {
    content: " ";
    display: table;
}
	.col-1{
		width: 8.333333%;
	}
	.col-2{
		width: 16.66666667%;
	}
	.col-3{
		width: 25%;
	}
	.col-4{
		width: 33.333333%;
	}
	.col-5{
		width: 41.6666667%;
	}
	.col-6{
		width: 50%;
	}
	.col-7{
		width: 58.333333%;
	}
	.col-8{
		width: 66.666666%;
	}
	.col-9{
		width: 75%;
	}
	.col-10{
		width: 83.333333%;
	}
	.col-11{
		width: 91.66666%;
	}
	.col-12{
		width:100%;
	}
	.text-center{
		text-align: center;
	}
	.mt10{
		margin-top: 10px;
	}
	.mt20{
		margin-top: 20px;
	}
	.mt30{
		margin-top: 30px;
	}
	.mt40{
		margin-top: 40px;
	}
	.mt50{
		margin-top: 50px;
	}
	.mt60{
		margin-top: 60px;
	}
	.p0{
		padding: 0 !important;
	}
	.pt10{
		padding-top: 10px;
	}
	.pt20{
		padding-top: 20px;
	}
	.pt30{
		padding-top: 30px;
	}
	.pt40{
		padding-top: 40px;
	}
	.pt50{
		padding-top: 50px;
	}
	.pt60{
		padding-top: 60px;
	}
	.pb30{
		padding-bottom: 30px;
	}
	.pb20{
		padding-bottom: 20px;
	}
	.img-responsive{
    	display: block;
    	max-width: 100%;
    	height: auto;
	}
	.pull-right{
		float: right;
	}
	h3{font-size: 21px; margin: 0; font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";}
	h4{font-size: 18px; margin: 0; font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";}
	p{font-size: 15px; margin: 0; font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif"; line-height: 24px;}
	.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12 {
    position: relative;
    min-height: 1px;
	}
	.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12 {
		float: left;
	}
	.border1{
		border-top: 2px dashed #000;
	}
	h4{
		line-height: 24px;
	}
	p{
		line-height: 30px;
	}
	footer{
  		position:absolute;
  		bottom:0;
  		width:100%;
  		height:auto;
		padding-bottom: 20px;
	}
</style>
<body onload="test()">
	<section>
		<page size="A4">
		<section class="pt30 pb30">
			<div class="container" >
				<div class="row">
					<div class="col-12">
            <?php $res = $this->db->get_where('customer_print',array('customer_print_id'=>$id))->result_array();
                  foreach($res as $row){
            ?>
						<p class="col-4">No</p> <p class="col-3">:</p><p class="col-4"><strong><?php echo $row['credit_invoice_no']; ?></strong></p>
						<p class="col-4">Date</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $row['date']; ?></strong></p>
						<p class="col-4">Time</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $row['cur_date']; ?></strong></p>
						<p class="col-4">Name</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $this->db->get_where('customer',array('id'=>$row['customer']))->row()->name;  ?></strong></p>
						<p class="pull-right pt40">Signature</p>
          <?php } ?>

					</div>
				</div>
			</div>
		</section>
		<section class="pt30 pb30 border1">
			<div class="container">
				<div class="row">
					<div class="col-12">
            <?php $res = $this->db->get_where('customer_print',array('customer_print_id'=>$id))->result_array();
                  foreach($res as $row){
            ?>
						<p class="col-4">No</p> <p class="col-3">:</p><p class="col-4"><strong><?php echo $row['credit_invoice_no']; ?></strong></p>
						<p class="col-4">Date</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $row['date']; ?></strong></p>
						<p class="col-4">Time</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $row['cur_date']; ?></strong></p>
						<p class="col-4">Reg.No</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $row['vehicle']; ?></strong></p>
						<p class="col-4"></p> <p class="col-3"></p><p class="col-4"><strong><b><?php echo $this->db->get_where('product',array('id'=>$row['product']))->row()->name; ?></b></strong></p>
            <p class="col-4"></p> <p class="col-3"></p><p class="col-4"><strong><b><?php  echo $row['quantity']; ?></b></strong></p>
						<p class="pull-right pt40">Signature</p>

          <?php } ?>
					</div>
				</div>
			</div>
		</section>
			<section class="pt30 pb30 border1">
			<div class="container">
				<div class="row">
					<div class="col-12">
            <?php $res = $this->db->get_where('customer_print',array('customer_print_id'=>$id))->result_array();
                  foreach($res as $row){
            ?>
						<p class="col-4">No</p> <p class="col-3">:</p><p class="col-4"><strong><?php echo $row['credit_invoice_no']; ?></strong></p>
						<p class="col-4">Date</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $row['date']; ?></strong></p>
						<p class="col-4">Time</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $row['cur_date']; ?></strong></p>
						<p class="col-4">Vehicle</p> <p class="col-3">:</p> <p class="col-4"><strong><?php echo $row['vehicle']; ?></strong></p>
						<h4 class="col-8 text-center pt20"><b><?php echo $this->db->get_where('product',array('id'=>$row['product']))->row()->name; ?></b></h4>
            <?php
            $qty = $row['quantity'];
            $company_body = $this->db->get_where('vehicle',array('reg_number'=>$row['vehicle']))->row()->company_body_manual;
            $extra_body = $this->db->get_where('vehicle',array('reg_number'=>$row['vehicle']))->row()->extra_body_manual;
            //$m1 = ($qty+$company_body)/2;
            //$m2 = ($qty+$extra_body)/2;
            $m1 =abs($qty-$company_body);
            $m2 =abs($qty-$extra_body);
            if($m1<$m2){
              $result=$qty-$company_body;
              if($result<0){ ?>
                <h4 class="col-8 text-center"><?php echo $company_body. $result; ?>=<?php echo $row['quantity']; ?></h4>

            <?php  } else{

              ?>

              <h4 class="col-8 text-center"><?php echo $company_body."+". $result; ?>=<?php echo $row['quantity']; ?></h4>
          <?php  } }
            else{
              if($qty<$extra_body){
                $result= $qty-$extra_body; ?>
                <h4 class="col-8 text-center"><?php echo $extra_body. $result; ?>=<?php echo $row['quantity']; ?></h4>
            <?php  } else{
              $result= $qty-$extra_body;?>
              <h4 class="col-8 text-center"><?php echo $extra_body."+". $result; ?>=<?php echo $row['quantity']; ?></h4>
          <?php  }}
             ?>


						<p class="pull-right pt40">Signature</p>
          <?php } ?>
					</div>
				</div>
			</div>
		</section>
<section class="pt30 pb30 border1"></section>










		</page>
	</section>

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



  <script>
  window.onload = function() {
  window.print();
  window.location.href = "<?php echo base_url(); ?>index.php/account/bill";
}

   </script>

</body>
</html>
