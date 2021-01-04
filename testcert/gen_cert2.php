<?php
require('../connection.php');
$res=mysqli_query($con, "select * from cert where status=0 limit 1");
if(mysqli_num_rows($res)>0){
	header('content-type:image/jpeg');
	$font=realpath('Gotham-Black.otf');
	$font2=realpath('vtks ragwaris.ttf');
	$font3=realpath('ARLRDBD.ttf');
	$image=imagecreatefromjpeg("ecert.jpg");
	$color=imagecolorallocate($image,234,124,65);
	while($row=mysqli_fetch_assoc($res)){
		$name=$row['name'];
		imagettftext($image,35,0,85,370,$color,$font,$name);
		$course=$row['course'];
		imagettftext($image,38,0,85,510,$color,$font2,$course);
		$date=date('d F, Y');
		imagettftext($image,20,0,85,625,$color,$font3,$date);
		$instructor=$row['instructor'];
		imagettftext($image,21,0,330,678,$color,$font3,$instructor);
		imagejpeg($image);
		imagedestroy($image);
		mysqli_query($con, "update status set status=1 where idcert='".$row['idcert']."'");
	}
}
	
?>