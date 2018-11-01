<?php
class Front_model extends CI_Model {

  public function featured_products()
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('featured','yes');
    $this->db->limit(8);
    $res=$this->db->get()->result_array();
    return $res;
  }

  public function all_products(){
      $this->db->select('*');
      $this->db->from('product');
      $this->db->order_by('id');
      $this->db->limit(12);
      $res=$this->db->get()->result_array();
      return $res;
  }

  public function view_category(){
    $res=$this->db->get_where('category')->result_array();
    return $res;
  }

  public function products_by_category($cat_id){
    //$cate_name=$this->db->get_where('category',array('id'=>$cat_id))->row()->name;
    $res=$this->db->get_where('product',array('category'=>$cat_id))->result_array();
    return $res;
  }

  public function all_products_pagination1($a){
      $sql="SELECT * FROM product ORDER BY id limit $a,12";
      $query = $this->db->query($sql);
      $res= $query->result_array();
      //$res=$this->db->get()->result_array();
      return $res;

  }

  public function all_products_pagination($a,$next){
      $p=$this->session->userdata('page');

      $sql="SELECT * FROM product  ORDER BY id limit $a,12";
      $query = $this->db->query($sql);
      $res= $query->result_array();
      //$res=$this->db->get()->result_array();
      return $res;

  }
  public function get_products_count()
  {
    $this->db->from('product');
    $query = $this->db->get();
    $rowcount = $query->num_rows();
    $count = ceil($rowcount/12);
    return $count;
  }

  function get_product_details_sale($sale_code)
      {
          $sale = $this->db->get_where('orders', array('sale_code' => $sale_code))->row();
          return json_decode($sale->product_details, true);
      }

  public function my_account_info()
          {
              $res = $this->db->get_where('user', array('login_id' => $this->session->userdata('login_id')))->result_array();
              return $res;
          }
  function edit_profile($data,$uid)
    {
      $this->db->where('user_id',$uid);
      $this->db->update('user',$data);
    }

function sort1(){
$this->db->select('*');
$this->db->from('product');
$this->db->order_by('price','asc');
$res=$this->db->get()->result_array();
return $res;
	}
function sort2(){
  $this->db->select('*');
  $this->db->from('product');
  $this->db->order_by('price','desc');
  $res=$this->db->get()->result_array();
  return $res;
	}
public function total_purchased($id){
  $this->db->select_sum('grand_total');
	$res=$this->db->get_where('orders',array('buyer'=>$id));
	$data= $res->row();
	return $data->grand_total;
}

public function count_orders(){
  $this->db->select_count('date');
  //$this->db->where('',);
	$res=$this->db->get_where('orders',array('date'=>date()));
	$data= $res->row();
	return $data->date;
}

public function todays_sale(){
  $today=date('Y-m-d');
  $this->db->select_sum('grand_total');
	$res=$this->db->get_where('orders',array('date'=>$today));
	$data= $res->row();
	return $data->grand_total;
}

public function my_offer_info()
  {
  $res = $this->db->get_where('customer', array('name' => $this->session->userdata('login_id')))->result_array();
  return $res;
  }

}
?>
