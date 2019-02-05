<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style type="text/css">
<!--
.style5 {color: #CC0000}
-->
</style>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>SPARQL-AG</title>
        <style>
		/* syle the page*/
		* {
  box-sizing: border-box;
}


/* Style the header */
.header {
  background-color: #f1f1f1;
  background-image: url("https://codyburleson.com/wp-content/uploads/2018/07/sparql-sql-for-sem-web-0.png");
   background-repeat: no-repeat;
    background-size: 120px 120px;
  padding: 20px;
  text-align: center;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
}

/* Left and right column */
.column.side {
  width: 10%;
}

/* Middle column */
.column.middle {
  width: 78%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column.side, .column.middle {
    width: 100%;
  }
}
		
		
		
            .error {color: #FF0000;}
            .style2 {  font-style: italic; }
			
/*			input[type=text], input[type=date], select {
  background-color: #3CBC8D;
  color: white;
   width: 10%;
}*/
 

textarea:focus {
  width: 95%;
}			
textarea{
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
			input[type=submit], button {
  width: 10%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover, button:hover {
  background-color: #45a049;
  font-weight:bold
}
        .style3 {
	font-size: large;
	font-weight: bold;
}
        .style4 {font-size: large}
        </style>

 
</head>


    <body>
        
	<div class="header">
	  <h1>SPARQL-AG service</h1>
      <p>A SPARQL auto-generation service for  EVENTSKG SPARQL endpoint </p>
  </div>

    <div class="topnav">
	 <a href="http://kddste.sda.tech/SER-Service/SPARQL-AG/SPARQL-AG.php">Home </a>
   <a href="http://kddste.sda.tech/EVENTSKG-Dataset/EVENTSKG_R2.html">EVENTSKG </a>
  <a href="https://github.com/saidfathalla/SPARQL-AG/issues/new/choose">Issue Tracker</a>
  <a href="http://kddste.sda.tech/sparql">SPARQL endpoint</a>
  <a href="#">Live Demo</a>
  <a href="http://kddste.sda.tech/SER-Service/SPARQL-AG/contact-form/contactUsForm.php">Contact Us</a>

  </div>
<div class="row">
  <div class="column side">
    <h2>&nbsp;</h2>
    <p>&nbsp;</p>
  </div>


       
		
<div class="column middle">
        <form action="<?php session_start(); echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return checkForm(this);">


            <table width="60%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Name</td>
                <td><span class="elem-group">
                  <input name="visitor_name" type="text" id="name" placeholder="John Doe" pattern=[A-Z\sa-z]{3,20} required class="form-control" />
                </span></td>
              </tr>
              <tr>
                <td><span class="elem-group">E-mail</span></td>
                <td><span class="elem-group">
                  <input name="visitor_email" type="email" id="email" placeholder="john.doe@email.com" required class="form-control" />
                </span></td>
              </tr>
              <tr>
                <td><span class="elem-group">Subject</span></td>
                <td><span class="elem-group">
                  <input name="email_title" type="text" id="title" required placeholder="Suggest a query" pattern=[A-Za-z0-9\s]{8,60} class="form-control"/>
                </span></td>
              </tr>
              <tr>
                <td><span class="elem-group">
                  <label for="label">Message&nbsp; </label>
                </span></td>
                <td><span class="elem-group">
                  <textarea name="visitor_message" cols="150" rows="10" class="form-control" id="message" placeholder="Suggest a query, report a bug or request a feature." required ></textarea>
                </span></td>
              </tr>
              <tr>
                <td colspan="2">
                  <div align="center">
                      <p><p><img src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
<p><input type="text" size="6" maxlength="5" name="captcha" value=""><br>
<small>Copy the digits from the image into this box</small></p></p>
                      
                     
                      
                  </div>
                  
                </td>
              </tr>
                <tr>
                <td colspan="2">
                  <div align="center"><input type="submit" name="Send" value="Send"  />
                  </div>
                  
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    <div align='center'><strong>
                  <?php
                     // session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
 
 if(isset($_POST['Send'])){ 
//require 'PHPMailerAutoload.php';
if($_POST['captcha'] != $_SESSION['digit']) {
    echo ("The CAPTCHA code entered was incorrect!");
    session_destroy();
    exit(0);
}
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
    <td><p></p></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
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
         echo " "; 

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo " Message sent successfully. ";
}
//		 echo "<</div>";

}
?>
                                                       </div>
 </div>
                  
                </td>
              </tr>  
          </table>
	</form>
            <p>&nbsp;</p>

  </div>
  <div class="column side">
    <h2>&nbsp;</h2>
  </div>
	</div>
<script type="text/javascript">

  function checkForm(form)
  {
    ...

    if(!form.captcha.value.match(/^\d{5}$/)) {
      alert('Please enter the CAPTCHA digits in the box provided');
      form.captcha.focus();
      return false;
    }

    ...

    return true;
  }

</script>
</body>
  </html>
