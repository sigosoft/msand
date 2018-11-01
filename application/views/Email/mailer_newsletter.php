<?php
$title=$subject;
$subject ="---------:NEWS LETTER";
$headers = "From: shyamily@ridhitechindia.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= 'Cc:'.$users . "\r\n";
$to=$subscribers;
//$to=$users;
$message =<<<EOT



<table style="width: 100%">
	<tr><td><img src="http://bikashbabusweets.com/asset/logo.png"></td>
		<td style="text-align: right;font-family: sans-serif;">
			<font size="4" style="font-weight: 800;"></font><br/>
			<br/>

			</br>
		</td>
	</tr>
</table>
<br/>
<center><hr style="width: 97%;border: 1px solid #dd2248;"/></center>
<br/>
<center>
	<table style="width: 80%">
		<tr><th>$title <b></b><br/><br/></th></tr>
		<tr><td>$text<br/>
                </td></tr>
		<tr><td>Our outlets address are as below <br/>
<ol>
				<li><a href="https://www.google.co.in/maps/place/Bikash+Babu+Sweets+Kadavanthara/@9.979058,76.2944698,17z/data=!3m1!4b1!4m5!3m4!1s0x3b080d35d6c38291:0xb41dbbb0af85a769!8m2!3d9.979058!4d76.2966585" target="_blank">Bikash Babu Sweets, Kadavanthara.</a></li>
				<li><a href="https://www.google.co.in/maps/place/BIKASH+BABU+SWEETS+DH+ROAD/@9.9677447,76.2805046,17z/data=!3m1!4b1!4m5!3m4!1s0x3b0872b1ffd0a7f3:0x5a9ba84328936af8!8m2!3d9.9677447!4d76.2826933" target="_blank">Bikash Babu Sweets, Durbar Hall</a></li>
				<li><a href="https://www.google.co.in/maps/place/BikashBabu+Sweets/@9.963231,76.2914845,17z/data=!3m1!4b1!4m5!3m4!1s0x3b0872b7fa28d851:0xe3abeb67cf4408c2!8m2!3d9.963231!4d76.2936732" target="_blank">Bikash Babu Sweets, Panampilly Nagar</a></li>
				<li><a href="https://www.google.co.in/maps/place/Bikash+Babu+Sweets/@9.9981059,76.3056074,17z/data=!3m1!4b1!4m5!3m4!1s0x3b080d18456d48c3:0x9ab59eed795b750e!8m2!3d9.9981059!4d76.3077961" target="_blank">Bikash babu sweets, Palarivattom</a></li>
				<li><a href="https://www.google.co.in/maps/dir/''/Bikash+Babu+Sweets+Kakkanad/@10.0168374,76.2752222,12z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x3b080c8bcb57652d:0xdbc617b42a75d28f!2m2!1d76.3452628!2d10.0168447" target="_blank">Bikash babu sweets, Kakkanad</a></li>
			</ol>
<br/>
<br/>
<br/>
			Should you have <br/>
			any query,  please call us at 9847120763,9895400815 <br/><br/>
			Please stay connected for more exciting offers &  updates. <br/><br/>
			Thank & Sweet Regards,<br/><br/>Team- Bikash Babu Sweets.</td></tr>
	</table>
</center>
<br/>

<center><hr style="width: 97%;border: 1px solid #dd2248;"/></center>
<br/>
<br/>

EOT;


mail($to, $subject, $message, $headers);

header('Location:http://localhost/cakes/index.php/main_admin/subscription');
die();
?><?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 27-11-2017
 * Time: 12:45
 */
