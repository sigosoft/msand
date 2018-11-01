<?php
$login_id=$loginid;
//$ci->load->Model('Crud_model','crud');
//$ser_table=$ci->crud->get_temp_purchase_report($login_id);



//$Totalsum=$this->crud->sumtempreport($login_id);
$ser_table=$this->db->get_where('customer_temp_products',array('login_id'=>$login_id))->result_array();

//print_r($ser_table);
if($ser_table > 0)
{
 ?>
<table id="myTable1" class="table order-list table-bordered">
<thead>
<th>No</th>
<th>Product</th>
<th>Price</th>
<th>Action</th>
</thead>
    <tbody>
<?php
$i=0;
foreach($ser_table as $stable)
{
	$i++;
?>
        <tr>
		<td><?php echo $i; ?></td>

            <td >
              <?php $n = $this->db->get_where('product',array('id'=>$stable['customer_temp_products_name']))->row()->name; ?>
		            <input type="text" class="form-control"  value="<?php echo $n;?>" disabled/>
            </td>

            <td>
                <input type="text"  class="form-control" value="<?php echo $stable['price'];?>" disabled/>
                <input type="hidden"  class="form-control" value="<?php echo $stable['login_id'];?>" disabled/>
            </td>



            <td >
              <input type="button" class="btn btn-md btn-danger "  value="Delete" onclick="deletecustomer_products(<?php echo $stable['customer_temp_products_id'];?>);">
            </td>
        </tr>
<?php } ?>
    </tbody>

</table>
<?php }

else
{
echo $login_id;
}
?>
