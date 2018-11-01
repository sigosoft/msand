<?php

$ans=json_decode($product_details);
foreach($ans as $itms){
$ans1=$items['name'];
}

$subject ="Order Confirmation";
$headers = "From: shyamily@ridhitechindia.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$to=$email;

//$gst=(5/100)*$total;
$grand=round($grand_total,2);
$this->load->model('Front_model');
$carted = $this->Front_model->get_product_details_sale($sale_code);
    $ii=0;
    foreach ($carted as $row) { $ii+=1;
            //$sale_code=$row['sale_code'];
            //$total += $row['subtotal'];
            $dat .= '<tr style="background-color: azure;text-align: center;">
                    <td>' . $ii . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['qty'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>' . $row['subtotal'] . '</td>
                    ';
        }
$message =<<<EOT



<table style="width: 100%">
	<tr><td><img src="http://localhost/cakes/images/logo.png"></td>
		<td style="text-align: right;font-family: sans-serif;">
			<font size="4" style="font-weight: 800;"></font><br/>
			<br/>

			<b>
			Order Id:$sale_code
			</b>
			</br>
		</td>
	</tr>
</table>
<br/>
<center><hr style="width: 97%;border: 1px solid #dd2248;"/>

</center>
<br/>
<center>
	<table style="width: 80%">
		<tr><td>Dear Mr/Mrs. <b>$user_name</b><br/><br/></td></tr>
		<tr>
                <td><h4><center><b>Your Order Has Been Succesfully Placed.</b></center></h4></td></tr>

                <table style="width: 80%">
		<tr><td>Your booking details are as below:</td></tr>
	</table>
</center>
<br/>
<table style="width:100%">
	<tr style="background-color: #D3D3D3">
		<th>#</th>
		<th>Items</th>
		<th>Quantity</th>
		<th>Unit Price(₹)</th>
		<th>Total(₹)</th>

	</tr>

	$dat
	<tr style="background-color: rgb(187, 181, 181);text-align: right;">
		<th colspan="4">Sub Total:</th>
		<td>$total</td>
	</tr>
	<tr style="background-color: rgb(187, 181, 181);text-align: right;">
		<th colspan="4">GST:</th>
		<td>$gst</td>
	</tr>
	<tr style="background-color: rgb(187, 181, 181);text-align: right;">
		<th colspan="4">Grand Total:</th>
		<td>$grandtotal</td>
	</tr>

</table>


		<tr><td>Our outlets address are as below <br/>
<ol>

			</ol>
<br/>
<br/>
<br/>
			</td></tr>

</center>
<br/>

<center><hr style="width: 97%;border: 1px solid #dd2248;"/></center>
<br/>
<br/>

EOT;


mail($to, $subject, $message, $headers);
//$this->session->unset_userdata('pay');
redirect(base_url("index.php/cart/destroy"));

//header('Location: http://localhost/cakes/bbs/login/index.php/cart/destroy');

//header('Location: http://ridhibiz.com/demo/bbs/login/');
die();
?>
