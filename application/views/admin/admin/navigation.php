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

              <!--  <li>
                    <a href="#"><i class="fa fa-address-book-o"></i> <span> Customers </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="medical-records.html">Add Customers</a></li>
                        <li><a href="record-gallery.html">Record Gallery</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="<?php echo base_url(); ?>index.php/Main_admin/product">
                        <i class="fa fa-cubes"></i><span> Products </span>
                    </a>
                </li>
                <!--<li>
                    <a href="<?php echo base_url(); ?>index.php/Main_admin/user">
                        <i class="fa fa-users"></i><span> Customers </span>
                    </a>
                </li>-->
                <li>
                      <a href="#"><i class="fa fa-users"></i> <span> Customers </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?php echo base_url(); ?>index.php/Main_admin/customer">Add customer</a></li>
                          <li><a href="<?php echo base_url(); ?>index.php/Main_admin/customer/manage_customer">Manage Customer</a></li>
                      </ul>
                  </li>

                <li>
                    <a href="<?php echo base_url(); ?>index.php/Main_admin/vehicle">
                        <i class="fa fa-truck"></i><span> Vehicles</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/Main_admin/raw_materials">
                        <i class="fa fa-building"></i><span> Raw Materials </span>
                    </a>
                </li>

                <li>
                      <a href="#"><i class="fa fa-address-book-o"></i> <span> Vendors </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?php echo base_url(); ?>index.php/Main_admin/vendor">Add Vendor</a></li>
                          <li><a href="<?php echo base_url(); ?>index.php/Main_admin/vendor/manage_vendor">Manage Vendors</a></li>
                      </ul>
                  </li>


               <li>
                        <a href="#"><i class="fa fa-money"></i> <span> Expenses </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>index.php/Main_admin/expense_category">Add Expense Category</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Main_admin/expense">Add Expenses</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Main_admin/expense_category_report">Expense Report</a></li>
                        </ul>
                    </li>
                
                <!--<li>
                      <a href="#"><i class="fa fa-users"></i> <span> Customer </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?php echo base_url(); ?>index.php/Main_admin/bill">Create Bill</a></li>
                        <!--  <li><a href="<?php echo base_url(); ?>index.php/Account/bill/manage_bill">Manage Bill</a></li>
                      </ul>
                  </li>-->
                  <li>
                      <a href="<?php echo base_url(); ?>index.php/Main_admin/bill">
                          <i class="fa fa-users"></i><span> Customer Bill </span>
                      </a>
                  </li>
                   <li>
                      <a href="<?php echo base_url(); ?>index.php/main_admin/cash_in">
                          <i class="fa fa-money"></i><span> Cash In </span>
                      </a>
                  </li>
                  
                  <li>
                      <a href="<?php echo base_url(); ?>index.php/Main_admin/guest">
                          <i class="fa fa-user"></i><span> Guest Bill</span>
                      </a>
                  </li>
                  
                  <li>
                      <a href="<?php echo base_url(); ?>index.php/Main_admin/raw_material">
                          <i class="fa fa-cubes"></i><span> Raw Material Bill</span>
                      </a>
                  </li>
                   <li>
                      <a href="<?php echo base_url(); ?>index.php/main_admin/cash_out">
                          <i class="fa fa-money"></i><span> Cash Out </span>
                      </a>
                  </li>
                  <li>
                      <a href="<?php echo base_url(); ?>index.php/main_admin/expense/display">
                          <i class="fa fa-money"></i><span> Add Expense </span>
                      </a>
                  </li>
                  
                 <!-- <li>
                        <a href="#"><i class="fa fa-money"></i> <span> Cash </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <!--<li><a href="<?php echo base_url(); ?>index.php/main_admin/cash_in">IN</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/cash_out">OUT</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/expense/display">Add Expense</a></li>
                        </ul>
                    </li>-->
                    
                        <li>
                      <a href="<?php echo base_url(); ?>index.php/Main_admin/Add_opening_balance">
                          <i class="fa fa-cubes"></i><span>Add Opening Balance </span>
                      </a>
                  </li>
                  
                  <li>
                        <a href="#"><i class="fa fa-money"></i> <span> Daily Report </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/cash_report">Cash Report</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/daily_sales_report">Daily Sales Report</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/daily_purchase_report">Daily Purchase Report</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/in_out_report">Daily Cash in/Cash out Report</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/daily_cash_payment">Daily Cash Transaction</a></li>

                        </ul>
                  </li>
                    
                      <li>
                          <a href="#"><i class="fa fa-file"></i> <span> Report </span> <span class="menu-arrow"></span></a>
                          <ul class="nav-second-level" aria-expanded="false">
                              <li><a href="<?php echo base_url(); ?>index.php/main_admin/sales_report">Sales Report</a></li>
                              <li><a href="<?php echo base_url(); ?>index.php/main_admin/purchase_report">Purchase Report</a></li>
                              <li><a href="<?php echo base_url(); ?>index.php/main_admin/customer_report">Customer Report</a></li>
                              <li><a href="<?php echo base_url(); ?>index.php/main_admin/vendor_report">Vendor Report</a></li>
                              <li><a href="<?php echo base_url(); ?>index.php/main_admin/cash_in_out_report">Cash In/Out Report</a></li>
                          </ul>
                      </li>
                      
                      <li>
                        <a href="#"><i class="fa fa-money"></i> <span> Debitor/creditor Report </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/debitor_report">Vendor Report</a></li>
                            
                            <li><a href="<?php echo base_url(); ?>index.php/main_admin/creditor_report">Customer Report</a></li>
                           

                        </ul>
                  </li>
                      
                      <!--<li>
                          <a href="#"><i class="fa fa-money"></i> <span>Balance Report </span> <span class="menu-arrow"></span></a>
                          <ul class="nav-second-level" aria-expanded="false">
                              <li><a href="<?php echo base_url(); ?>index.php/main_admin/sales_balance">Sales Balance</a></li>
                              <li><a href="<?php echo base_url(); ?>index.php/main_admin/purchase_balance">Purchase Balance</a></li>
                          </ul>
                      </li>-->

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



<?php  $d=date('Y-m-d');
           $opening=$this->db->get_where('cash_report',array('date'=>$d))->row()->opening;

           $this->db->select_sum('amount');
           $d=date('Y-m-d');
           $res=$this->db->get_where('cash_in',array('date'=>$d,'cash_in_status'=>1));
           $data10= $res->row();
           $cash_in =  $data10->amount;

           $this->db->select_sum('amount');
           $d=date('Y-m-d');
           $res=$this->db->get_where('cash_out',array('date'=>$d,'cash_out_status'=>1));
           $data20= $res->row();
           $cash_out =  $data20->amount;

           $closing=$opening+$cash_in-$cash_out;

           $data11['cash_in']=$cash_in;
           $data11['cash_out']=$cash_out;
           $data11['opening']=$opening;
           $data11['closing']=$closing;
           $data11['date']=date('Y-m-d');

           //$this->db->insert('cash_report',$data);
           $this->db->where('date',$d);
           $this->db->update('cash_report',$data11);


           $tom=date("Y-m-d", strtotime("+1 day"));
           $data14['opening']=$closing;
           $data14['date'] =$tom;

           /*$this->db->where('date',$yesterday);
           $this->db->update('cash_report',$data4);*/
             if(!isset($this->db->get_where('cash_report',array('date'=>$tom))->row()->opening)){
            $this->db->insert('cash_report',$data14);

           }
           else{
             $date=$tom;
             $data15['opening']=$closing;
             $data15['date'] =$date;
             $this->db->where('date',$date);
             $this->db->update('cash_report',$data15);

           } ?>
           
           
</div>
