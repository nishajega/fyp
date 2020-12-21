<?php
include('connection.php');
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$res = mysqli_query($con, "select * from users_front where email='$email' and password='$password'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($res);
		$_SESSION['name'] = $row['name'];
		
		echo "done";
		header('Location: cart.php');
	}
} else {
	echo "Please enter correct login details";
}

?>