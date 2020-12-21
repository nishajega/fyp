<?php
require('connection.php');
$msg="";
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$icnum=$_POST['icnum'];
	$phonenum=$_POST['phonenum'];
	
	$check= mysqli_num_rows(mysqli_query($con, "select * from instructor where email='$email'"));
		
	if($check>0){
		$msg= "Email ID already exists";
	}else{
		$verification_id=rand(111111111, 999999999);
		
		mysqli_query($con, "insert into instructor(name, email, password, icnum, phonenum, verification, verification_id) 
		values('$name','$email','$password','$icnum','$phonenum', 0, '$verification_id')");
		
		$msg="Verification link has been sent to <strong>$email</strong>.";
		
		$mailHtml="Please confirm your account registration by clicking the link below: <a href='
		http://localhost/fyp/instructor/check.php?id=$verification_id'>
		http://localhost/fyp/instructor/check.php?id=$verification_id</a>";
		
		smtp_mailer($email,'Account Verification',$mailHtml);	
	}
		
		
}

function smtp_mailer($to,$subject, $msg){
	include("smtp/PHPMailerAutoload.php");
	$mail = new PHPMailer(true); 
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 1; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "amrantamrun@gmail.com";
	$mail->Password = "farhanhelmy12";
	$mail->SetFrom("amrantamrun@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	if(!$mail->Send()){
		return 0;
	}else{
		return 1;
	}
}




?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Creative - Start Bootstrap Theme</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
        
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
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
			width: 800px;
			height: 480px;
			padding: 20px 20px;
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
		.field_error{
			color:red;
			margin-top:9px;
			text-align: center;
		}
		.error{
			color: red;
			font-style:italic;
		}
	</style>
    </head>
<body>
	<div class="thing">
		<h3>Welcome Instructors!</h3> 
		<h5 style="color: white; text-align:center;">Please register yourselves and get access!</h5>
	<form method="post" name="myForm" id="myForm">
	    <div class="instr">
		<hr>	
		<div class="field_error">
		<?php
		echo $msg
		?>
		</div>
	<div class="row">
             <div class="column">
		
    		<input type="text" placeholder="Enter Full Name" name="name" id="name" style="text-transform: uppercase" required>

    		<input type="email" placeholder="Enter Email" name="email" id="email" required>

    		<input type="password" placeholder="Enter Password" name="password" id="password" required>
			
   	     </div>
    	     <div class="column">
		<input type="text" placeholder="Staff ID" name="icnum" id="icnum" required>

		<input type="integer" placeholder="Phone Number" name="phonenum" id="phonenum" required>

		<button type="submit" value="submit" name="submit">SUBMIT</button>
		<p style="color:red; text-align:center; margin:10px;">Already have an account?  <a href="login.php">Sign In</a></p>
		</div>
		</div>
	</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script type="text/javascript">
	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Space are not allowed");
	$.validator.addMethod("noNumeric", function(value, element){
		return this.optional(element) || value.match(/.*[a-zA-Z].*/);
	}, "Only alphabetic characters allowed");
	$.validator.addMethod("noEmail", function(value, element){
		return this.optional(element) || value.match(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
	}, "Please enter a valid email address");
	// Wait for the DOM to be ready
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("#myForm").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            name: {
                required: true,
				noNumeric: true,
				minlength:3,
				noSpace: true
            },
            email: {
				noSpace: true,
				noEmail: true
            },
            password: {
                required: true,
				minlength:6,
				noSpace: true
            },
            icnum: {
                required: true,
				noSpace: true
            },
            phonenum: {
                required: true,
                number: true,
				minlength:10,
				maxlength:11,
				noSpace: true
            }

        },
        // Specify validation error messages
        messages: {
            name: {
                required: "Please enter name",
				number: "No numeric is allowed"
            },
            password: {
                required: "Password is required",
				minlength:"Password must be at least 6 characters long"
            },
            icnum: {
                required: "Please enter your staff ID",
            },
            phonenum: {
                required: "Please enter your phone num",
                number: "Enter numeric value only",
				minlength: "Enter valid phone number",
				maxlength: "Enter valid phone number"
            }
		},
		errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function (form) {
            form.submit();
        }
	});

</script>

</body>
</html>