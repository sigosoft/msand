<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FAVIICON -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png">
    <!--<link rel="icon" type="image/gif" href="<?php echo base_url(); ?>images/favicon.gif">-->
    <title>ADMIN | User </title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body class="md-skin">

    <div id="wrapper">
<?php include('navigation.php'); ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2> Add User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>User</a>
                        </li>
                        <li class="active">
                            <strong>Add User</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-6 col-xs-offset-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add User</h5>
                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">
                            <form  class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/main_admin/user/do_add">
                              <div class="form-group">
                  <label class="col-sm-2 control-label"> Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name"  name="name" required>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
				<div class="form-group">
                  <label class="col-sm-2 control-label"> Mobile</label>

                  <div class="col-sm-10">
                    <input type="phone" maxlength="10" class="form-control" id="mobile"  name="mobile" required>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
				<div class="form-group">
                  <label class="col-sm-2 control-label"> Address</label>

                  <div class="col-sm-10">
				  <textarea class="form-control" name="address" required></textarea>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
				<div class="form-group">
                  <label class="col-sm-2 control-label"> Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email"  name="email" required>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
				<div class="form-group">
                  <label class="col-sm-2 control-label"> Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password"  name="password" required>
                  </div>
                </div>
<div class="hr-line-dashed"></div>
				<div class="form-group">
                  <label class="col-sm-2 control-label"> User Type</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="user_type">
							 <option value="user">user</option>

					</select>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-primary pull-right" type="submit">Add</button>
                    </div>
                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>

        </div>
        </div>


    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
</body>

</html>
