<?php
class Crud_model extends CI_Model {

		function login($user,$pass)
		{


		}

		public function user_view()
		{
			$this->db->order_by('id','desc');
			return $this->db->get('customer')->result_array();
		}

		public function user_delete($id)
		{
			$this->db->where('id', $id);
      $this->db->delete('customer');
			return true;
		}

		public function user_add($data)
		{
			$this->db->insert('login', $data);
			$insert_id = $this->db->insert_id();

			return true;
		}

		public function user_update($data,$id)
		{
			$this->db->where('id',$id);
			$this->db->update('customer', $data);
			return true;
		}

		public function add_user($data)
		{
			$this->db->insert('user', $data);
			return true;
		}
	////////////////////////////////////////////////////////////////////////
	public function product_view()
	{
		$res = $this->db->get('product')->result_array();
		return $res;
	}

	public function product_view_edit($id)
	{
		$res = $this->db->get_where('product',array('id'=>$id))->result_array();
		return $res;
	}
		//////////////////////////////////////////////////////////////////////////

		public function vehicle_view()
		{
			$res = $this->db->get('vehicle')->result_array();
			return $res;
		}

		public function vehicle_view_edit($id)
		{
			$res = $this->db->get_where('vehicle',array('vehicle_id'=>$id))->result_array();
			return $res;
		}
		//////////////////////////////////////////////////////////////////////////

		public function material_view()
		{
			$res = $this->db->get('raw_material')->result_array();
			return $res;
		}

		public function material_view_edit($id)
		{
			$res = $this->db->get_where('raw_material',array('raw_material_id'=>$id))->result_array();
			return $res;
		}
		//////////////////////////////////////////////////////////////////////////

		public function vendor_view()
		{
			$this->db->order_by('vendor_id','desc');
			return $this->db->get('vendor')->result_array();

		}

		public function vendor_edit($id)
		{
			$res = $this->db->get_where('raw_material',array('raw_material_id'=>$id))->result_array();
			return $res;
		}
		//////////////////////////////////////////////////////////////////////////

		public function customer_view()
		{
			$this->db->order_by('id','desc');
			return $this->db->get('customer')->result_array();

		}

		public function customer_edit($id)
		{
			$res = $this->db->get_where('customer',array('id'=>$id))->result_array();
			return $res;
		}
		//////////////////////////////////////////////////////////////////////////

		public function cate_view()
		{
			$res = $this->db->get('expense_category')->result_array();
			return $res;
		}

		public function cate_view_edit($id)
		{
			$res = $this->db->get_where('expense_category',array('exp_catid'=>$id))->result_array();
			return $res;
		}
		//////////////////////////////////////////////////////////////////////////

		public function expense_view()
		{
			//$res = $this->db->get('expense')->result_array();
			//return $res;
			$d=date('Y-m-d');
			$this->db->order_by('expense_id','desc');
			return $this->db->get_where('expense',array('date'=>$d))->result_array();
		}

		public function expense_view_edit($id)
		{
			$res = $this->db->get_where('expense',array('expense_id'=>$id))->result_array();
			return $res;
		}
		//////////////////////////////////////////////////////////////////////////
		//---------------------------------------
		public function get_temp_purchase_report($logid)

			{

			$res=$this->db->get_where('vendor_temp_products',array('login_id'=>$logid));
			return $res->result_array();
			}
			//---------------------------------------
			function sumtempreport($logid)

					{

						$this->db->select_sum('total');
						$res=$this->db->get_where('vendor_temp_products',array("login_id"=>$logid));
						$data= $res->row();
						return $data->total;
					}
		public function logout()
	{
		$this->session->unset_userdata('user_login');
		$this->session->unset_userdata('user_type');
		$this->session->unset_userdata('login_id');
		$this->session->unset_userdata('offer');
		$this->session->unset_userdata('offer1');
		$this->session->unset_userdata('customer');
		$this->session->unset_userdata('product');
		return true;
	}
	////////////////////////////////////////////////////////////////////////



}
?>
