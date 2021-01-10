<!DOCTYPE html>
<html lang="en">

    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Creative - Start Bootstrap Theme</title>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="css/sb-admin-2.css" rel="stylesheet" />
	<style>
		body{
			margin: 0;
			padding: 0;
			background: url("img/uniten2.jpg");
			background-size: cover;
		}
		
		.thing{
			position: relative;
			top: 280px;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 350px;
			height: 510px;
			padding: 20px 40px;
			box-sizing: border-box;
			background: rgba(0,0,0,0.5);
		}
	
		.thing h2, h3{
			text-align: center;
			color: white;
			font-family: Impact, Charcoal, sans-serif;
		}
		.thing input[type=text], input[type=password], input[type=email]{
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
		.message{
			color:red;
			margin-top:3px;
			text-align: center;
			background-color: white;
		}
		.field_error{
			color:red;
		}
		
	</style>
    </head>
<body>
	<div class="thing">
	<form method="post">
	<h3>Hello, INSTRUCTOR!</h3>
	<h2>LOG IN HERE</h2>
	<hr>
	 <div>
		<span class="field_error" id="email_error"></span>
    	<input type="email" placeholder="Enter Email" name="email" id="email" required>
	</div>
	<div>
		<span class="field_error" id="password_error"></span>
    	<input type="password" placeholder="Enter Password" name="password" id="password" required>
		</div>
		<div class="message"></div>
	<hr>
	<button type="button" onclick="login_now()">LOG IN</button>
	<p style="color:red; text-align:center; margin:10px;">Dont have account?  <a href="register.php">Register</a></p>
	</form>
	</div>
	
	<script>
	function login_now(){
		jQuery('.field_error').html('');
		var email=jQuery('#email').val();
		var password=jQuery('#password').val();
		var regex = /^\S+@\S+\.\S+$/;
		var is_error='';
		if(regex.test(email)== false || email==""){
		jQuery('#email_error').html('Valid email is required');
		is_error='yes';
		}if(password==""){
		jQuery('#password_error').html('Password is required');
		is_error='yes';
		}
		if(is_error==''){
		jQuery.ajax({
			url:'login_check.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				if(result=='done'){
					window.location.href='index.php';
				}
				jQuery('.message').html(result);
			}
		});
	}
	}
	</script>

</body>
</html>