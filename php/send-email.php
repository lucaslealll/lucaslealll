<?php

// Replace this with your own email address
$to = '_____';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_POST) {
   $name = trim(stripslashes($_POST['name']));
   $email = trim(stripslashes($_POST['email']));
   $subject = "Contact Form Submission"; // Define a default subject
   $contact_message = trim(stripslashes($_POST['message']));

   // Set Message
   $message = "";
   $message .= "Email from: " . htmlspecialchars($name) . "<br />";
   $message .= "Email address: " . htmlspecialchars($email) . "<br />";
   $message .= "Message: <br />";
   $message .= nl2br(htmlspecialchars($contact_message));
   $message .= "<br /> ----- <br /> This email was sent from your site " . url() . " contact form. <br />";

   // Set From: header
   $from = "no-reply@" . $_SERVER['SERVER_NAME']; // Use a generic sender address

   // Email Headers
   $headers = "From: " . $from . "\r\n";
   $headers .= "Reply-To: ". htmlspecialchars($email) . "\r\n";
   $headers .= "MIME-Version: 1.0\r\n";
   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   // Send mail
   $mail = mail($to, $subject, $message, $headers);

   if ($mail) {
       echo "OK";
   } else {
       echo "Something went wrong. Please try again.";
   }
}

?>
