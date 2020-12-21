<?php
include('connection.php');
if (isset($_POST['email']) && $_POST['password']) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$res = mysqli_query($con, "select * from instructor where email='$email' and password='$password'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($res);
		$_SESSION['instructor_name'] = $row['name'];
		$verification = $row['verification'];
		$status = $row['status'];
		if ($status == 'disabled') {
			echo "Your account is disabled";
		} else {
			if ($verification == 0) {
				echo "You have not confirmed your account yet. Please check your inbox and verify your email id.";
			} else {
				echo "done";
				$_SESSION['IS_LOGIN'] = 1;
			}
		}
	} else {
		echo "Please enter correct login details";
	}
}
