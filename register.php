<?php
include('connection.php');

$msg = "";
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phonenum = $_POST['phonenum'];
    $msg="Thank you For Registering to our SYSTEM!";
	$check = mysqli_num_rows(mysqli_query($con, "select * from users_front where email='$email'"));

	if ($check > 0) {
		$msg = "Email already exists.";
	} else {
	     mysqli_query($con, "INSERT INTO users_front(name, email, password, icnum, phonenum) values('$name','$email','$password','$icnum','$phonenum')");
		//$row_res = mysqli_num_rows($res_query);
		header('location:check.php');
	}
}
?>