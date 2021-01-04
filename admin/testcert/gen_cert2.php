<?php
require('../connection.php');
require('../functions.php');
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select cert.*,courses.name from cert, courses where cert.course=courses.id and cert.id='$id'");
	header('content-type:image/jpeg');
	$font=realpath('Gotham-Black.otf');
	$font2=realpath('vtks ragwaris.ttf');
	$font3=realpath('ARLRDBD.ttf');
	$image=imagecreatefromjpeg("ecert.jpg");
	$color=imagecolorallocate($image,63, 191, 191);
	while($row=mysqli_fetch_array($res)){
		$email=$row[3];
		$name=$row[2];
		imagettftext($image,36,0,80,330,$color,$font2,$name);
		$course=$row[8];
		imagettftext($image,28,0,80,460,$color,$font,$course);
		$date=date('d F, Y');
		imagettftext($image,20,0,80,590,$color,$font3,$date);
		$instructor=$row[6];
		imagettftext($image,20,0,257,693,$color,$font3,$instructor);
		$file=time();
		$file_path="certificate/".$file.".jpg";
		$file_path_pdf="certificate/".$file.".pdf";
		imagejpeg($image,$file_path);
		imagedestroy($image);
		
		require('fpdf.php');
		$pdf=new FPDF();
		$pdf->AddPage('L');
		$pdf->Image($file_path,10,10,280,200);
		$pdf->Output($file_path_pdf,"F");
		
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
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->Subject="Certificate Generated";
		$mail->Body="Certificate for $course course generated";
		$mail->addAttachment($file_path_pdf);
		$mail->SMTPOptions=array("ssl"=>array(
			"verify_peer"=>false,
			"verify_peer_name"=>false,
			"allow_self_signed"=>false,
		));
		if($mail->send()){
			echo '<script>alert("Email sent")</script>';
			header('location:../certificate.php');
			mysqli_query($con,"update cert set status='1' where id='$id'");
		}else{
			echo $mail->ErrorInfo;
		}
	}
		//mysqli_query($con, "update status set status=1 where idcert='".$row['idcert']."'");
	
?>