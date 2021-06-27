<?php

$to_email='email';
$subject='Test subject heading';
$body='Test body of an email';
$headers='From: email';


// Send email
if(mail($to_email, $subject, $body, $headers)){
	echo "Email sucessfully sent to $to_email..";
}else{
	echo "Email sending failed...";
}

?>
