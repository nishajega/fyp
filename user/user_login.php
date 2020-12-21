<?php
include('connection.php');
if (isset($_POST['email']) && $_POST['password']) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$res = mysqli_query($con, "select * from users_front where email='$email' and password='$password'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($res);
		$_SESSION['user_login'] = 'yes';
		$_SESSION['name'] = $row['name'];
		
		echo "done";
		header('Location: ../index.php');
	}
} else {
	$msg="Please enter valid login details";
}

?>