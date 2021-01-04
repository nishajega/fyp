<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'connection.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $enquiry = mysqli_real_escape_string($con, $_POST['enquiry']);

    mysqli_query($con, "INSERT INTO enquiry_us(name,email,phone,enquiry) VALUES('$name','$email','$phone','$enquiry')");



    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "vesha2797@gmail.com";
    $mail->Password   = "Veshadoll2712";
    $mail->IsHTML(true);
    $mail->AddAddress("vesha2797@gmail.com", "test");
    $mail->SetFrom($email);
    $mail->AddReplyTo($email);
    //$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
    $mail->Subject = "Enquiry";
    $content = "<table><tr><td>Name:</td><td>$name</td></tr><tr><td>Email:</td><td>$email</td></tr>
    <tr><td>Phone No.:</td><td>$phone</td></tr><tr><td>Enquiry:</td><td>$enquiry</td></tr></table>";

    $mail->MsgHTML($content);
    if (!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
    } else {
        echo '<script>alert("Enquiry sent successfully! Plaese kindly wait for the reply from BDD.")</script>';
        header('Location: index.php');
    }
}
?>
