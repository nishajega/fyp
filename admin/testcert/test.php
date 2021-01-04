<?php
require('fpdf.php');
$pdf=new FPDF();
$pdf->AddPage('L');
$pdf->Image("ecert.jpg",10,10,280,200);
$pdf->Output();

include('smtp/PHPMailerAutoload.php');
$mail=new PHPMailer();
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPSecure="tls";
$mail->SMTPAuth=true;
$mail->Username="vesha2797@gmail.com";
$mail->Password="Veshadoll2712";
$mail->setFrom("vesha2797@gmail.com");
$mail->addAddress("vesha2797@gmail.com");
$mail->isHTML(true);
$mail->Subjet="Certificate Generated";
$mail->Body="Certificate Generated";
$mail->addAttachment("certificate/1609608480.pdf");
$mail->SMTPOptions=array("ssl"=>array(
    "verify_peer"=>false,
    "verify_peer_name"=>false,
    "allow_self_signed"=>false,
));
if($mail->send()){
    echo "Send";
}else{
    echo $mail->ErrorInfo;
}
?>
