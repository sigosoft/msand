

 <?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {


	function __construct()
    {
        parent::__construct();
        $this->load->database();
		    $this->load->model('Crud_model');

    }


	public function index()
    {
        $this->load->view('admin/index');
    }
	public function login()
    {

		 $user=$this->input->post('name');
		 $pass=sha1($this->input->post('password'));
		  $query = $this->db->get_where('login', array('email' => $user,'password' => $pass));
        if ($query->num_rows() > 0) {
            
            //$remote  = $_SERVER['REMOTE_ADDR'];
            //if(filter_var($remote=='103.58.79.181')){
                
            $this->session->set_userdata('user_login', 'yes');
            $this->session->set_userdata('name', $query->row()->name);
            $this->session->set_userdata('login_id', $query->row()->login_id);
            $this->session->set_userdata('user_id', $query->row()->user_id);
			      //$utype = $query->row()->user_type;
            $this->session->set_userdata('user_type', $query->row()->user_type);
            $this->db->where('user_id', $query->row()->user_id);
            $this->db->update('login', array('last_login' => time()));
            }
           // else{
            //   redirect(base_url() . 'index.php/admin/dashboard'); 
           //}
            
           
        

       redirect(base_url() . 'index.php/admin/dashboard');
       //echo $this->session->userdata('user_login'); echo 'NAME';
      //echo $this->session->userdata('name');echo 'LOGIN ID';
       //echo $this->session->userdata('login_id');echo 'USER ID';
      //echo $this->session->userdata('user_id') ;  echo 'USER TYPE';   echo $this->session->userdata('user_type');

	}

	public function dashboard()
    {
		if($this->session->userdata('user_type') == ""){
			redirect(base_url() . 'index.php/admin/index','refresh');
		}else{
			if($this->session->userdata('user_type') == "superadmin"){
			$this->load->view('admin/superadmin/dashboard');}
			elseif($this->session->userdata('user_type') == "admin"){
			$this->load->view('admin/admin/dashboard');}
			elseif($this->session->userdata('user_type') == "user"){
			$this->load->view('admin/user/dashboard');}

      elseif($this->session->userdata('user_type') == "account"){
			$this->load->view('admin/account/dashboard');}


			else{
			redirect(base_url() . 'index.php/admin/index'); }
		}
	}

	public function user($param1='',$param2='')
	{
		if($this->session->userdata('user_type') == ""){
			redirect(base_url() . 'index.php/admin/index','refresh');
		}
		else{
		if($param1 == ''){
			//$this->db->order_by('login_id', 'desc');
            //$page_data['users'] = $this->db->get_where('login', array('user_type !=' => 'superadmin'))->result_array();
			$page_data['users'] = $this->crud_model->user_view();
			$this->load->view('admin/superadmin/user',$page_data);
		}

		elseif($param1 == "delete"){
			$this->crud_model->user_delete($param2);
		}
		elseif($param1 == "add"){
			$this->load->view('admin/superadmin/user_add');
		}
		elseif($param1 == "do_add"){
			//$data['name'] = $this->input->post('name');

			//$data['mobile'] = $this->input->post('mobile');
			$data = array(
					'name' => $this->input->post('name'),
					'mobile' => $this->input->post('mobile'),
					'address' => $this->input->post('address'),
					'email' => $this->input->post('email'),
					'user_type' => $this->input->post('user_type'),
					'password' => sha1($this->input->post('password')),
					'insert_date' => date('d-m-Y'),
			);
			$this->crud_model->user_add($data);
			$page_data['users'] = $this->crud_model->user_view();
			redirect(base_url() . 'index.php/admin/user','refresh');

		}
		elseif ($param1 == 'edit') {
            $this->db->where('login_id', $param2);
			$page_data['users'] = $this->db->get_where('login', array('login_id =' => $param2))->result_array();
            $this->load->view('admin/superadmin/user_edit',$page_data);
		}
		elseif($param1 == "update"){
			$data = array(
					'name' => $this->input->post('name'),
					'mobile' => $this->input->post('mobile'),
					'address' => $this->input->post('address'),
					'email' => $this->input->post('email'),
					'user_type' => $this->input->post('user_type'),
					'password' => sha1($this->input->post('password')),
			);
			$this->crud_model->user_update($data,$param2);
            $page_data['users'] = $this->crud_model->user_view();
			redirect(base_url() . 'index.php/admin/user');

		}
		}

	}


}
