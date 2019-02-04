<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - GMail SMTP test</title>
</head>
<body>
<?php

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//require 'PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
//$mail->SMTPAuth = false;
$mail->SMTPSecure = false;
//S/et the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//$mail->Host = $smtp_name;
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication

//Username to use for SMTP authentication
$mail->Username = "sm.fathalla@gmail.com";
// $mail->Username = 'bhattacharya.kushal45@yahoo.com';
//Password to use for SMTP authentication
$mail->Password = 'nourinSaid167';
//Set who the message is to be sent from
$mail->setFrom("sm.fathalla@gmail.com", 'said fathalla');
//Set an alternative reply-to address
$mail->addReplyTo('sm.fathalla@gmail.com', 'Kus_gmail');
//Set who the message is to be sent to
$mail->addAddress('sm.fathalla@gmail.com', 'Kus_bhatt');
//Set the subject line
$mail->Subject = 'dddd';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), dirname(FILE));
//Replace the plain text body with one created manually
// $mail->AltBody = $body;
//Attach an image file
$body  = "<h1>hello, world!</h1>";
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->MsgHTML($body);
// $mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
echo 'Message sent!';
}

?>
</body>
</html>