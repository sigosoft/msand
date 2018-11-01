<?php

$ans=json_decode($_GET["ans"]);
$ans1= $ans->ans1;
$subject ="COMMENTS";
$headers = "From: mailer@bikashbabusweets.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$to="shyamily@ridhitechindia.com";

$message =<<<EOT



<table style="width: 100%">
	<tr><td><img src="http://bikashbabusweets.com/asset/logo.png"></td>
		<td style="text-align: right;font-family: sans-serif;">
			<font size="4" style="font-weight: 800;"></font><br/>
			<br/>
			
			<b>
				
			</b>
			</br>
		</td>
	</tr>
</table>
<br/>
<center><hr style="width: 97%;border: 1px solid #dd2248;"/></center>
<br/>
<center>
	<table style="width: 80%">
		<!--<tr><td>Dear Mr/Mrs. <b>$name</b>,<br/><br/></td></tr>-->
		<tr>
                <h4><b>Message from customer</b></h4><br/></td></tr>
	<table style="width:100%">


	<tr style="background-color: rgb(187, 181, 181);text-align: right;">
		<th colspan="4">Name:</th>
		<td>$name</td>
	</tr>
	<tr style="background-color: rgb(187, 181, 181);text-align: right;">
		<th colspan="4">Email:</th>
		<td>$email</td>
	</tr>
	<tr style="background-color: rgb(187, 181, 181);text-align: right;">
		<th colspan="4">Phone:</th>
		<td>$mobile</td>
	</tr>
		<tr style="background-color: rgb(187, 181, 181);text-align: right;">
		<th colspan="4">Message:</th>
		<td>$message</td>
	</tr>
	
</table>
	</table>
</center>
<br/>

<center><hr style="width: 97%;border: 1px solid #dd2248;"/></center>
<br/>
<br/>

EOT;


mail($to, $subject, $message, $headers);
//header('Location: http://ridhibiz.com/demo/bbs/login/index.php/cart/destroy');

header('Location: http://ridhibiz.com/demo/bbs');
die();
?>