

 <?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller {


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

public function attendance($param1="",$param2="")
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/user/index','refresh');
  }
  else{
    if($param1==""){
    $lid=$this->session->userdata('login_id');
    $uid=$this->session->userdata('user_id');
    //$uid=$this->db->get_where('user',array('login_id'=>$lid))->row()->user_id;
    $page_data['attendance'] = $this->crud_model->attendance_view_user($uid);
    $this->load->view('admin/user/attendance',$page_data);
  }
    elseif ($param1 == 'do_add') {
      $d=$this->input->post('date');
      $m=date('m',strtotime($d));

			$config['upload_path']='./upload/attendance/';
			$config['allowed_types']='jpg|png|gif|pdf';
			$config['max_size']=2048;
			$config['encrypt_name']=TRUE;
			$this->load->library('upload',$config);
			if(! $this->upload->do_upload('image')){
				echo "fail";
				}
			else{
			  $data=array('image'=>$this->upload->data());
				$file_name=$data["image"]["file_name"];
				$image_path='upload/attendance/';
				$imgp=base_url().$image_path.($file_name);
				//$a=$this->input->post('sub');
				//$sub=$this->db->get_where('sub_category',array('name'=>$a))->row()->id;
				$data = array(
					'date' => $this->input->post('date'),
          'month' => $m,
					'working_hours' => $this->input->post('hour'),
					'category' => $this->input->post('cate'),

					'notes' => $this->input->post('note'),
					'staff_id' => $this->session->userdata('user_id'),
					'image' => $imgp


			);
      $this->db->insert('attendance',$data);
      redirect(base_url() . 'index.php/user/attendance','refresh');
			}

		}


    elseif ($param1 == 'del_view') {
      //echo $param2;
      $id=$this->input->post('id1');
      $this->crud_model->attendance_delete($id);
      redirect(base_url() . 'index.php/user/attendance','refresh');
    }
    elseif ($param1 == 'edit') {
      //echo $param2;
      //$page_data['attendance'] = $this->crud_model->attendance_edit($param2);
      $page_data['attendance'] = $this->crud_model->attendance_edit($param2);
      $this->load->view('admin/user/attendance_edit',$page_data);
        //redirect(base_url() . 'index.php/user/attendance','refresh');
    }
    elseif ($param1 == 'update') {
      $data['date']=$this->input->post('date');
      $data['category']=$this->input->post('cate');
      $data['notes']=$this->input->post('note');

      $this->db->where('att_id',$param2);
      $this->db->update('attendance',$data);
      redirect(base_url() . 'index.php/user/attendance','refresh');


    }
}
}

public function leave_application($param1="",$param2=""){
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/user/index','refresh');
  }
  else{
    if($param1==""){
    $lid=$this->session->userdata('login_id');
    $uid=$this->session->userdata('user_id');
    //$uid=$this->db->get_where('user',array('login_id'=>$lid))->row()->user_id;
    $page_data['leave'] = $this->crud_model->leave_user($uid);
    $this->load->view('admin/user/leave_application',$page_data);
  }
  elseif($param1=="del_view"){
      $id=$this->input->post('id1');

      $this->db->where('leave_id',$id);
      $this->db->delete('leave_application');
      redirect(base_url() . 'index.php/user/leave_application','refresh');

  }
  elseif($param1=="apply_single"){

	  $config['upload_path']='./upload/leave_application/';
			$config['allowed_types']='jpg|png|gif|pdf';
			$config['max_size']=2048;
			$config['encrypt_name']=TRUE;
			$this->load->library('upload',$config);
			if(! $this->upload->do_upload('image')){
				echo "fail";
				}
			else{
			  $data=array('image'=>$this->upload->data());
				$file_name=$data["image"]["file_name"];
				$image_path='upload/leave_application/';
				$imgp=base_url().$image_path.($file_name);
				//$a=$this->input->post('sub');
				//$sub=$this->db->get_where('sub_category',array('name'=>$a))->row()->id;
				$data = array(
					'user_id' => $this->input->post('id1'),
					'from' => $this->input->post('date'),
					'reason' => $this->input->post('reason'),

					'single' => '1',
					'multiple' => '0',
					'date'=>date('Y-m-d'),
					'status'=>"pending",
					'image' => $imgp


			);
      $this->db->insert('leave_application',$data);
      redirect(base_url() . 'index.php/user/leave_application','refresh');
			}

  }
  elseif($param1=="apply_multiple"){

	  $config['upload_path']='./upload/leave_application/';
			$config['allowed_types']='jpg|png|gif|pdf';
			$config['max_size']=2048;
			$config['encrypt_name']=TRUE;
			$this->load->library('upload',$config);
			if(! $this->upload->do_upload('image')){
				echo "fail";
				}
			else{
			  $data=array('image'=>$this->upload->data());
				$file_name=$data["image"]["file_name"];
				$image_path='upload/leave_application/';
				$imgp=base_url().$image_path.($file_name);
				//$a=$this->input->post('sub');
				//$sub=$this->db->get_where('sub_category',array('name'=>$a))->row()->id;
				$data = array(
					'user_id' => $this->input->post('id1'),
					'from' => $this->input->post('date1'),
					'to' => $this->input->post('date2'),
					'reason' => $this->input->post('reason'),

					'single' => '0',
					'multiple' => '1',
					'date'=>date('Y-m-d'),
					'status'=>"pending",
					'image' => $imgp


			);
      $this->db->insert('leave_application',$data);
      redirect(base_url() . 'index.php/user/leave_application','refresh');
			}


  }
  }
}

/*************************manage profile *****************************/
public function manage_profile($param1='',$param2='')
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/user/index','refresh');
  }
  else{
  if($param1 == ''){
    $uid=$this->session->userdata('user_id');
    $page_data['profile'] = $this->crud_model->profile_view($uid);
    $this->load->view('admin/user/profile',$page_data);
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
      redirect(base_url().'index.php/user/manage_profile','refresh');
    }
    else{
      $page_data['profile'] = $this->crud_model->profile_view();
      $page_data['msg'] = "The old password you entered is incorrect";
      $this->load->view('admin/user/profile',$page_data);
    }
  }

  }
}


/*************************manage profile *****************************/
public function daily_activity($param1='',$param2='')
{
  if($this->session->userdata('user_type') == ""){
    redirect(base_url() . 'index.php/user/index','refresh');
  }
  else{
  if($param1 == ''){
    $uid=$this->session->userdata('user_id');
    $page_data['activity'] = $this->crud_model->activity($uid);
    $this->load->view('admin/user/daily_activity',$page_data);
  }
  elseif($param1 == 'do_add'){
	  $data['notes']=$this->input->post('note');
	  $data['user_id']=$this->session->userdata('user_id');
	  $this->db->insert('daily_activity',$data);
	  redirect(base_url().'index.php/user/daily_activity','refresh');
	  
  }
  elseif($param1 == 'edit') {
      $page_data['activity'] =  $this->db->get_where('daily_activity', array('id' => $param2))->result_array();
      $this->load->view('admin/user/edit_activity',$page_data);
       
    }
	
	 elseif($param1 == 'update') {
		  $data['notes']=$this->input->post('note');
		  $this->db->where('id',$param2);
		  $this->db->update('daily_activity',$data);
        redirect(base_url().'index.php/user/daily_activity','refresh');
       
    }
	elseif($param1=="del_view"){
      $id=$this->input->post('id1');

      $this->db->where('id',$id);
      $this->db->delete('daily_activity');
      redirect(base_url().'index.php/user/daily_activity','refresh');

  }
  }
}


}
