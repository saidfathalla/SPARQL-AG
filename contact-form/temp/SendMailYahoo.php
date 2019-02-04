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


 if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }
     
    if(isset($_POST['email_title'])) {
        $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
    }
     
      
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
    }
     

//Set who the message is to be sent from
$mail->setFrom('sm.fathalla@yahoo.com', $visitor_name);


//Set who the message is to be sent to
$mail->addAddress('sm_fathalla@yahoo.com', $visitor_name);

//Set the subject line
$mail->Subject = 'PHPMailer YMail SMTP test';


$body  = "<h2>SPARQL-AG contact form</h2>"
        ." <table width='70%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='11%'><strong>From</strong>:</td>
    <td width='89%'>".$visitor_email."</td>
  </tr>
  <tr>
    <td><strong>Name</strong>:</td>
    <td>".$visitor_name."</td>
  </tr>
  <tr>
    <td><strong>Subject</strong></td>
    <td>".$email_title."</td>
  </tr>
  <tr>
    <td><strong>Message</strong></td>
    <td>".$visitor_message."</td>
  </tr>
</table>"
 
          ;

$mail->Subject    = "SPARQL-AG contact form";

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