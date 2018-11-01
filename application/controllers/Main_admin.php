

 <?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Main_admin extends CI_Controller {


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
          $this->load->view('admin/admin/dashboard');
      }

/************************** user *******************************/
	public function user($param1='',$param2='')
	{
		if($this->session->userdata('user_type') == ""){
			redirect(base_url() . 'index.php/main_admin/index','refresh');
		}
		else{
		if($param1 == ''){
			$page_data['users'] = $this->crud_model->user_view();
			$this->load->view('admin/admin/user',$page_data);
		}
		elseif($param1 == "delete"){
			$this->crud_model->user_delete($param2);
      redirect(base_url() . 'index.php/main_admin/user','refresh');

		}
		elseif($param1 == "add"){
			$this->load->view('admin/admin/user_add');
		}
		elseif($param1 == "do_add"){
			$data = array(
					'name' => $this->input->post('name'),
          'phone' => $this->input->post('phone'),
          'address' => $this->input->post('address'),
					'msand' => $this->input->post('msand'),
					'psand' => $this->input->post('psand'),
					'waste' => $this->input->post('waste'),
					'insert_date' => date('Y-m-d'),
          'last_login' => time(),
			);
			//$this->crud_model->user_add($data);
      $this->db->insert('customer', $data);
      $id = $this->db->insert_id();


			$page_data['users'] = $this->crud_model->user_view();
			redirect(base_url() . 'index.php/main_admin/user','refresh');

		}
		elseif ($param1 == 'edit') {
      $this->db->where('id', $param2);
			$page_data['users'] = $this->db->get_where('customer', array('id =' => $param2))->result_array();
      $this->load->view('admin/admin/user_edit',$page_data);
		}

		elseif($param1 == "update"){
      $data = array(
          'name' => $this->input->post('name'),
          'phone' => $this->input->post('phone'),
          'address' => $this->input->post('address'),
          'msand' => $this->input->post('msand'),
          'psand' => $this->input->post('psand'),
          'waste' => $this->input->post('waste'),
          'last_login' => time(),
      );
			$this->crud_model->user_update($data,$param2);
      $page_data['users'] = $this->crud_model->user_view();
			redirect(base_url() . 'index.php/main_admin/user','refresh');
		}

		}
	}

	public function logout()
	{
		$this->crud_model->logout();
		$this->load->view('admin/index');
	}



	/**************************  manage admin profile *******************************/

	public function manage_profile($param1='',$param2='')
	{
		if($this->session->userdata('user_type') == ""){
			redirect(base_url() . 'index.php/main_admin/index','refresh');
		}
		else{
		if($param1 == ''){
			$page_data['profile'] = $this->crud_model->admin_view();
			$this->load->view('admin/admin/profile',$page_data);
		}
		if($param1 == 'update'){
      $i= $this->session->userdata('login_id');
			$oldp=$this->input->post('oldp');
			$data['password']=sha1($this->input->post('newp'));
			$confirm=$this->input->post('confirm');
			//$pass=$this->db->get_where('login',array('login_id'=>$param2))->row()->password;
			//echo $param2;echo $oldp;
			$pass=$this->db->get_where('login',array('login_id'=>$i))->row()->password;
			if(sha1($oldp)==$pass){
        $this->session->set_userdata('change','yes');
				$this->db->where('login_id',$i);
				$this->db->update('login',$data);
				redirect(base_url().'index.php/main_admin/manage_profile','refresh');
			}
			else{
				$page_data['profile'] = $this->crud_model->admin_view();
				$page_data['msg'] = "The old password you entered is incorrect";
				$this->load->view('admin/admin/profile',$page_data);
			}
		}

		}
	}

/***************************product**************************************/
  public function product($param1='',$param2='')
  {
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/main_admin/index','refresh');
    }
    else{
    if($param1 == ''){
      $page_data['product'] = $this->crud_model->product_view();
      $this->load->view('admin/admin/product',$page_data);
    }
    elseif($param1 == 'add'){
      $name = $this->input->post('name');
      $price = $this->input->post('price');
      $data = array(
					'name' => $name,
					'price' => $price,
					'insert_date' => date('Y-m-d'),
			);
			$this->common_model->insert('product',$data);
      redirect(base_url().'index.php/main_admin/product','refresh');
    }

    elseif($param1 == 'update'){
      $name = $this->input->post('name');
      $price = $this->input->post('price');
      $data = array(
					'name' => $name,
					'price' => $price,
			);
			$this->common_model->update('id',$param2,'product',$data);
      redirect(base_url().'index.php/main_admin/product','refresh');
    }
    elseif($param1=='edit'){
      $page_data['product'] = $this->crud_model->product_view_edit($param2);
      $this->load->view('admin/admin/product_edit',$page_data);
    }
    elseif($param1=='delete'){
      $this->db->where('id',$param2);
      $this->db->delete('product');
      //$this->common_model->delete('product',$c);
      redirect(base_url().'index.php/main_admin/product','refresh');
    }

  }
}
/****************************************Customers********************************************/

/*****************************************vehicles******************************************/
public function vehicle($param1='',$param2='')
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/main_admin/index','refresh');
  }
  else{
  if($param1 == ''){
    $page_data['vehicle'] = $this->crud_model->vehicle_view();
    $this->load->view('admin/admin/vehicle',$page_data);
  }
  elseif($param1=='add'){
    $this->load->view('admin/admin/vehicle_add');
  }
  elseif($param1=='do_add'){

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
    redirect(base_url().'index.php/main_admin/vehicle','refresh');

}
      elseif($param1=='edit'){
        $page_data['vehicle'] = $this->crud_model->vehicle_view_edit($param2);
        $this->load->view('admin/admin/vehicle_edit',$page_data);
      }

      elseif($param1=='update'){

        $name = $this->input->post('name');
        $model = $this->input->post('model');
        $reg = $this->input->post('reg');
        $cl = $this->input->post('cl');
        $cw = $this->input->post('cw');
        $ch = $this->input->post('ch');

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


        $this->common_model->update('vehicle_id',$param2,'vehicle',$data);
        redirect(base_url().'index.php/main_admin/vehicle','refresh');

    }
    elseif($param1=='delete'){
      $this->db->where('vehicle_id',$param2);
      $this->db->delete('vehicle');
      //$this->common_model->delete('product',$c);
      redirect(base_url().'index.php/main_admin/vehicle','refresh');
    }

}



}


/***************************raw_materials**************************************/
  public function raw_materials($param1='',$param2='')
  {
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/main_admin/index','refresh');
    }
    else{
      if($param1 == ''){
        $page_data['material'] = $this->crud_model->material_view();
        $this->load->view('admin/admin/raw_material',$page_data);
      }
      elseif($param1 == 'add'){
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $notes = $this->input->post('notes');
        $data = array(
  					'raw_material_name' => $name,
  					'price' => $price,
                    'notes' => $notes,
  					'insert_date' => date('Y-m-d'),
  			);
  			$this->common_model->insert('raw_material',$data);
        redirect(base_url().'index.php/main_admin/raw_materials','refresh');
      }
      elseif($param1=='edit'){
        $page_data['product'] = $this->crud_model->material_view_edit($param2);
        $this->load->view('admin/admin/raw_material_edit',$page_data);
      }
      elseif($param1 == 'update'){
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $notes = $this->input->post('notes');
        $data = array(
  					'raw_material_name' => $name,
  					'price' => $price,
            'notes' => $notes,
  			);
  			$this->common_model->update('raw_material_id',$param2,'raw_material',$data);
        redirect(base_url().'index.php/main_admin/raw_materials','refresh');
      }
      elseif($param1=='delete'){
        $this->db->where('raw_material_id',$param2);
        $this->db->delete('raw_material');
        //$this->common_model->delete('product',$c);
        redirect(base_url().'index.php/main_admin/raw_materials','refresh');
      }
    }
  }
  /**********************customers******************************/
  public function customer($param1='',$param2='')
  {
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/main_admin/index','refresh');
    }
    else{
      if($param1 == ''){
        $page_data['customer'] = $this->crud_model->customer_view();
        $this->load->view('admin/admin/customer',$page_data);
      }
      elseif($param1 == 'do_add'){
        $log = $this->input->post('logid');
        $data = array(
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('mobile'),

            'notes' => $this->input->post('notes'),
            'insert_date' => date('Y-m-d'),
            'last_login' => time(),
            'ob' => $this->input->post('ob')
        );
        $this->common_model->insert('customer',$data);
        $id=$this->db->insert_id();
        $d = date('Y-m-d');

        $sql="insert into customer_products(prod_name,price,customer_id,date) select 	customer_temp_products_name,price,'$id','$d' from customer_temp_products where login_id=$log";
  			$this->db->query($sql);
        //$this->db->insert('vendor_products',$data);

  			$this->db->truncate('customer_temp_products',array('login_id'=>$log));

          $data1['customer']=$id;
          $data1['cust_status']="1";
          $data1['total']=$this->input->post('ob');
          $this->common_model->insert('customer_print',$data1);

        
             $data7 = array(
            'name' => $this->input->post('name'),
            'balance' => $this->input->post('ob'),
            'cust_id' => $id
            
        );
        $this->common_model->insert('creditor',$data7);
        
        redirect(base_url().'index.php/main_admin/customer/manage_customer','refresh');
      }
      elseif($param1=='manage_customer'){
        $page_data['customer'] = $this->crud_model->customer_view($param2);
        $this->load->view('admin/admin/manage_customer',$page_data);
      }
      
      elseif($param1=='edit'){
        $page_data['customer'] = $this->db->get_where('customer_products',array('customer_id'=>$param2))->result_array();
      $this->load->view('admin/admin/edit_customer',$page_data);
      }
      elseif($param1=='edit_customer'){
      $page_data['customer'] = $this->db->get_where('customer',array('id'=>$param2))->result_array();
      $this->load->view('admin/admin/edit_customer_details',$page_data);
    }
    
     elseif($param1=='update'){
      $log = $this->input->post('logid');
      $data = array(
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('mobile'),

            'notes' => $this->input->post('notes'),
            'insert_date' => date('Y-m-d'),
            'ob' => $this->input->post('ob')
        );
      $this->db->where('id',$param2);
      $this->db->update('customer',$data);
      
      
      
      $data1['total']=$this->input->post('ob');
      $val=NULL;
      $this->db->where('customer',$param2);
      $this->db->where('credit_invoice_no',$val);
      $this->db->update('customer_print',$data1);
      
      $d = date('Y-m-d');

       $sql="insert into customer_products(prod_name,price,customer_id,date) select 	customer_temp_products_name,price,'$param2','$d' from customer_temp_products where login_id=$log";
  			$this->db->query($sql);
        //$this->db->insert('vendor_products',$data);

  			$this->db->truncate('customer_temp_products',array('login_id'=>$log));

        
	  $data7 = array(
            'name' => $this->input->post('name'),
            'balance' => $this->input->post('ob'),
            'cust_id' => $param2
            
        );
        $this->db->where('id',$param2);
        $this->db->update('creditor',$data7);
        //$this->common_model->insert('creditor',$data7);
			
			
      redirect(base_url().'index.php/main_admin/customer/manage_customer','refresh');
    }
    
    }
  }
  
  public function customer_update($name,$price,$prod_id){
    $name = str_replace("%20"," ",$name);
    $price = str_replace("%20"," ",$price);
    
    $data['prod_name']=$name;
    $data['price']=$price;
    $this->db->where('prod_id',$prod_id);
    $this->db->update('customer_products',$data);
}
/***************************vendor**************************************/
public function vendor($param1='',$param2='')
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/main_admin/index','refresh');
  }
  else{
    if($param1 == ''){
      $page_data['vendor'] = $this->crud_model->vendor_view();
      $this->load->view('admin/admin/vendor',$page_data);
    }

    elseif($param1 == 'do_add'){
      $log = $this->input->post('logid');
      $data = array(
          'vendor_add_date' => $this->input->post('date'),
          'name' => $this->input->post('name'),
          'mobile' => $this->input->post('mobile'),
          'totalamount' => $this->input->post('TxtTotalamount'),
          'notes' => $this->input->post('notes'),
          'date' => date('Y-m-d'),
          'ob' => $this->input->post('amount')
      );
      $this->common_model->insert('vendor',$data);
      $id=$this->db->insert_id();
      $d = date('Y-m-d');

      $sql="insert into vendor_products(name,price,quantity,total,vendor_id,date) select name,price,quantity,total,'$id','$d' from vendor_temp_products where login_id=$log";
			$this->db->query($sql);
      //$this->db->insert('vendor_products',$data);

			$this->db->truncate('vendor_temp_products',array('login_id'=>$log));
    
          $data1['customer']=$id;
          $data1['raw_status']="1";
          $data1['total']=$this->input->post('amount');
          $this->common_model->insert('raw_material_print',$data1);
          
           $data7 = array(
            'name' => $this->input->post('name'),
            'balance' => $this->input->post('amount'),
            'vendor_id' => $id
            
        );
        $this->common_model->insert('debitor',$data7);
        
      redirect(base_url().'index.php/main_admin/vendor/manage_vendor','refresh');
    }

    elseif($param1=='manage_vendor'){
      $page_data['vendor'] = $this->crud_model->vendor_view($param2);
      $this->load->view('admin/admin/manage_vendor',$page_data);
    }
    
    
    elseif($param1=='delete'){
      $this->db->where('vendor_id',$param2);
      $this->db->delete('vendor');
      $this->db->where('vendor_id',$param2);
      $this->db->delete('vendor_products');
      redirect(base_url().'index.php/main_admin/vendor/manage_vendor','refresh');
    }
    
    elseif($param1=='edit'){
      $page_data['vendor'] = $this->db->get_where('vendor_products',array('vendor_id'=>$param2))->result_array();
      $this->load->view('admin/admin/edit_vendor',$page_data);
    }
    
    elseif($param1=='edit_vendor'){
      $page_data['vendor'] = $this->db->get_where('vendor',array('vendor_id'=>$param2))->result_array();
      $this->load->view('admin/admin/edit_vendor_details',$page_data);
    }
    
    elseif($param1=='update'){
      $log = $this->input->post('logid');
      $data = array(
          'vendor_add_date' => $this->input->post('date'),
          'name' => $this->input->post('name'),
          'mobile' => $this->input->post('mobile'),
          'totalamount' => $this->input->post('TxtTotalamount'),
          'notes' => $this->input->post('notes'),
          'date' => date('Y-m-d'),
          'ob' => $this->input->post('amount')
      );
      $this->db->where('vendor_id',$param2);
      $this->db->update('vendor',$data);
      
      
      
      $data1['total']=$this->input->post('amount');
      $val=NULL;
      $this->db->where('customer',$param2);
      $this->db->where('raw_invoice_no',$val);
      $this->db->update('raw_material_print',$data1);
      
      $d = date('Y-m-d');

      $sql="insert into vendor_products(name,price,quantity,total,vendor_id,date) select name,price,quantity,total,'$param2','$d' from vendor_temp_products where login_id=$log";
			$this->db->query($sql);
      //$this->db->insert('vendor_products',$data);

	 $this->db->truncate('vendor_temp_products',array('login_id'=>$log));
			
			
			$data7 = array(
            'name' => $this->input->post('name'),
            'balance' => $this->input->post('amount'),
            'debitor_id' => $param2
            
        );
        $this->db->where('debitor_id',$param2);
        $this->db->update('debitor',$data7);
        //$this->common_model->insert('debitor',$data7);
        
        
      redirect(base_url().'index.php/main_admin/vendor/manage_vendor','refresh');
    }
    


}
}


public function vendor_update($name,$price,$prod_id){
    $name = str_replace("%20"," ",$name);
    $price = str_replace("%20"," ",$price);
    
    $data['name']=$name;
    $data['price']=$price;
    $this->db->where('vendor_products_id',$prod_id);
    $this->db->update('vendor_products',$data);
}
/***************************expense category**************************************/
public function expense_category($param1='',$param2='')
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/main_admin/index','refresh');
  }
  else{
    if($param1 == ''){
      $page_data['exp_cate'] = $this->crud_model->cate_view();
      $this->load->view('admin/admin/expense_category',$page_data);
    }
    elseif($param1 == 'add'){
      $name = $this->input->post('name');
      $notes = $this->input->post('notes');
      $data = array(
          'name' => $name,
          'notes' => $notes,
          'date' => date('Y-m-d'),
      );
      $this->common_model->insert('expense_category',$data);
      
      $data1 = array(
          'exp_category_id' => $id,
          'name' => $name,
          'amount' => 0,
          'date' => date('Y-m-d'),
      );
      $this->common_model->insert('expense_category_amount',$data1);
      
      redirect(base_url().'index.php/main_admin/expense_category','refresh');
    }
    elseif($param1=='edit'){
      $page_data['exp_cate'] = $this->crud_model->cate_view_edit($param2);
      $this->load->view('admin/admin/expense_category_edit',$page_data);
    }
    elseif($param1 == 'update'){
      $name = $this->input->post('name');
      $notes = $this->input->post('notes');
      $data = array(
          'name' => $name,
          'notes' => $notes,
      );
      $this->common_model->update('exp_catid',$param2,'expense_category',$data);
      redirect(base_url().'index.php/main_admin/expense_category','refresh');
    }
    elseif($param1=='delete'){
      $this->db->where('exp_catid',$param2);
      $this->db->delete('expense_category');
      redirect(base_url().'index.php/main_admin/expense_category','refresh');
    }


}
}

/***************************expense**************************************/
public function expense($param1='',$param2='')
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/main_admin/index','refresh');
  }
  else{
    if($param1 == ''){
      $page_data['expense'] = $this->crud_model->expense_view();
      $this->load->view('admin/admin/expense',$page_data);
    }
    elseif($param1 == 'add'){
      $data = array(
          'expense_name' => $this->input->post('name'),
          'amount' => $this->input->post('amount'),
          'description' => $this->input->post('notes'),
          'category' => $this->input->post('category'),
          'date' => date('Y-m-d'),
      );
      $this->common_model->insert('expense',$data);
      $id=$this->db->insert_id();
      $data1['expense_id']=$id;
      $data1['amount']=$this->input->post('amount');
      $data1['cash_out_status']=1;
      $data1['date']=date('Y-m-d');
      $this->common_model->insert('cash_out',$data1);
      
      
        $amount = $this->input->post('amount');
        $cate = $this->input->post('category');
        $old_amt = $this->db->get_where('expense_category_amount',array('exp_category_id'=>$cate))->row()->amount;
        $new_amt = $amount+$old_amt;
        $exp['amount']=$new_amt;
        $this->db->where('exp_category_id',$cate);
        $this->db->update('expense_category_amount',$exp);
        
        //$data2['CustomerID']=$this->input->post('customer');
          $data2['Type']="Debit";
          $data2['TransName']="Expense";
          $data2['Amount']=$this->input->post('amount');
          //$data2['balance']=$this->input->post('balance');
          $data2['Transdate']=date('Y-m-d');
          $data2['ExpenseID']=$id;
          $data2['cur_time']=date('h:i:s a', time());
          $data2['trans_type']="Cash Paid";
          $data2['invoice_no']="Expense";
          $data2['cancel_status']="1";
          $data2['show_status']="1";
          $this->common_model->insert('ledger',$data2);
          
          
           $d=date('Y-m-d');
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
          
        }
        
        
          
      redirect(base_url().'index.php/main_admin/expense','refresh');
    }
    elseif($param1=='edit'){
      $page_data['expense'] = $this->crud_model->expense_view_edit($param2);
      $this->load->view('admin/admin/expense_edit',$page_data);
    }
    elseif($param1 == 'update'){
      $data = array(
          'expense_name' => $this->input->post('name'),
          'amount' => $this->input->post('amount'),
          'description' => $this->input->post('notes'),
          'category' => $this->input->post('category'),
          'date' => $this->input->post('date'),
      );
      $this->common_model->update('expense_id',$param2,'expense',$data);
      $data1 = array(
          'amount' => $this->input->post('amount'),
          
      );
      $this->db->where('expense_id',$param2);
      $this->db->update('cash_out',$data1);
      
      $data2 = array(
          'Amount' => $this->input->post('amount'),
      );
      $this->db->where('ExpenseID',$param2);
      $this->db->update('ledger',$data2);   
          
      redirect(base_url().'index.php/main_admin/expense','refresh');
    }
    elseif($param1=='delete'){
      $this->db->where('expense_id',$param2);
      $this->db->delete('expense');
      redirect(base_url().'index.php/main_admin/expense','refresh');
    }
    
    elseif($param1=='status_cancel_expense'){
      
      
      $cate = $this->db->get_where('expense',array('expense_id'=>$param2))->row()->category;
      $old_amt = $this->db->get_where('expense',array('expense_id'=>$param2))->row()->amount;
      $amt = $this->db->get_where('expense_category_amount',array('exp_category_id'=>$cate))->row()->amount;
      
      $new_amt=$amt-$old_amt;
      $exp['amount']=$new_amt;
      $this->db->where('exp_category_id',$cate);
      $this->db->update('expense_category_amount',$exp);
      
      $this->db->where('expense_id',$param2);
      $this->db->delete('expense');
      
      $this->db->where('expense_id',$param2);
      $this->db->delete('cash_out');
      
      $this->db->where('ExpenseID',$param2);
      $this->db->delete('ledger');
      redirect(base_url().'index.php/main_admin/expense','refresh');
    }
    elseif($param1=='display'){
        $this->load->view('admin/admin/expense_add');
    }

  }
}


//-------------------------------------------------------
		public function addtemppurchase($name,$price,$qty,$tot,$logid)
{

  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/main_admin/index','refresh');
  }
  else{
    $price = str_replace("%20"," ",$price);
    $total=$price*$qty;
		$total=round($total,2);

    $data=array("name"=>$name,"price"=>$price,"quantity"=>$qty,"total"=>$total,"login_id"=>$logid);
    $this->db->insert('vendor_temp_products',$data);

    $log['loginid']=$logid;

		$response=$this->load->view('admin/admin/vendor_purchase',$log);
		echo $response;
		echo "||";
  }

}

public function add_price($a){
  $res=$this->db->get_where('raw_material',array('raw_material_id'=>$a))->row()->price;
  //echo "$a";
  echo $res;
}

//--------------------Delete Temp Item Open------------------------------
public function deletetempreport($delid,$logid)
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/main_admin/index','refresh');
  }
		//$this->sales->deletetempreport($delid,$logid);
else{
  $this->db->where('vendor_temp_products_id', $delid);
  $this->db->where('login_id', $logid);
  $this->db->delete('vendor_temp_products');

  $log['loginid']=$logid;

  $response=$this->load->view('admin/admin/vendor_purchase',$log);
  echo $response;
  echo "||";
  //echo $Totalsum;
  //echo "||";
}

		}

//-----------------------------------------------------

public function view_product_details($id)
  {
    if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/main_admin/index','refresh');
    }
    else{
        $id=str_replace("%20"," ",$id);
      $tablehtml="<table class='table table-striped'><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Amount</th></tr>";
      $r="select * from vendor_products where vendor_id='$id'";
      $res1=$this->db->query($r);
      $res= $res1->result_array();
      foreach ($res as $row) {

        $n = $this->db->get_where('raw_material',array('raw_material_id'=>$row['name']))->row()->raw_material_name;
        //$result = $key->product_details;
    //  }
    //  $data = json_decode($result,true);
      //foreach ($data as $row) {
        $tablehtml =$tablehtml."<tr><td>".$n."</td><td>". $row['price'] ."</td><td>".$row['quantity']."</td><td>".$row['total']."</td></tr>";
      }
      $tablehtml =$tablehtml."</table>";
      echo $tablehtml;
  }
}

//-------------------------------------------------------
		public function addcustomerproducts($name,$price,$logid)
{

  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/main_admin/index','refresh');
  }
  else{
    $price = str_replace("%20"," ",$price);
    $data=array("customer_temp_products_name"=>$name,"price"=>$price,"login_id"=>$logid,"customer_temp_products_date"=>date('Y-m-d'));
    $this->db->insert('customer_temp_products',$data);

    $log['loginid']=$logid;

		$response=$this->load->view('admin/admin/customer_purchase',$log);
		echo $response;
		echo "||";
  }

}
public function add_customer_price($a){
  $res=$this->db->get_where('product',array('id'=>$a))->row()->price;
  //echo "$a";
  echo $res;
}


//--------------------Delete Temp Item Open------------------------------
public function deletecustomer_products($delid,$logid)
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/main_admin/index','refresh');
  }
		//$this->sales->deletetempreport($delid,$logid);
else{
  $this->db->where('customer_temp_products_id', $delid);
  $this->db->where('login_id', $logid);
  $this->db->delete('customer_temp_products');

  $log['loginid']=$logid;

  $response=$this->load->view('admin/admin/customer_purchase',$log);
  echo $response;
  echo "||";
  //echo $Totalsum;
  //echo "||";
}

		}


    public function view_customer_product_details($id)
      {
        if($this->session->userdata('user_type') == ""){
          redirect(base_url() . 'index.php/main_admin/index','refresh');
        }
        else{
          $tablehtml="<table class='table table-striped'><tr><th>Product</th><th>Price</th></tr>";
          $r="select * from customer_products where customer_id='$id'";
          $res1=$this->db->query($r);
          $res= $res1->result_array();
          foreach ($res as $row) {

            $n = $this->db->get_where('product',array('id'=>$row['prod_name']))->row()->name;
            //$result = $key->product_details;
        //  }
        //  $data = json_decode($result,true);
          //foreach ($data as $row) {
            $tablehtml =$tablehtml."<tr><td>".$n."</td><td>". $row['price'] ."</td></tr>";
          }
          $tablehtml =$tablehtml."</table>";
          echo $tablehtml;
      }
    }
    
    /******************************************************************************/


    public function view_product_details1($id)
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
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/add_vehicle');
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
          redirect(base_url().'index.php/main_admin/bill','refresh');
        }

    }

    }
    /***********************************************************************/
     public function add_vehicle_guest($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/add_vehicle_guest');
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
          redirect(base_url().'index.php/main_admin/guest','refresh');
        }

    }

    }
    /***********************************************************************/
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

    public function show_product_price($product,$customer){
    $price =  $this->db->get_where('customer_products',array('prod_name'=>$product,'customer_id'=>$customer))->row()->price;

  if($price == ""){
    echo 0;
  }
    else{
      echo $price;
    }
    }
    /**********************************************************************/
    public function bill($param1='',$param2='')
    {
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1 == ''){

    			$this->load->view('admin/admin/create_bill');
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
          
          if($last_invoice == "RAW001000"){
            $last_invoice="RAW000";
            }

            $invid=str_split($last_invoice,5);
			$inv=(int)$invid[1]+1;
			$last_invoice="RAW"."00".$inv;
            $data3['customer_print_no'] = $last_invoice;

          $this->db->where('customer_print','1');
          $this->db->update(' customer_print_last_invoice',$data3);
          
          $avg = $this->input->post('total')/$this->input->post('qty');

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
         'cust_status' =>'1',
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
          'balance' => $this->input->post('balance'),
          'Type' => "Credit",
          'TransName' => "Credit",
          'Amount' =>$this->input->post('total'),
          'Transdate' => date('Y-m-d'),
          'cur_time' => date('h:i:s a', time()),
          'invoice_no' => $last_invoice,
          'trans_type' => "Credit",
          'SaleID' => $id,
          'cancel_status'=>1,
          'vehicle'=>$this->input->post('reg_no'),
          'item'=>$this->input->post('product'),
          'quantity'=>$this->input->post('qty'),
          'notes'=>$this->input->post('notes')
          );
          
          $this->common_model->insert('ledger',$data2);
          $ledge_id=$this->db->insert_id();
     //$this->common_model->insert('bill',$data);
     $avg = round($this->input->post('total')/$this->input->post('qty'),2);

            $data3 = array(
             'product' => $this->input->post('product'),
             'invoice_no' => $last_invoice,
             'price' => $this->input->post('price'),
             'quantity' => $this->input->post('qty'),
             'total' => $this->input->post('total'),
             'average' => $avg,
             'vehicle' => $this->input->post('reg_no'),
             'customer' => $this->input->post('customer'),
             'user_type' => 'Sale',
             'pay_type' => 'Credit',
             'date' => date('Y-m-d'),
             'notes' => $this->input->post('notes'),
             'cur_date' => date('h:i:s a', time()),
             'cur_time' => date('h:i:s a', time()),
             'ledger_id'=>$ledge_id,
             'cust_id'=>$id,
             'show_cancel_status'=>'1',
             'status'=>"1"
              );
              $this->common_model->insert('sale',$data3);
              
      $cust_id=$this->input->post('customer');
      $this->db->select_sum('total');
      $res=$this->db->get_where('customer_print',array("customer"=>$cust_id,'cust_status'=>'1'));
      $data7= $res->row();
      $amt =  $data7->total;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_in',array("cust_name"=>$cust_id,"cash_in_status"=>'1'));
      $data8= $res->row();
      $amt1 =  $data8->amount;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_out',array("customer_name"=>$cust_id,"cash_out_status"=>'1'));
      $data9= $res->row();
      $amt2 =  $data9->amount;


      $balance_amount =  ($amt+$amt2)-$amt1;
      $page_data['balance']=$balance_amount;
      
      $this->db->where('cust_id',$cust_id);
      $this->db->update('creditor',$page_data);
      
     
     
     redirect(base_url().'index.php/main_admin/print1/'.$id,'refresh');
        }

      }
    }

    public function print1($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/print');
        }
        else{

          $data['id'] = $param1;
          $this->load->view('admin/admin/print',$data);
        }
      }
    }

    public function show_customer_balance($customer){
      $this->db->select_sum('total');
    	$res=$this->db->get_where('customer_print',array("customer"=>$customer,'cust_status'=>'1'));
    	$data= $res->row();
      $amt =  $data->total;

      $this->db->select_sum('amount');
    	$res=$this->db->get_where('cash_in',array("	cust_name"=>$customer,"cash_in_status"=>'1'));
    	$data= $res->row();
      $amt1 =  $data->amount;

      $this->db->select_sum('amount');
    	$res=$this->db->get_where('cash_out',array("customer_name"=>$customer,"cash_out_status"=>'1'));
    	$data= $res->row();
      $amt2 =  $data->amount;
$sum=($amt+$amt2)-$amt1;

   if($sum==0){
        echo "0";
    }
    else{
       echo $sum; 
    }

      //echo ($amt+$amt2)-$amt1;
    }


    public function getPrices_vendor_products($customer)
    {
      $this->db->select_sum('total');
    	$res=$this->db->get_where('raw_material_print',array("customer"=>$customer,'raw_status'=>'1'));
    	$data= $res->row();
      $amt =  $data->total;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_out',array("vendor_name"=>$customer,"cash_out_status"=>'1'));
      $data= $res->row();
      $amt1 =  $data->amount;
      
      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_in',array("vendor_name"=>$customer,"cash_in_status"=>'1'));
      $data= $res->row();
      $amt2 =  $data->amount;

      //echo $amt-$amt1;
      if((($amt-$amt1)+$amt2)==0){
        echo "0";
    }
    else{
       echo ($amt-$amt1)+$amt2; 
    }
  

    }
    
    public function cash_in($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
        $this->load->view('admin/admin/cash_in');
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
          $data['cash_in_status']=1;
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
          $data2['balance']=$this->input->post('balance');
          $data2['Transdate']=date('Y-m-d');
          $data2['PaymentVoucherID']=$id;
          $data2['cur_time']=date('h:i:s a', time());
          $data2['trans_type']="Cash Recieved";
          $data2['invoice_no']=$last_invoice;
          $data2['notes']=$this->input->post('notes');
          $data2['cancel_status']="1";
          $data2['show_status']="1";
          $data2['in_stat']="1";
          $this->common_model->insert('ledger',$data2);


          $cust_id=$this->input->post('customer');
            $this->db->select_sum('total');
    	  $res=$this->db->get_where('customer_print',array("customer"=>$cust_id,'cust_status'=>'1'));
    	  $data7= $res->row();
         $amt =  $data7->total;

        $this->db->select_sum('amount');
    	$res=$this->db->get_where('cash_in',array("cust_name"=>$cust_id,"cash_in_status"=>'1'));
    	$data8= $res->row();
        $amt1 =  $data8->amount;

        $this->db->select_sum('amount');
    	$res=$this->db->get_where('cash_out',array("customer_name"=>$cust_id,"cash_out_status"=>'1'));
    	$data9= $res->row();
        $amt2 =  $data9->amount;


        $balance_amount =  ($amt+$amt2)-$amt1;
        $page_data['balance']=$balance_amount;
      
        $this->db->where('cust_id',$cust_id);
        $this->db->update('creditor',$page_data);
        
        
         $d=date('Y-m-d');
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
          
        }
        
        
        
          redirect(base_url().'index.php/main_admin/cash_in_print/'.$id,'refresh');


        }
        elseif($param1=="vendor_do_add"){
          date_default_timezone_set('Asia/Kolkata');
          $last_invoice = $this->db->get_where('cash_in_last_invoice',array('cash_in_id'=>'1'))->row()->cash_in_invoice_no;

          if($last_invoice == "1001"){
            $last_invoice="1";
          }
          $data3['cash_in_invoice_no'] = $last_invoice+1;
          $this->db->where('cash_in_id','1');
          $this->db->update('cash_in_last_invoice',$data3);

          $data['vendor_name']=$this->input->post('customer1');
          $data['cash_in_invoice']=$last_invoice;
          $data['balance']=$this->input->post('balance1');
          $data['amount']=$this->input->post('amount1');
          $data['notes']=$this->input->post('notes1');
          $data['insert_date']=date('Y-m-d');
          $data['date']=date('Y-m-d');
          $data['cur_date']=date('h:i:s a', time());
          $data['cash_in_status']=1;
          $this->common_model->insert('cash_in',$data);
          $id=$this->db->insert_id();

          $data1['CustomerID']=$this->input->post('customer1');
          $data1['Amount']=$this->input->post('amount1');
          $data1['Type']="Sale";
          $data1['CLDate']=date('Y-m-d');
          $data1['cash_in_time']=date('h:i:s a', time());
          $this->common_model->insert('customer_ledger',$data1);

          $data2['SupplierID']=$this->input->post('customer1');
          $data2['Type']="Credit";
          $data2['TransName']="Sale";
          $data2['Amount']=$this->input->post('amount1');
          $data2['balance']=$this->input->post('balance1');
          $data2['Transdate']=date('Y-m-d');
          $data2['PaymentVoucherID']=$id;
          $data2['cur_time']=date('h:i:s a', time());
          $data2['trans_type']="Cash Recieved";
          $data2['invoice_no']=$last_invoice;
          $data2['notes']=$this->input->post('notes1');
          $data2['cancel_status']="1";
          $data2['show_status']="1";
          $data2['in_stat']="1";
          $this->common_model->insert('ledger',$data2);
          
      $vend_id  = $this->input->post('customer1');   
      $this->db->select_sum('total');
      $res=$this->db->get_where('raw_material_print',array("customer"=>$vend_id,'raw_status'=>'1'));
      $data7= $res->row();
      $amt =  $data7->total;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_out',array("vendor_name"=>$vend_id,"cash_out_status"=>'1'));
      $data8= $res->row();
      $amt1 =  $data8->amount;
      
      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_in',array("vendor_name"=>$vend_id,"cash_in_status"=>'1'));
      $data9= $res->row();
      $amt2 =  $data9->amount;
      $balance_amount = ($amt-$amt1)+$amt2;
      $page_data['balance']=$balance_amount;
      
      $this->db->where('vendor_id',$vend_id);
      $this->db->update('debitor',$page_data);
      
      
       $d=date('Y-m-d');
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
          
        }
        
        
          redirect(base_url().'index.php/main_admin/cash_in_print/'.$id,'refresh');

        }
      }
    }

    public function cash_in_print($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/cash_in_print');
        }
        else{

          $data['id'] = $param1;
          $this->load->view('admin/admin/cash_in_print',$data);
        }
      }
    }
    
    public function cash_out($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
      redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
        $this->load->view('admin/admin/cash_out');
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
          $data['cash_out_status']=1;
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
          $data2['Amount']=$this->input->post('amount1');
          $data2['balance']=$this->input->post('balance1');
          $data2['Transdate']=date('Y-m-d');
          $data2['RecieptVoucherID']=$id;
          $data2['cur_time']=date('h:i:s a', time());
          $data2['trans_type']="Cash Paid";
          $data2['invoice_no']=$last_invoice;
          $data2['notes']=$this->input->post('notes1');
          $data2['cancel_status']="1";
          $data2['show_status']="1";
          $data2['out_stat']="1";
          $this->common_model->insert('ledger',$data2);
            
      $cust_id=$this->input->post('customer1');
      $this->db->select_sum('total');
      $res=$this->db->get_where('customer_print',array("customer"=>$cust_id,'cust_status'=>'1'));
      $data7= $res->row();
      $amt =  $data7->total;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_in',array("cust_name"=>$cust_id,"cash_in_status"=>'1'));
      $data8= $res->row();
      $amt1 =  $data8->amount;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_out',array("customer_name"=>$cust_id,"cash_out_status"=>'1'));
      $data9= $res->row();
      $amt2 =  $data9->amount;


      $balance_amount =  ($amt+$amt2)-$amt1;
      $page_data['balance']=$balance_amount;
      
      $this->db->where('cust_id',$cust_id);
      $this->db->update('creditor',$page_data);
      
       $d=date('Y-m-d');
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
          
        }
        
        
      
          redirect(base_url().'index.php/main_admin/cash_out_print/'.$id,'refresh');

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
          $data['cash_out_status']=1;
          $this->common_model->insert('cash_out',$data);
          $id=$this->db->insert_id();

          $data1['CustomerID']=$this->input->post('customer');
          $data1['Amount']=$this->input->post('amount');
          $data1['Type']="Reciept";
          $data1['CLDate']=date('Y-m-d');
          $data1['cash_in_time']=time();
          $this->common_model->insert('customer_ledger',$data1);

          $data2['SupplierID']=$this->input->post('customer');
          $data2['Type']="Debit";
          $data2['TransName']="Reciept";
          $data2['Amount']=$this->input->post('amount');
          $data2['balance']=$this->input->post('balance');
          $data2['Transdate']=date('Y-m-d');
          $data2['RecieptVoucherID']=$id;
          $data2['cur_time']=date('h:i:s a', time());
          $data2['trans_type']="Cash Paid";
          $data2['invoice_no']=$last_invoice;
          $data2['notes']=$this->input->post('notes');
          $data2['cancel_status']="1";
          $data2['show_status']="1";
          $data2['out_stat']="1";
          $this->common_model->insert('ledger',$data2);


      $vend_id  = $this->input->post('customer');   
      $this->db->select_sum('total');
      $res=$this->db->get_where('raw_material_print',array("customer"=>$vend_id,'raw_status'=>'1'));
      $data7= $res->row();
      $amt =  $data7->total;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_out',array("vendor_name"=>$vend_id,"cash_out_status"=>'1'));
      $data8= $res->row();
      $amt1 =  $data8->amount;
      
      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_in',array("vendor_name"=>$vend_id,"cash_in_status"=>'1'));
      $data9= $res->row();
      $amt2 =  $data9->amount;
      $balance_amount = ($amt-$amt1)+$amt2;
      $page_data['balance']=$balance_amount;
      
      $this->db->where('vendor_id',$vend_id);
      $this->db->update('debitor',$page_data);
      
      
       $d=date('Y-m-d');
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
          
        }
        
        
      
          redirect(base_url().'index.php/main_admin/cash_out_print/'.$id,'refresh');
        }
      }
    }
    public function cash_out_print($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/account/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/cash_out_print');
        }
        else{

          $data['id'] = $param1;
          $this->load->view('admin/admin/cash_out_print',$data);
        }
      }
    }
    
    
public function guest($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/guest_bill');
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
          if($last_invoice == "RAW001000"){
          $last_invoice="RAW000";
         }

         $invid=str_split($last_invoice,5);
  			$inv=(int)$invid[1]+1;
  			$last_invoice="RAW"."00".$inv;
           /*  $data3['last_invoice_id'] = $last_invoice;
          $this->db->where('guest_last_id','1');
          $this->db->update('guest_last_invoice_id',$data3);*/
          $data3['customer_print_no'] = $last_invoice;
          $this->db->where('customer_print','1');
          $this->db->update(' customer_print_last_invoice',$data3);
          $avg=round($this->input->post('cash_recieved')/$this->input->post('qty'),2);

          $data1 = array(
         'product' => $this->input->post('product'),
         'guest_invoice_no' => $last_invoice,
         'price' => $this->input->post('price'),
         'quantity' => $this->input->post('qty'),
         'total' => $this->input->post('total'),
         'average' => $avg,
         'vehicle' => $this->input->post('reg_no'),
         'customer' => $this->input->post('customer'),
         'notes' => $this->input->post('notes'),
         'balance' => $this->input->post('balance'),
         'discount' => $this->input->post('discount'),
         'amount' => $this->input->post('amount'),
         'cash_recieved' => $this->input->post('cash_recieved'),
         'date' => date('Y-m-d'),
         'guest_status'=>'1',
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
          //'Amount' =>$this->input->post('amount'),
          'Amount' =>$this->input->post('cash_recieved'),
          'discount' => $this->input->post('discount'),
          'Transdate' => date('Y-m-d'),
          'cur_time' => date('h:i:s a', time()),
          'trans_type' => "Cash Paid",
          'invoice_no' => $last_invoice,
          'SaleID' => $id,
          'cancel_status'=>1,
          'show_status'=>1,
          'in_stat'=>1,
          'vehicle'=>$this->input->post('reg_no'),
          'item'=>$this->input->post('product'),
          'quantity'=>$this->input->post('qty'),
          'notes'=>$this->input->post('notes')
          );
          $this->common_model->insert('ledger',$data2);
          $ledge_id=$this->db->insert_id();
     //$this->common_model->insert('bill',$data);
            $data3 = array(
             'product' => $this->input->post('product'),
             'invoice_no' => $last_invoice,
             'price' => $this->input->post('price'),
             'quantity' => $this->input->post('qty'),
             'total' => $this->input->post('cash_recieved'),
             'vehicle' => $this->input->post('reg_no'),
             'customer' => 0,
             'customer_name' => $this->input->post('customer'),
             'user_type' => 'Sale',
             'date' => date('Y-m-d'),
             'notes' => $this->input->post('notes'),
             'cur_date' => date('h:i:s a', time()),
             'cur_time' => date('h:i:s a', time()),
             'ledger_id'=>$ledge_id,
             'guest_id'=>$id,
             'average'=>$avg,
             'show_cancel_status'=>'1',
             'status'=>'1'
              );
              $this->common_model->insert('sale',$data3);

               $data4['cust_name']=0;
               $data4['cash_in_invoice']=$last_invoice;
               $data4['balance']=$this->input->post('balance');
               $data4['cash_recieved']=$this->input->post('cash_recieved');
               $data4['amount']=$this->input->post('cash_recieved');
               //$data4['amount']=$this->input->post('amount');
               $data4['notes']=$this->input->post('notes');
               $data4['insert_date']=date('Y-m-d');
               $data4['date']=date('Y-m-d');
               $data4['cur_date']=date('h:i:s a', time());
               $data4['cash_in_status']=1;
               $this->common_model->insert('cash_in',$data4);
               
               
                $d=date('Y-m-d');
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
          
        }

     redirect(base_url().'index.php/main_admin/guest_bill_print/'.$id,'refresh');
        }

      }
    }

    public function guest_bill_print($param1=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/guest_bill_print');
        }
        else{

          $data['id'] = $param1;
          $this->load->view('admin/admin/guest_bill_print',$data);
        }
      }
    }
    
    public function show_guest_product_price($prod)
    {
      $price = $this->db->get_where('product',array('id'=>$prod))->row()->price;
      echo $price;
    }
    
    public function raw_material($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/raw_material_bill');
        }
        elseif($param1=="do_add"){
          date_default_timezone_set('Asia/Kolkata');
          $reg_no = $this->input->post('reg_no');

          $last_invoice = $this->db->get_where('raw_material_last_invoice',array('raw_last_invoice'=>'1'))->row()->raw_material_last_no;

          /*if($last_invoice == "1001"){
            $last_invoice="1";
          }

          $data3['raw_material_last_no'] = $last_invoice+1;*/
          
          if($last_invoice == "RAW001000"){
          $last_invoice="RAW000";
        }

        $invid=str_split($last_invoice,5);
  			$inv=(int)$invid[1]+1;
  			$last_invoice="RAW"."00".$inv;
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
         'raw_status'=>'1',
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
          'SupplierID' => $this->input->post('customer'),
          'balance' => $this->input->post('balance'),
          'user_type' => "vendor",
          'Type' => "Debit",
          'TransName' => "Reciept",
          'Amount' =>$this->input->post('total'),
          'cur_time' => date('h:i:s a', time()),
          'invoice_no' => $last_invoice,
          'trans_type' => "Credit",
          'Transdate' => date('Y-m-d'),
          'SaleID' => $id,
          'cancel_status'=>1,
          'vehicle'=>$this->input->post('reg_no'),
          'item'=>$this->input->post('product'),
          'quantity'=>$this->input->post('qty'),
          'notes'=>$this->input->post('notes')
          );
          $this->common_model->insert('ledger',$data2);
          $ledge_id=$this->db->insert_id();
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
        'notes' => $this->input->post('notes'),
        'cur_date' => date('h:i:s a', time()),
        'cur_time' => date('h:i:s a', time()),
        'ledger_id' => $ledge_id,
        'raw_id'=>$id,
        'show_cancel_status'=>'1',
        'status'=>'1'
         );
         $this->common_model->insert('sale',$data3);

      $vend_id  = $this->input->post('customer');   
      $this->db->select_sum('total');
      $res=$this->db->get_where('raw_material_print',array("customer"=>$vend_id,'raw_status'=>'1'));
      $data7= $res->row();
      $amt =  $data7->total;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_out',array("vendor_name"=>$vend_id,"cash_out_status"=>'1'));
      $data8= $res->row();
      $amt1 =  $data8->amount;
      
      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_in',array("vendor_name"=>$vend_id,"cash_in_status"=>'1'));
      $data9= $res->row();
      $amt2 =  $data9->amount;
      $balance_amount = ($amt-$amt1)+$amt2;
      $page_data['balance']=$balance_amount;
      
      $this->db->where('vendor_id',$vend_id);
      $this->db->update('debitor',$page_data);
      
     redirect(base_url().'index.php/main_admin/print_raw_material_bill/'.$id,'refresh');

        }
      }
    }

    public function print_raw_material_bill($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/print_raw_material_bill');
        }
        else{

          $data['id'] = $param1;
          $this->load->view('admin/admin/print_raw_material_bill',$data);
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
    public function getPrices_vendor_products1($customer)
    {
      $this->db->select_sum('total');
    	$res=$this->db->get_where('customer_print',array("customer"=>$customer,'cust_status'=>'1'));
    	$data= $res->row();
      $amt =  $data->total;

      $this->db->select_sum('amount');
    	$res=$this->db->get_where('cash_in',array("cust_name"=>$customer,"cash_in_status"=>'1'));
    	$data= $res->row();
      $amt1 =  $data->amount;

      $this->db->select_sum('amount');
    	$res=$this->db->get_where('cash_out',array("customer_name"=>$customer,"cash_out_status"=>'1'));
    	$data= $res->row();
      $amt2 =  $data->amount;


      echo ($amt+$amt2)-$amt1;
    }
    
    public function sales_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $d=date('Y-m-d');

          $this->db->select_sum('total');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Sale",'status'=>'1'));
          $data1= $res->row();
          $amt2 =  $data1->total;
          
          $this->db->select_sum('quantity');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Sale",'status'=>'1'));
          $data1= $res->row();
          $qty =  $data1->quantity;
          
          $this->db->select_sum('average');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Sale",'status'=>'1'));
          $data1= $res->row();
          $avg =  $data1->average;
          
          $reslt="SELECT product,count(average) as cnt,sum(quantity) as quantity,sum(average) as sum,sum(total) as total FROM sale WHERE date='$d' AND user_type='Sale' AND status='1' GROUP BY product";
          $data['report']=$this->db->query($reslt)->result_array();
          
          $data['amount']=$amt2;
          $data['qty']=$qty;
          $data['avg']=$avg;
          $data['sales']=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Sale",'status'=>'1'))->result_array();
          $this->load->view('admin/admin/sales_report',$data);
        }
        elseif($param1="show_report"){
          $from=$this->input->post('date_from');
          $to=$this->input->post('date_to');

          $this->db->select_sum('total');
          $res=$this->db->get_where('sale',array('date>='=>$from,'date<='=>$to,'user_type'=>"Sale",'status'=>'1'));
          $data2= $res->row();
          $amt2 =  $data2->total;
          
          $this->db->select_sum('quantity');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date>='=>$from,'date<='=>$to,'user_type'=>"Sale",'status'=>'1'));
          $data1= $res->row();
          $qty =  $data1->quantity;
          
          $this->db->select_sum('average');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date>='=>$from,'date<='=>$to,'user_type'=>"Sale",'status'=>'1'));
          $data1= $res->row();
          $avg =  $data1->average;
            
          //$reslt="SELECT product,count(average) as cnt,sum(average) as sum,sum(total) as total FROM sale WHERE user_type='Sale' AND date>='$from' AND date<='$to' AND status='1' GROUP BY product ";
          $reslt="SELECT product,count(average) as cnt,sum(quantity) as quantity,sum(average) as sum,sum(total) as total FROM sale WHERE date>='$from' AND date<='$to' AND user_type='Sale' AND status='1' GROUP BY product";
          $data['report']=$this->db->query($reslt)->result_array();
          
          $data['amount']=$amt2;
          $data['qty']=$qty;
          $data['avg']=$avg;
          $data['sales']=$this->db->get_where('sale',array('date>='=>$from,'date<='=>$to,'user_type'=>"Sale",'status'=>'1'))->result_array();
          $this->load->view('admin/admin/sales_report',$data);
        }
      }
    }
    
      public function purchase_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $d=date('Y-m-d');

          $this->db->select_sum('total');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Purchase",'status'=>'1'));
          $data1= $res->row();
          $amt2 =  $data1->total;
          
          $this->db->select_sum('quantity');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Purchase",'status'=>'1'));
          $data1= $res->row();
          $qty =  $data1->quantity;
          
          $this->db->select_sum('average');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Purchase",'status'=>'1'));
          $data1= $res->row();
          $avg =  $data1->average;
          
          $reslt="SELECT product,count(average) as cnt,sum(quantity) as quantity,sum(average) as sum,sum(total) as total FROM sale WHERE date='$d' AND user_type='Purchase' AND status='1' GROUP BY product";
          $data['report']=$this->db->query($reslt)->result_array();
          
          $data['amount']=$amt2;
          $data['qty']=$qty;
          $data['avg']=$avg;
          
          $data['purchase']=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Purchase",'status'=>'1'))->result_array();
          $this->load->view('admin/admin/purchase_report',$data);
        }
        elseif($param1="show_report"){
          $from=$this->input->post('date_from');
          $to=$this->input->post('date_to');

          $this->db->select_sum('total');
          $res=$this->db->get_where('sale',array('date>='=>$from,'date<='=>$to,'user_type'=>"Purchase",'status'=>'1'));
          $data2= $res->row();
          $amt2 =  $data2->total;
          
          $this->db->select_sum('quantity');
          $res1=$this->db->get_where('sale',array('date>='=>$from,'date<='=>$to,'user_type'=>"Purchase",'status'=>'1'));
          $data1= $res1->row();
          $qty =  $data1->quantity;
          
          $this->db->select_sum('average');
          $res2=$this->db->get_where('sale',array('date>='=>$from,'date<='=>$to,'user_type'=>"Purchase",'status'=>'1'));
          $data2= $res2->row();
          $avg =  $data2->average;
          
          $reslt="SELECT product,count(average) as cnt,sum(quantity) as quantity,sum(average) as sum,sum(total) as total FROM sale WHERE date>='$from' AND date<='$to' AND user_type='Purchase' AND status='1' GROUP BY product";
          $data['report']=$this->db->query($reslt)->result_array();

          $data['amount']=$amt2;
          $data['qty']=$qty;
          $data['avg']=$avg;
          $data['purchase']=$this->db->get_where('sale',array('date>='=>$from,'date<='=>$to,'user_type'=>"Purchase",'status'=>'1'))->result_array();
          $this->load->view('admin/admin/purchase_report',$data);
        }
      }
    }
    
   public function cash_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){

        $d=date('Y-m-d');

        $this->db->select_sum('amount');
        $res=$this->db->get_where('cash_in',array('date'=>$d,'cash_in_status'=>1));
        $data1= $res->row();
        $cash_in =  $data1->amount;

        $this->db->select_sum('amount');
        $res=$this->db->get_where('cash_out',array('date'=>$d,'cash_out_status'=>1));
        $data2= $res->row();
        $cash_out =  $data2->amount;

        /*$yesterday = date('Y-m-d',strtotime("-1 days"));
        $this->db->select_sum('amount');
        $d=date('Y-m-d');
        $res=$this->db->get_where('cash_out',array('date'=>$yesterday));
        $data3= $res->row();
        $amt3 =  $data3->amount;*/
        /*if( ($this->db->get_where('cash_report',array('date'=>$d))->result_array()) !="NULL" ){
          $d=date('Y-m-d');
          $opening=$this->db->get_where('cash_report',array('date'=>$d))->row()->opening;
        }
        else{
          $opening=0;
        }*/

        //$cash_in=$this->db->get_where('cash_report',array('date'=>$d))->row()->cash_in;
      //  $cash_out=$this->db->get_where('cash_report',array('date'=>$d))->row()->cash_out;
      //  $closing=$this->db->get_where('cash_report',array('date'=>$d))->row()->closing;

        //$data['cash_in']=$cash_in;
      //  $data['cash_out']=$cash_out;
        //$data['opening']=$opening;


        //$data['closing']=$closing;
      //  $data['closing']=$opening+$cash_in-$cash_out;
        //$data['opening']=$cash_in-$cash_out;
        $this->load->view('admin/admin/cash_report');
        }
      elseif($param1=="close_account"){
        $d=date('Y-m-d');
        $opening=$this->db->get_where('cash_report',array('date'=>$d))->row()->opening;

        $this->db->select_sum('amount');
        $d=date('Y-m-d');
        $res=$this->db->get_where('cash_in',array('date'=>$d,'cash_in_status'=>1));
        $data1= $res->row();
        $cash_in =  $data1->amount;

        $this->db->select_sum('amount');
        $d=date('Y-m-d');
        $res=$this->db->get_where('cash_out',array('date'=>$d,'cash_out_status'=>1));
        $data2= $res->row();
        $cash_out =  $data2->amount;

        $closing=$opening+$cash_in-$cash_out;

        $data['cash_in']=$cash_in;
        $data['cash_out']=$cash_out;
        $data['opening']=$opening;
        $data['closing']=$closing;
        $data['date']=date('Y-m-d');

        //$this->db->insert('cash_report',$data);
        $this->db->where('date',$d);
        $this->db->update('cash_report',$data);

        
        $tom=date("Y-m-d", strtotime("+1 day"));
        $data4['opening']=$closing;
        $data4['date'] =$tom;
        
        /*$this->db->where('date',$yesterday);
        $this->db->update('cash_report',$data4);*/
          if(!isset($this->db->get_where('cash_report',array('date'=>$tom))->row()->opening)){
         $this->db->insert('cash_report',$data4);

        }
        else{
          $date=$tom;
          $data5['opening']=$closing;
          $data5['date'] =$date;
          $this->db->where('date',$date);
          $this->db->update('cash_report',$data5);
          
        }
        $this->load->view('admin/admin/cash_report',$data);

      }
      elseif($param1=="add_opening_balance"){


        redirect(base_url() . 'index.php/main_admin/cash_report','refresh');
      }

     }
    }
    
    public function Add_opening_balance($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() . 'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/add_opening_balance');
        }
        else{
          if($param1=="opening_balance"){
              $d=date('Y-m-d');
              //$res=$this->db->get_where('cash_report',array('date'=>$d))->result_array();
              /*$res=$this->db->get_where('cash_report',array('date'=>$d));

            if(($res->num_rows() < 0) ){
              $data2['opening']=$this->input->post('today_open_bal');
              $data2['date']=date('Y-m-d');
              $this->db->insert('cash_report',$data2);
            }
            else{
              $data1['opening']=$this->input->post('today_open_bal');
              $this->db->where('date',$d);
              $this->db->update('cash_report',$data1);
            }*/
            $data2['opening']=$this->input->post('today_open_bal');
            $data2['date']=date('Y-m-d');
            $this->db->insert('cash_report',$data2);
            redirect(base_url() . 'index.php/main_admin/Add_opening_balance','refresh');
          }
        }
      }
    }

public function purchase_balance($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $d=date('Y-m-d');
          $this->db->select_sum('total');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Purchase",'status'=>'1'));
          $data1= $res->row();
          $amt2 =  $data1->total;
          
          $reslt="SELECT product,count(average) as cnt,sum(average) as sum,sum(total) as total FROM sale WHERE date='$d' AND user_type='Purchase' AND status='1' GROUP BY product";
          $data['report']=$this->db->query($reslt)->result_array();
          
          $data['amount']=$amt2;
          $data['purchase']=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Purchase",'status'=>'1'))->result_array();
          
          $this->load->view('admin/admin/purchase_balance',$data);
        }
        elseif($param2==""){

        }
      }
    }
    
    
    public function sales_balance($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $d=date('Y-m-d');

          $this->db->select_sum('total');
          $d=date('Y-m-d');
          $res=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Sale",'status'=>'1'));
          $data1= $res->row();
          $amt2 =  $data1->total;

          $reslt="SELECT product,count(average) as cnt,sum(average) as sum,sum(total) as total FROM sale WHERE date='$d' AND user_type='Sale' AND status='1' GROUP BY product";
          $data['report']=$this->db->query($reslt)->result_array();

          $data['amount']=$amt2;
          $data['sales']=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Sale",'status'=>'1'))->result_array();
          $this->load->view('admin/admin/sales_balance',$data);
        }
        elseif($param2==""){

        }
      }
    }
    
    public function daily_sales_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $d=date('Y-m-d');
          //$data['sales']=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Sale",'status'=>'1'))->result_array();
          $data['sales']=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Sale"))->result_array();
          $this->load->view('admin/admin/daily_sales_report',$data);
        }
      }
    }
    
     public function daily_purchase_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $d=date('Y-m-d');
          //$data['purchase']=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Purchase",'status'=>'1'))->result_array();
          $data['purchase']=$this->db->get_where('sale',array('date'=>$d,'user_type'=>"Purchase"))->result_array();
          $this->load->view('admin/admin/daily_purchase_report',$data);
        }
      }
    }
    
    public function customer_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $data['check']="null";
          $this->load->view('admin/admin/customer_report',$data);
        }
        elseif($param1="show_report"){
          $from=$this->input->post('date_from');
          $to=$this->input->post('date_to');
          $customer=$this->input->post('customer');
          $d=date('Y-m-d');
          if($from==NULL && $to == NULL){
              $data['ledger']=$this->db->get_where('ledger',array('Transdate>='=>$d,'Transdate<='=>$d,'CustomerID'=>$customer,'cancel_status'=>'1'))->result_array();
             $data['from']=date('Y-m-d');
             $data['to']=date('Y-m-d');
             $data['customer1']=$customer;
          }
          else{
              $data['ledger']=$this->db->get_where('ledger',array('Transdate>='=>$from,'Transdate<='=>$to,'CustomerID'=>$customer,'cancel_status'=>'1'))->result_array();
              $data['from']=$from;
              $data['to']=$to;
              $data['customer1']=$customer;
          }
          $data['customer']=$this->db->get_where('customer',array('id'=>$customer))->row()->name;
          $this->load->view('admin/admin/customer_report',$data);
        }
      }
    }
    
    public function vendor_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $data['check']="null";
          $this->load->view('admin/admin/vendor_report',$data);
        }
        elseif($param1="show_report"){
          $from=$this->input->post('date_from');
          $to=$this->input->post('date_to');
          $customer=$this->input->post('customer');
          $d=date('Y-m-d');
          if($from==NULL && $to == NULL){
             $data['ledger']=$this->db->get_where('ledger',array('Transdate>='=>$d,'Transdate<='=>$d,'SupplierID'=>$customer,'cancel_status'=>'1'))->result_array(); 
             
             $data['from']=date('Y-m-d');
             $data['to']=date('Y-m-d');
             $data['customer1']=$customer;
          }
          else{
              $data['ledger']=$this->db->get_where('ledger',array('Transdate>='=>$from,'Transdate<='=>$to,'SupplierID'=>$customer,'cancel_status'=>'1'))->result_array();
              $data['from']=$from;
              $data['to']=$to;
              $data['customer1']=$customer;

          }
          $data['customer']=$this->db->get_where('vendor',array('vendor_id'=>$customer))->row()->name;
          
          $this->load->view('admin/admin/vendor_report',$data);
        }
      }
    }
    
    public function daily_cash_payment($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
           $d=date('Y-m-d');
           $data['opening']=$this->db->get_where('cash_report',array('date'=>$d))->row()->opening;
		   $data['closing']=$this->db->get_where('cash_report',array('date'=>$d))->row()->closing;
		   
          $data['payment']=$this->db->get_where('ledger',array('Transdate'=>$d,'cancel_status'=>'1','show_status'=>'1'))->result_array();
          $this->load->view('admin/admin/daily_cash_payment',$data);
        }
      }
    }
    
    public function status_cancel_sales($param1){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
            $data['status']="2";
            $this->db->where('sales_id',$param1);
            $this->db->update('sale',$data);
            
            $led_id=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->ledger_id;
            $data1['cancel_status']="2";
            $data1['show_status']="2";
            $this->db->where('LedgerID',$led_id);
            $this->db->update('ledger',$data1);
            
            $cust_id=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->cust_id;
            $data2['cust_status']="2";
            $this->db->where('customer_print_id',$cust_id);
            $this->db->update('customer_print',$data2);
            
            $guest_id=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->guest_id;
            $data3['guest_status']="2";
            $this->db->where('guest_print_id',$guest_id);
            $this->db->update('guest_print',$data3);
            
            $customer_id=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->customer;
            $inv_no=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->invoice_no;
            
            if($customer_id==0){
                $data4['cash_in_status']="2";
                $this->db->where('cash_in_invoice',$inv_no);
                $this->db->update('cash_in',$data4); 
            }
            
             //$cust_id=$this->input->post('customer');
            if( 
                ($this->db->get_where('ledger',array('LedgerID'=>$led_id))->row()->CustomerID)!=NULL){
                $cid= $this->db->get_where('ledger',array('LedgerID'=>$led_id))->row()->CustomerID;   
      $this->db->select_sum('total');
      $res=$this->db->get_where('customer_print',array("customer"=>$cid,'cust_status'=>'1'));
      $data7= $res->row();
      $amt =  $data7->total;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_in',array("cust_name"=>$cid,"cash_in_status"=>'1'));
      $data8= $res->row();
      $amt1 =  $data8->amount;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_out',array("customer_name"=>$cid,"cash_out_status"=>'1'));
      $data9= $res->row();
      $amt2 =  $data9->amount;


      $balance_amount =  ($amt+$amt2)-$amt1;
      $page_data['balance']=$balance_amount;
      
      $this->db->where('cust_id',$cid);
      $this->db->update('creditor',$page_data);
                }
        
           redirect(base_url() .'index.php/main_admin/daily_sales_report','refresh');
      }
    }
    
    public function status_cancel_purchase($param1){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
            $data['status']="2";
            $this->db->where('sales_id',$param1);
            $this->db->update('sale',$data);
            
            $led_id=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->ledger_id;
            $data1['cancel_status']="2";
            $this->db->where('LedgerID',$led_id);
            $this->db->update('ledger',$data1);
            
            /*$cust_id=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->cust_id;
            $data2['cust_status']="2";
            $this->db->where('customer_print_id',$cust_id);
            $this->db->update('customer_print',$data2);
            
            $guest_id=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->guest_id;
            $data3['guest_status']="2";
            $this->db->where('guest_print_id',$guest_id);
            $this->db->update('guest_print',$data3);*/
            
            
            
            $cust_id=$this->db->get_where('sale',array('sales_id'=>$param1))->row()->raw_id;
            $data2['raw_status']="2";
            $this->db->where('raw_print_id',$cust_id);
            $this->db->update('raw_material_print',$data2);
            
        if(($this->db->get_where('ledger',array('LedgerID'=>$led_id))->row()->SupplierID)!=NULL){    
            
            $vend_id  = $this->input->post('customer');   
      $this->db->select_sum('total');
      $res=$this->db->get_where('raw_material_print',array("customer"=>$vend_id,'raw_status'=>'1'));
      $data7= $res->row();
      $amt =  $data7->total;

      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_out',array("vendor_name"=>$vend_id,"cash_out_status"=>'1'));
      $data8= $res->row();
      $amt1 =  $data8->amount;
      
      $this->db->select_sum('amount');
      $res=$this->db->get_where('cash_in',array("vendor_name"=>$vend_id,"cash_in_status"=>'1'));
      $data9= $res->row();
      $amt2 =  $data9->amount;
      $balance_amount = ($amt-$amt1)+$amt2;
      $page_data['balance']=$balance_amount;
      
      $this->db->where('vendor_id',$vend_id);
      $this->db->update('debitor',$page_data);
            
      }
           redirect(base_url() .'index.php/main_admin/daily_purchase_report','refresh');
      }
    }
   
   public function debitor_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
          $data['debitor']=$this->db->get_where('debitor',array('balance!='=>0))->result_array();
          $this->load->view('admin/admin/debitor_report',$data);
      }
      
     }
     
     public function creditor_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
          $data['creditor']=$this->db->get_where('creditor',array('balance!='=>0))->result_array();
          $this->load->view('admin/admin/creditor_report',$data);
      }
      
     } 
     
     public function in_out_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
           $d=date('Y-m-d');
          //$data['payment']=$this->db->get_where('ledger',array('Transdate'=>$d,'cancel_status'=>'1'))->result_array();
          //$r="select * from ledger where Transdate='$d' and cancel_status='1' and (PaymentVoucherID!='NULL' OR RecieptVoucherID!='NULL')";
          $r="select * from ledger where Transdate='$d' and (PaymentVoucherID!='NULL' OR RecieptVoucherID!='NULL')";
          $data['payment']=$this->db->query($r)->result_array();
          $this->load->view('admin/admin/cashin_cashout_report.php',$data);
        }
      }
    }
 public function status_cancel_cash_in($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
            $data3['cancel_status']="2";
            $data3['in_stat']="2";
            $this->db->where('LedgerID',$param1);
            $this->db->update('ledger',$data3);
            
            
            $in_id=$this->db->get_where('ledger',array('LedgerID'=>$param1))->row()->PaymentVoucherID;
            $out_id=$this->db->get_where('ledger',array('LedgerID'=>$param1))->row()->RecieptVoucherID;
            
            if($in_id!=""){
            
            $data4['cash_in_status']="2";
            $this->db->where('cash_in_id',$in_id);
            $this->db->update('cash_in',$data4);
            
            $supid=$this->db->get_where('ledger',array('LedgerID'=>$param1))->row()->SupplierID;
            $customerid=$this->db->get_where('ledger',array('LedgerID'=>$param1))->row()->CustomerID;
                
            if($supid!=NULL){
            $balance=$this->db->get_where('ledger',array('LedgerID'=>$param1))->row()->balance;
                    
            $data7 = array(
            'balance' => $balance
            );
            $this->db->where('debitor_id',$supid);
            $this->db->update('debitor',$data7);
            //$this->common_model->insert('creditor',$data7);
                }
             else{
            $balance=$this->db->get_where('ledger',array('LedgerID'=>$param1))->row()->balance;
                    
            $data7 = array(
            'balance' => $balance
           );
          $this->db->where('id',$customerid);
          $this->db->update('creditor',$data7);
          //$this->common_model->insert('creditor',$data7);
                }
          
            }
            else{
            $data5['cash_out_status']="2";
            $this->db->where('cash_out_id',$out_id);
            $this->db->update('cash_out',$data5); 
            }
      }
      
       redirect(base_url() .'index.php/main_admin/in_out_report','refresh');
     }
     
     public function expense_category_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
          $this->load->view('admin/admin/expense_report.php');
        }
        elseif($param1=="show_exp_report"){
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $exp = $this->input->post('exp');
            $page['rest']="yes";
            $page['result']=$this->db->get_where('expense',array('category'=>$exp,'date>='=>$from,'date<='=>$to))->result_array();
            $this->load->view('admin/admin/expense_report.php',$page);
        }
      }
    }
    
     public function cash_in_out_report($param1="",$param2=""){
      if($this->session->userdata('user_type') == ""){
        redirect(base_url() .'index.php/main_admin/index','refresh');
      }
      else{
        if($param1==""){
            $d=date('Y-m-d');
            $page['from']=$d;
            $page['to']=$d;
            $page['rest']="yes";
            $page['result']=$this->db->get_where('ledger',array('show_status'=>'1','cancel_status'=>'1','Transdate'=>$d))->result_array();
            $this->load->view('admin/admin/cash_in_out_report.php',$page);
        }
        elseif($param1=="show_report"){
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $page['from']=$from;
            $page['to']=$to;
            $page['rest']="yes";
            $page['result']=$this->db->get_where('ledger',array('show_status'=>'1','cancel_status'=>'1','Transdate>='=>$from,'Transdate<='=>$to))->result_array();
            $this->load->view('admin/admin/cash_in_out_report.php',$page);
        }
      }
    }
    
}
