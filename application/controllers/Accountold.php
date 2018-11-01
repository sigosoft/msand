<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Account extends CI_Controller {


 function __construct()
   {
       parent::__construct();
       $this->load->database();
       $this->load->model('Crud_model','crud_model');
       $this->load->model('Common_model','common_model');
       $this->load->helper(array('form', 'url'));
       $this->load->helper('nav');
   }

   public function index()
     {
         $this->load->view('admin/index');
     }
   public function dashboard()
       {
           $this->load->view('admin/Account/dashboard');
       }
/**********************************************************************/
public function bill($param1='',$param2='')
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/account/index','refresh');
  }
  else{
    if($param1 == ''){

			$this->load->view('admin/account/create_bill');
		}
    elseif($param1 == "find_detail"){
      echo $param2;
      //$res = $this->db->get_where()
    }
    elseif($param1 == "do_add"){
      date_default_timezone_set('Asia/Kolkata');
      $reg_no = $this->input->post('reg_no');

      $last_invoice = $this->db->get_where('customer_print_last_invoice',array('customer_print'=>'1'))->row()->customer_print_no;

      /*if($last_invoice == "1001"){
        $last_invoice="1";
      }

      $data3['customer_print_no'] = $last_invoice+1;*/
      
      if($last_invoice == "INV005000"){
        $last_invoice="INV000";
      }

      $invid=str_split($last_invoice,5);
			$inv=(int)$invid[1]+1;
			$last_invoice="INV"."00".$inv;
      $data3['customer_print_no'] = $last_invoice;

      $this->db->where('customer_print','1');
      $this->db->update(' customer_print_last_invoice',$data3);
      $avg = round($this->input->post('total')/$this->input->post('qty'),2);

      $data1 = array(
     'product' => $this->input->post('product'),
     'credit_invoice_no' => $last_invoice,
     'price' => $this->input->post('price'),
     'quantity' => $this->input->post('qty'),
     'total' => $this->input->post('total'),
     'average' => $avg,
     'vehicle' => $this->input->post('reg_no'),
     'customer' => $this->input->post('customer'),
     'notes' => $this->input->post('notes'),
     'balance' => $this->input->post('balance'),
     'date' => date('Y-m-d'),
     'cur_date' => date('h:i:s a', time())
      );

      $this->common_model->insert('customer_print',$data1);
      $id=$this->db->insert_id();

      
      $data = array(
     'CustomerID' => $this->input->post('customer'),
     'Amount' => $this->input->post('price'),
     'Type' => "Credit",
     'CLDate' =>date('Y-m-d'),
     'cash_in_time' => date('h:i:s a', time())
      );
      $this->common_model->insert('customer_ledger',$data);

      $data2 = array(
      'CustomerID' => $this->input->post('customer'),
      'Type' => "Credit",
      'TransName' => "Credit",
      'Amount' =>$this->input->post('price'),
      'Transdate' => date('Y-m-d')
      );
      $this->common_model->insert('ledger',$data2);
 //$this->common_model->insert('bill',$data);

      $data3 = array(
     'product' => $this->input->post('product'),
     'invoice_no' => $last_invoice,
     'price' => $this->input->post('price'),
     'quantity' => $this->input->post('qty'),
     'total' => $this->input->post('total'),
     'vehicle' => $this->input->post('reg_no'),
     'customer' => $this->input->post('customer'),
     'user_type' => 'Sale',
     'date' => date('Y-m-d'),
     'cur_date' => date('h:i:s a', time())
      );
      $this->common_model->insert('sale',$data3);
 
 redirect(base_url().'index.php/account/print1/'.$id,'refresh');
    }

  }
}
/******************************************************************************/


public function view_product_details($id)
  {
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
        $id=str_replace("%20"," ",$id);
      $tablehtml="<table class='table table-striped'><tr><th>Reg.No</th><th>Company Body</th><th>Extra Body</th></tr>";
      $r="select * from vehicle where reg_number='$id'";
      $res1=$this->db->query($r);
      $res= $res1->result_array();
      foreach ($res as $row) {
        $c = $row['company_body_manual'];
        $e = $row['extra_body_manual'];
        $tablehtml =$tablehtml."<tr><td>". $row['reg_number'] ."</td><td>$c Sqft</td><td>$e Sqft</td></tr>";
      }
      $tablehtml =$tablehtml."</table>";
      echo $tablehtml;
  }
}
 public function add_vehicle($param1="",$param2=""){
   if($this->session->userdata('user_type') == ""){
     redirect(base_url() . 'index.php/account/index','refresh');
   }
   else{
     if($param1==""){
       $this->load->view('admin/account/add_vehicle');
     }
     elseif($param1=="do_add"){
       $name = $this->input->post('name');
       $model = $this->input->post('model');
       $reg1 = $this->input->post('reg');
       $reg = strtoupper($reg1);
       $cl = $this->input->post('cl');
       $cw = $this->input->post('cw');
       $ch = $this->input->post('ch');
       if($this->input->post('el') != ""){
              $data = array(
             'name' => $name,
             'model' => $model,
             'reg_number' => $reg,
             'cl' => $cl,
             'cw' => $cw,
             'ch' => $ch,
             'el' => $this->input->post('el'),
             'ew' => $this->input->post('ew'),
             'eh' => $this->input->post('eh'),
             'extra_body_actual' => $this->input->post('tle'),
             'extra_body_manual' => $this->input->post('mle'),
             'company_body_actual' => $this->input->post('tl1'),
             'company_body_manual' => $this->input->post('ml1'),
             'insert_date' => date('Y-m-d')
         );
       }
       else{
               $data = array(
              'name' => $name,
              'model' => $model,
              'reg_number' => $reg,
              'cl' => $cl,
              'cw' => $cw,
              'ch' => $ch,
              'company_body_actual' => $this->input->post('tl1'),
              'company_body_manual' => $this->input->post('ml1'),
              'insert_date' => date('Y-m-d')
          );
       }

       $this->common_model->insert('vehicle',$data);
       redirect(base_url().'index.php/account/bill','refresh');
     }

 }

 }

 public function print1($param1="",$param2=""){
   if($this->session->userdata('user_type') == ""){
     redirect(base_url() . 'index.php/account/index','refresh');
   }
   else{
     if($param1==""){
       $this->load->view('admin/account/print');
     }
     else{

       $data['id'] = $param1;
       $this->load->view('admin/account/print',$data);
     }
   }
 }



 	public function logout()
 	{
 		$this->crud_model->logout();
 		$this->load->view('admin/index');
 	}

  public function show_balance($bal){
    $this->session->set_userdata('customer',$bal);
    $bal = $this->session->userdata('customer');
    echo $bal;
  }
  public function show_price($pro){
    $this->session->set_userdata('product',$pro);
    $pro = $this->session->userdata('product');
    $id = $this->session->userdata('customer');
    $pro =  $this->db->get_where('customer',array('id'=>$id))->result_array();
    foreach($pro as $res){
      print_r($res);
    }
  }
  public function getPrices()
  {
    $id = $_POST['user_id'];
    $data = $this->common_model->get_details('customer',array('id' => $id))->row();
    print_r(json_encode($data));
  }

  public function guest($param1="",$param2=""){
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
      if($param1==""){
        $this->load->view('admin/account/guest_bill');
      }
      elseif($param1 == "do_add"){
        date_default_timezone_set('Asia/Kolkata');
        $reg_no = $this->input->post('reg_no');

        //$last_invoice = $this->db->get_where('guest_last_invoice_id',array('guest_last_id'=>'1'))->row()->last_invoice_id;
        $last_invoice = $this->db->get_where('customer_print_last_invoice',array('customer_print'=>'1'))->row()->customer_print_no;

        /*if($last_invoice == "1001"){
          $last_invoice="1";
        }

        $data3['last_invoice_id'] = $last_invoice+1;*/
        if($last_invoice == "INV005000"){
          $last_invoice="INV000";
        }

        $invid=str_split($last_invoice,5);
  			$inv=(int)$invid[1]+1;
  			$last_invoice="INV"."00".$inv;
       /* $data3['last_invoice_id'] = $last_invoice;
        $this->db->where('guest_last_id','1');
        $this->db->update('guest_last_invoice_id',$data3);*/
         $data3['customer_print_no'] = $last_invoice;
        $this->db->where('customer_print','1');
        $this->db->update(' customer_print_last_invoice',$data3);
        $avg = round($this->input->post('amount')/$this->input->post('qty'),2);

        $data1 = array(
       'product' => $this->input->post('product'),
       'guest_invoice_no' => $last_invoice,
       'price' => $this->input->post('price'),
       'quantity' => $this->input->post('qty'),
       'total' => $this->input->post('total'),
       'average' =>$avg,
       'vehicle' => $this->input->post('reg_no'),
       'customer' => $this->input->post('customer'),
       'notes' => $this->input->post('notes'),
       'balance' => $this->input->post('balance'),
       'discount' => $this->input->post('discount'),
       'amount' => $this->input->post('amount'),
       'date' => date('Y-m-d'),
       'cur_date' => date('h:i:s a', time())
        );
        $this->common_model->insert('guest_print',$data1);
        $id=$this->db->insert_id();

        $data = array(
       'user_type' => "guest",
       'Amount' => $this->input->post('price'),
       'discount' => $this->input->post('discount'),
       'Type' => "Sale",
       'CLDate' =>date('Y-m-d'),
       'cash_in_time' => date('h:i:s a', time())
        );
        $this->common_model->insert('customer_ledger',$data);

        $data2 = array(
        'user_type' => "guest",
        'Type' => "Credit",
        'TransName' => "Sale",
        'Amount' =>$this->input->post('amount'),
        'discount' => $this->input->post('discount'),
        'Transdate' => date('Y-m-d')
        );
        $this->common_model->insert('ledger',$data2);
   //$this->common_model->insert('bill',$data);

        $data3 = array(
     'product' => $this->input->post('product'),
     'invoice_no' => $last_invoice,
     'price' => $this->input->post('price'),
     'quantity' => $this->input->post('qty'),
     'total' => $this->input->post('total'),
     'vehicle' => $this->input->post('reg_no'),
     'customer' => 0,
     'user_type' => 'Sale',
     'date' => date('Y-m-d'),
     'cur_date' => date('h:i:s a', time())
      );
      $this->common_model->insert('sale',$data3);

   redirect(base_url().'index.php/account/guest_bill_print/'.$id,'refresh');
      }

    }
  }
  public function guest_bill_print($param1=""){
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
      if($param1==""){
        $this->load->view('admin/account/guest_bill_print');
      }
      else{

        $data['id'] = $param1;
        $this->load->view('admin/account/guest_bill_print',$data);
      }
    }
  }

  public function raw_material($param1="",$param2=""){
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
      if($param1==""){
        $this->load->view('admin/account/raw_material_bill');
      }
      elseif($param1=="do_add"){
       date_default_timezone_set('Asia/Kolkata');
        $reg_no = $this->input->post('reg_no');

        $last_invoice = $this->db->get_where('raw_material_last_invoice',array('raw_last_invoice'=>'1'))->row()->raw_material_last_no;

        /*if($last_invoice == "1001"){
          $last_invoice="1";
        }

        $data3['raw_material_last_no'] = $last_invoice+1;*/
        if($last_invoice == "INV001000"){
          $last_invoice="INV000";
        }

        $invid=str_split($last_invoice,5);
  			$inv=(int)$invid[1]+1;
  			$last_invoice="INV"."00".$inv;
        $data3['raw_material_last_no'] = $last_invoice;

        $this->db->where('raw_last_invoice','1');
        $this->db->update('raw_material_last_invoice',$data3);

        $data1 = array(
       'product' => $this->input->post('product'),
       'raw_invoice_no' => $last_invoice,
       'price' => $this->input->post('price'),
       'quantity' => $this->input->post('qty'),
       'total' => $this->input->post('total'),
       'vehicle' => $this->input->post('reg_no'),
       'customer' => $this->input->post('customer'),
       'notes' => $this->input->post('notes'),
       'balance' => $this->input->post('balance'),
       'date' => date('Y-m-d'),
       'cur_date' => date('h:i:s a', time())
        );
        $this->common_model->insert('raw_material_print',$data1);
        $id=$this->db->insert_id();

        $data = array(
       'CustomerID' => $this->input->post('customer'),
       'user_type' => "vendor",
       'Amount' => $this->input->post('price'),
       'Type' => "Reciept",
       'CLDate' =>date('Y-m-d'),
       'cash_in_time' => date('h:i:s a', time())
        );
        $this->common_model->insert('customer_ledger',$data);

        $data2 = array(
        'user_type' => "vendor",
        'Type' => "Debit",
        'TransName' => "Reciept",
        'Amount' =>$this->input->post('amount'),
        'Transdate' => date('Y-m-d')
        );
        $this->common_model->insert('ledger',$data2);
   //$this->common_model->insert('bill',$data);

        $data3 = array(
        'product' => $this->input->post('product'),
        'invoice_no' => $last_invoice,
        'price' => $this->input->post('price'),
        'quantity' => $this->input->post('qty'),
        'total' => $this->input->post('total'),
        'vehicle' => $this->input->post('reg_no'),
        'customer' => $this->input->post('customer'),
        'user_type' => 'Purchase',
        'date' => date('Y-m-d'),
        'cur_date' => date('h:i:s a', time())
         );
         $this->common_model->insert('sale',$data3);

   redirect(base_url().'index.php/account/print_raw_material_bill/'.$id,'refresh');

      }
    }
  }


public function print_raw_material_bill($param1="",$param2=""){
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
      if($param1==""){
        $this->load->view('admin/account/print_raw_material_bill');
      }
      else{

        $data['id'] = $param1;
        $this->load->view('admin/account/print_raw_material_bill',$data);
      }
    }
  }
  

  public function get_vendor_product($prod,$id)
  {


    $price = $this->db->get_where('vendor_products',array('name'=>$prod,'vendor_id'=>$id))->row()->price;
    if($price == ""){
      echo "0";
    }
    else{
      echo $price;
    }


  }


  


  public function show_guest_product_price($prod)
  {
    $price = $this->db->get_where('product',array('id'=>$prod))->row()->price;
    echo $price;
  }

  public function cash_in($param1="",$param2=""){
    if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
      if($param1==""){
      $this->load->view('admin/account/cash_in');
      }
      elseif($param1=="do_add"){
          date_default_timezone_set('Asia/Kolkata');
        $last_invoice = $this->db->get_where('cash_in_last_invoice',array('cash_in_id'=>'1'))->row()->cash_in_invoice_no;

        if($last_invoice == "1001"){
          $last_invoice="1";
        }
        $data3['cash_in_invoice_no'] = $last_invoice+1;
        $this->db->where('cash_in_id','1');
        $this->db->update('cash_in_last_invoice',$data3);

        $data['cust_name']=$this->input->post('customer');
        $data['cash_in_invoice']=$last_invoice;
        $data['balance']=$this->input->post('balance');
        $data['amount']=$this->input->post('amount');
        $data['notes']=$this->input->post('notes');
        $data['insert_date']=date('Y-m-d');
        $data['date']=date('Y-m-d');
        $data['cur_date']=date('h:i:s a', time());
        $this->common_model->insert('cash_in',$data);
        $id=$this->db->insert_id();

        $data1['CustomerID']=$this->input->post('customer');
        $data1['Amount']=$this->input->post('amount');
        $data1['Type']="Sale";
        $data1['CLDate']=date('Y-m-d');
        $data1['cash_in_time']=date('h:i:s a', time());
        $this->common_model->insert('customer_ledger',$data1);

        $data2['CustomerID']=$this->input->post('customer');
        $data2['Type']="Credit";
        $data2['TransName']="Sale";
        $data2['Amount']=$this->input->post('amount');
        $data2['Transdate']=date('Y-m-d');


        $data2['RecieptVoucherID']=$last_invoice;
        $this->common_model->insert('ledger',$data2);



        redirect(base_url().'index.php/account/cash_in_print/'.$id,'refresh');


      }
    }
  }

  

  public function cash_in_print($param1="",$param2=""){
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
      if($param1==""){
        $this->load->view('admin/account/cash_in_print');
      }
      else{

        $data['id'] = $param1;
        $this->load->view('admin/account/cash_in_print',$data);
      }
    }
  }
  
  public function cash_out($param1="",$param2=""){
    if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
      if($param1==""){
      $this->load->view('admin/account/cash_out');
      }
      elseif($param1=="customer_do_add"){
        date_default_timezone_set('Asia/Kolkata');
        $last_invoice = $this->db->get_where('cash_out_last_invoice',array('cash_out_id'=>'1'))->row()->cash_out_invoice_no;

        if($last_invoice == "1001"){
          $last_invoice="1";
        }
        $data3['cash_out_invoice_no'] = $last_invoice+1;
        $this->db->where('cash_out_id','1');
        $this->db->update('cash_out_last_invoice',$data3);


        $data['customer_name']=$this->input->post('customer1');
        $data['cash_out_invoice']=$last_invoice;
        $data['balance']=$this->input->post('balance1');
        $data['amount']=$this->input->post('amount1');
        $data['notes']=$this->input->post('notes1');
        $data['inserted_date']=date('Y-m-d');
        $data['date']=date('Y-m-d');
        $data['cur_date']=date('h:i:s a', time());
        $this->common_model->insert('cash_out',$data);
        $id=$this->db->insert_id();

        $data1['CustomerID']=$this->input->post('customer1');
        $data1['Amount']=$this->input->post('amount1');
        $data1['Type']="Reciept";
        $data1['CLDate']=date('Y-m-d');
        $data1['cash_in_time']=time();
        $this->common_model->insert('customer_ledger',$data1);

        $data2['CustomerID']=$this->input->post('customer1');
        $data2['Type']="Debit";
        $data2['TransName']="Reciept";
        $data2['Amount']=$this->input->post('amount');
        $data2['Transdate']=date('Y-m-d');
        $this->common_model->insert('ledger',$data2);

        redirect(base_url().'index.php/account/cash_out_print/'.$id,'refresh');

      }
      elseif($param1=="vendor_do_add"){
        date_default_timezone_set('Asia/Kolkata');
        $last_invoice = $this->db->get_where('cash_out_last_invoice',array('cash_out_id'=>'1'))->row()->cash_out_invoice_no;

        if($last_invoice == "1001"){
          $last_invoice="1";
        }
        $data3['cash_out_invoice_no'] = $last_invoice+1;
        $this->db->where('cash_out_id','1');
        $this->db->update('cash_out_last_invoice',$data3);

        $data['vendor_name']=$this->input->post('customer');
          $data['cash_out_invoice']=$last_invoice;

        $data['balance']=$this->input->post('balance');
        $data['amount']=$this->input->post('amount');
        $data['notes']=$this->input->post('notes');
        $data['inserted_date']=date('Y-m-d');
        $data['date']=date('Y-m-d');
        $data['cur_date']=date('h:i:s a', time());
        $this->common_model->insert('cash_out',$data);
        $id=$this->db->insert_id();

        $data1['CustomerID']=$this->input->post('customer');
        $data1['Amount']=$this->input->post('amount');
        $data1['Type']="Reciept";
        $data1['CLDate']=date('Y-m-d');
        $data1['cash_in_time']=time();
        $this->common_model->insert('customer_ledger',$data1);

        $data2['CustomerID']=$this->input->post('CustomerID');
        $data2['Type']="Debit";
        $data2['TransName']="Reciept";
        $data2['Amount']=$this->input->post('amount');
        $data2['Transdate']=date('Y-m-d');


        $data2['RecieptVoucherID']=$last_invoice;
        $this->common_model->insert('ledger',$data2);



        redirect(base_url().'index.php/account/cash_out_print/'.$id,'refresh');
      }
    }
  }


public function cash_out_print($param1="",$param2=""){
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/account/index','refresh');
    }
    else{
      if($param1==""){
        $this->load->view('admin/account/cash_out_print');
      }
      else{
  
        $data['id'] = $param1;
        $this->load->view('admin/account/cash_out_print',$data);
      }
    }
  }

  public function show_product_price($product,$customer){
  $price =  $this->db->get_where('customer_products',array('prod_name'=>$product,'customer_id'=>$customer))->row()->price;

if($price == ""){
  echo 0;
}
  else{
    echo $price;
  }
  }


public function show_customer_balance($customer){
  $this->db->select_sum('total');
	$res=$this->db->get_where('customer_print',array("	customer"=>$customer));
	$data= $res->row();
  $amt =  $data->total;

  $this->db->select_sum('amount');
	$res=$this->db->get_where('cash_in',array("	cust_name"=>$customer));
	$data= $res->row();
  $amt1 =  $data->amount;

  $this->db->select_sum('amount');
	$res=$this->db->get_where('cash_out',array("customer_name"=>$customer));
	$data= $res->row();
  $amt2 =  $data->amount;
  
  $sum=($amt+$amt2)-$amt1;

   if($sum==0){
        echo "0";
    }
    else{
       echo $sum; 
    }
  
}


public function getPrices_vendor_products($customer)
{
  $this->db->select_sum('total');
	$res=$this->db->get_where('raw_material_print',array("customer"=>$customer));
	$data= $res->row();
  $amt =  $data->total;

  $this->db->select_sum('amount');
	$res=$this->db->get_where('cash_out',array("vendor_name"=>$customer));
	$data= $res->row();
  $amt1 =  $data->amount;

    if(($amt-$amt1)==0){
        echo "0";
    }
    else{
       echo $amt-$amt1; 
    }
}

public function view_body_details($id){
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/account/index','refresh');
  }
  else{
    $id=str_replace("%20"," ",$id);
    $tablehtml="<table class='table table-striped'><tr><th>Length</th><th>Width</th><th>Height</th><th>Length(extra)</th><th>Width(extra)</th><th>Height(extra)</th></tr>";
    $r="select * from vehicle where reg_number='$id'";
    $res1=$this->db->query($r);
    $res= $res1->result_array();
    foreach ($res as $row) {
      $tablehtml =$tablehtml."<tr><td>". $row['cl'] ."</td><td>". $row['cw'] ."</td><td>". $row['ch'] ."</td><td>". $row['el'] ."</td><td>". $row['ew'] ."</td><td>". $row['eh'] ."</td></tr>";
    }
    $tablehtml =$tablehtml."</table>";
    echo $tablehtml;
  }
}

 public function add_vehicle_guest($param1="",$param2=""){
   if($this->session->userdata('user_type') == ""){
     redirect(base_url() . 'index.php/account/index','refresh');
   }
   else{
     if($param1==""){
       $this->load->view('admin/account/add_vehicle_guest');
     }
     elseif($param1=="do_add"){
       $name = $this->input->post('name');
       $model = $this->input->post('model');
       $reg1 = $this->input->post('reg');
       $reg = strtoupper($reg1);
       $cl = $this->input->post('cl');
       $cw = $this->input->post('cw');
       $ch = $this->input->post('ch');
       if($this->input->post('el') != ""){
              $data = array(
             'name' => $name,
             'model' => $model,
             'reg_number' => $reg,
             'cl' => $cl,
             'cw' => $cw,
             'ch' => $ch,
             'el' => $this->input->post('el'),
             'ew' => $this->input->post('ew'),
             'eh' => $this->input->post('eh'),
             'extra_body_actual' => $this->input->post('tle'),
             'extra_body_manual' => $this->input->post('mle'),
             'company_body_actual' => $this->input->post('tl1'),
             'company_body_manual' => $this->input->post('ml1'),
             'insert_date' => date('Y-m-d')
         );
       }
       else{
               $data = array(
              'name' => $name,
              'model' => $model,
              'reg_number' => $reg,
              'cl' => $cl,
              'cw' => $cw,
              'ch' => $ch,
              'company_body_actual' => $this->input->post('tl1'),
              'company_body_manual' => $this->input->post('ml1'),
              'insert_date' => date('Y-m-d')
          );
       }

       $this->common_model->insert('vehicle',$data);
       redirect(base_url().'index.php/account/guest','refresh');
     }

 }

 }
 
 

}
