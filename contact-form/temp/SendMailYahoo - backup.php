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

$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'ssl://smtp.bizmail.yahoo.com';
//$mail->Host = 'smtp.bizmail.yahoo.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465; //995 and 465 port tried but not working

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'ssl';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//$mail->SMTPAuth = false;
$mail->SMTPSecure = false;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "sm.fathalla";

//Password to use for SMTP authentication
$mail->Password = "SPARQL-AGpass";

//Set who the message is to be sent from
$mail->setFrom('sm.fathalla@yahoo.com', 'sender_name');


//Set who the message is to be sent to
$mail->addAddress('sm.fathalla@yahoo.com', 'receiver_name');

//Set the subject line
$mail->Subject = 'PHPMailer YMail SMTP test';


$body  = "<h1>test email from yahoo</h1>";

$mail->Subject    = "PHPMailer Test yahoo";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

//$mail->msgHTML(file_get_contents('phpmailer/examples/contents.html'), dirname(__FILE__));

$mail->AltBody = 'This is a plain-text message body';

//$mail->addAttachment('phpmailer/examples/images/phpmailer_mini.png');
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>
</body>
</html>