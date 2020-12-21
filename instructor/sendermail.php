<?php

$to_email='nishajeg27@gmail.com';
$subject='Test subject heading';
$body='Test body of an email';
$headers='From: vesha2797@gmail.com';


// Send email
if(mail($to_email, $subject, $body, $headers)){
	echo "Email sucessfully sent to $to_email..";
}else{
	echo "Email sending failed...";
}

?>