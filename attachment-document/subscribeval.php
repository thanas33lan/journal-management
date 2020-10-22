<?php
include('connect.php');
if($_POST["email"]!=''){
$sub_name=$_POST["name"];
	$sub_mail=$_POST["email"];
	$sub_services=$_POST["servicesID"];
	$customer_code=$_POST["customerCode"];
	$servicesName=$_POST["servicesName"];
	$countVal=count($sub_services);

		
	for($i=0;$i<$countVal;$i++)
    {

		$serviceVal=$sub_services[$i];
		$addon=date("Y-m-d h:i:s");

		$sql = "INSERT INTO customer_subscribe (sub_name, sub_mail, sub_services, sub_code, status, add_on)
		VALUES ('".$sub_name."','".$sub_mail."','".$serviceVal."','".$customer_code."','active', now())";
		if ($conn->query($sql) === TRUE) {
		  $meaasge= "Thank you for subscribing.";

		
		//mail
		date_default_timezone_set('Asia/Kolkata');
		require 'mail/PHPMailerAutoload.php';
		require 'config/config.php';
		
		echo $toEmail;
		echo $password;
		//Create a new PHPMailer instance
		$mail = new PHPMailer();
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = $toEmail;
		//Password to use for SMTP authentication
		$mail->Password = $password;
		//Set who the message is to be sent from
		$mail->setFrom($toEmail, $sub_name);
		$mail->addAddress($sub_mail, 'Zfmail');
		//Set the subject line
		$mail->Subject = 'Thank you for subscribing';
		
		//Replace the plain text body with one created manually
		$message="Dear ".$sub_name." , <br/><br/>";
		$message.="Thank your for subscribeing services -".$servicesName."<br/><br/>";
		$message.="Thanks and Regards - <br />";
		$mail->msgHTML($message);
		
		
		//send the message, check for errors
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		 //end mail

		
		} else {
			$meaasge= "Error: " . $sql . "<br>" . $conn->error;
		}
		
	
	}	
}
$conn->close();

echo "<script>
alert('$meaasge');
window.location.href='subscriber.php';
</script>";
	

?>