<?php
require('connection.php');
require('functions.php');
$msg=' ';
if(isset($_POST['submit'])){
	$username=get_safe_value($con, $_POST['username']);
	$password=get_safe_value($con, $_POST['password']);
	$sql= "select * from adminlogin where username='$username' and password='$password'";
	$res= mysqli_query($con, $sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']=$username;
		header('location:index.php');
		die();
	}else{
		$msg="Please enter valid login details";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Page</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Third party plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/sb-admin-2.css" rel="stylesheet">
	<style>
		body{
			margin: 0;
			padding: 0;
			background: url("img/bg-masthead.jpg");
			background-size: cover;
		}
		
		.thing{
			position: relative;
			top: 280px;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 350px;
			height: 450px;
			padding: 20px 40px;
			box-sizing: border-box;
			background: rgba(0,0,0,0.5);
		}
	
		.thing h2, h3{
			text-align: center;
			color: white;
			font-family: Impact, Charcoal, sans-serif;
		}
		.thing input[type=text], input[type=password]{
		  width: 100%;
		  padding: 15px;
		  margin: 5px 0 22px 0;
		  display: inline-block;
		  border: none;
		  background: #f1f1f1;
		}
		button{
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			border: none;
			cursor: pointer;
			width: 100%;
		}

		button:hover
		{
			opacity: 0.8;
		}
		.field_error{
			color:red;
			margin-top:9px;
			text-align: center;
		}
		
	</style>
    </head>
<body>
	<div class="thing">
	<form method="post">
	<h3>Hello, ADMIN!</h3>
	<h2>LOG IN HERE</h2>
	<hr>
    	<input type="text" placeholder="Enter Admin ID" name="username" required>

    	<input type="password" placeholder="Enter Password"  name="password" required>
		
	<hr>
	<button type="submit" name="submit">
	LOG IN</button>
	<div class="field_error"><?php echo $msg ?></div>
	</form>
	
	</div>

</body>
</html>