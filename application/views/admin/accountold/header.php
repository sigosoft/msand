<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.html" class="logo">
                            <span>
                                <!--<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" height="26">-->
                            </span>
            <i>
                <img src="<?php echo base_url(); ?>assets/images/icon.png" alt="" height="30">
            </i>
        </a>
    </div>

    <nav class="navbar-custom">

        <ul class="list-unstyled topbar-right-menu float-right mb-0">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                     <span class="ml-1"><?php echo $this->session->userdata('name'); ?> <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!--
                    <div class="dropdown-item noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>


                    <a href="#" class="dropdown-item notify-item">
                        <i class="fi-head"></i> <span>My Account</span>
                    </a>


                    <a href="#" class="dropdown-item notify-item">
                        <i class="fi-cog"></i> <span>Settings</span>
                    </a>


                    <a href="#" class="dropdown-item notify-item">
                        <i class="fi-help"></i> <span>Support</span>
                    </a>


                    <a href="#" class="dropdown-item notify-item">
                        <i class="fi-lock"></i> <span>Lock Screen</span>
                    </a> -->


                    <a href="<?php echo base_url(); ?>index.php/main_admin/logout" class="dropdown-item notify-item">
                        <i class="fi-power"></i> <span>Logout</span>
                    </a>

                </div>
            </li>
        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
            </li>
            <li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href="#"><i class="fa fa-search"></i></a>
                </form>
            </li>
        </ul>

    </nav>

</div>
