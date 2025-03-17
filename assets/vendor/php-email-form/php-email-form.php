<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];


$to = 'foodiyo123@gmail.com'; 
$headers = "From: $name <$email>";
$body = "Subject: $subject\n\n$message";


if (mail($to, $subject, $body, $headers)) {
  echo "Email sent successfully!";
} else {
  echo "Failed to send email.";
}
?>
