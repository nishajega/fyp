<?php
require('connection.php');
require('../functions.php');

$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$phonenum=get_safe_value($con,$_POST['phonenum']);
$password=get_safe_value($con,$_POST['password']);

$check_user=mysqli_num_rows(mysqli_query($con, "select * from users_front where email='$email'"));
if($check_user>0){
	echo "email_present";
}else{
	mysqli_query($con, "INSERT INTO users_front(name, email, password, phonenum) values('$name','$email','$password','$phonenum')");
	echo "insert";
}

?>