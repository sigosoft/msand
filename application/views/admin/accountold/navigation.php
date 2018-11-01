<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="#">
                        <i class="fa fa-home"></i><span> Home </span>
                    </a>
                </li>

                <li>
                      <a href="#"><i class="fa fa-users"></i> <span> Customer </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?php echo base_url(); ?>index.php/Account/bill">Create Bill</a></li>
                        <!--  <li><a href="<?php echo base_url(); ?>index.php/Account/bill/manage_bill">Manage Bill</a></li>-->
                      </ul>
                  </li>

                  <li>
                      <a href="<?php echo base_url(); ?>index.php/account/guest">
                          <i class="fa fa-user"></i><span> Guest </span>
                      </a>
                  </li>

                  <li>
                        <a href="#"><i class="fa fa-money"></i> <span> Cash </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>index.php/Account/cash_in">IN</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Account/cash_out">OUT</a></li>
                        </ul>
                    </li>

                  <li>
                      <a href="<?php echo base_url(); ?>index.php/account/raw_material">
                          <i class="fa fa-cubes"></i><span> Raw Material </span>
                      </a>
                  </li>


              <!--  <li>
                    <a href="#">
                        <i class="fa fa-balance-scale"></i><span> Stock </span>
                    </a>
                </li> -->
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
