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
                      <a href="<?php echo base_url(); ?>index.php/Account/bill">
                          <i class="fa fa-users"></i><span> Customer Bill </span>
                      </a>
                  </li>
                  
                <li>
                      <a href="<?php echo base_url(); ?>index.php/Account/cash_in">
                          <i class="fa fa-money"></i><span> Cash In </span>
                      </a>
                  </li>

                  <li>
                      <a href="<?php echo base_url(); ?>index.php/account/guest">
                          <i class="fa fa-user"></i><span> Guest Bill</span>
                      </a>
                  </li>
                  
                  
                  <li>
                      <a href="<?php echo base_url(); ?>index.php/account/raw_material">
                          <i class="fa fa-cubes"></i><span> Raw Material Bill </span>
                      </a>
                  </li>
                  
                  <li>
                      <a href="<?php echo base_url(); ?>index.php/Account/cash_out">
                          <i class="fa fa-money"></i><span> Cash Out </span>
                      </a>
                  </li>
                  
                  <li>
                      <a href="<?php echo base_url(); ?>index.php/Account/cash_report">
                          <i class="fa fa-money"></i><span> Cash Report </span>
                      </a>
                  </li>
                  

                 <!-- <li>
                        <a href="#"><i class="fa fa-money"></i> <span> Cash </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>index.php/Account/cash_in">IN</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Account/cash_out">OUT</a></li>
                        </ul>
                    </li>

                  
                  <li>
                        <a href="#"><i class="fa fa-money"></i> <span> Daily Report </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>index.php/account/cash_report">Cash Report</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/account/daily_sales_report">Daily Sales Report</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/account/daily_purchase_report">Daily Purchase Report</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/account/in_out_report">Daily Cash in/Cash out Report</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/account/daily_cash_payment">Daily Cash Payment</a></li>

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
