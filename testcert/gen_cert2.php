<?php
require('../connection.php');
$sql="select courses.*, invoice.* from courses, invoice where courses.name=invoice.item order by invoice.id desc";
$res=mysqli_query($con, $sql);

	header('content-type:image/jpeg');
	$font=realpath('Gotham-Black.otf');
	$font2=realpath('vtks ragwaris.ttf');
	$font3=realpath('ARLRDBD.ttf');
	$image=imagecreatefromjpeg('ecert.jpg');
	$color=imagecolorallocate($image,234,124,65);
	while($row=mysqli_fetch_assoc($res)){
	$name="Nishanthini";
	imagettftext($image,35,0,85,370,$color,$font,$name);
	$course=$row['item'];
	imagettftext($image,38,0,85,510,$color,$font2,$course);
	$date=$row['dates'];
	imagettftext($image,20,0,85,625,$color,$font3,$date);
	$instructor=$row['instructor_name'];
	imagettftext($image,21,0,330,678,$color,$font3,$instructor);
	imagejpeg($image, "testcert/$date.jpg");
	imagedestroy($image);
}
?>