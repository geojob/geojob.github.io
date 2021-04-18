<?php
include_once('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
include_once('../vendor/phpmailer/phpmailer/src/SMTP.php');
include_once('../vendor/phpmailer/phpmailer/src/Exception.php');

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SetFrom('noreply@{domain}.com','User');

//Check for empty fields
if(empty($_POST['name']) ||
empty($_POST['email']) ||
empty($_POST['phone']) |
empty($_POST['message']) ||
!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
echo "No arguments Provided!";
return false;
}

//Create the email and send the message
$host = "mail.{domain}.com";
$port = "587";/
$username = "noreply@{domain}.com";
$password = "{password}";

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = "jbgeorge98@yahoo.com"; // Add your email address in between the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
$subject = "Website Contact Form:  $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
$header = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$header .= "Reply-To: $email";	

if(!mail($to, $subject, $body, $header))
  http_response_code(500);
?>
