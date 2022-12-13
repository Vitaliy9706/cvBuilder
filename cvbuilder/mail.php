<?php
if(isset($_POST['submit'])){
    include('config/db.php');

    $userEmail = mysqli_real_escape_string($connection,strip_tags($_POST['email']));

    $sql = "SELECT * FROM users WHERE email='$userEmail'";

    $userFound = mysqli_query($connection,$sql);

    if($userFound){

        if(mysqli_num_rows($userFound) > 0){
            $code = rand(999999, 111111);
            $update = "UPDATE users SET code = '$code' WHERE email = '$userEmail'";
            $updateResult = mysqli_query($connection,$update);
        }
    }

}
//ryzzyexvrugtxqpk//
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/

//Include required PHPMailer files
	require 'phpmailer/PHPMailer.php';
	require 'phpmailer/SMTP.php';
	require 'phpmailer/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "vitalya0602@gmail.com";
//Set gmail password
	$mail->Password = "ryzzyexvrugtxqpk";
//Email subject
	$mail->Subject = "Test email using PHPMailer";
//Set sender email
	$mail->setFrom('vitalya0602@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	$mail->addAttachment('img/attachment.png');
//Email body
	$mail->Body = "<p>Your OTP code is: $code</p>";
//Add recipient
	$mail->addAddress($userEmail);
//Finally send email
	if ( $mail->send() ) {
		echo "Email Sent..!";
	}else{
		echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
	}
//Closing smtp connection
	$mail->smtpClose();
?>