<?php
require('user_header.php');
require('connection.php');
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact || Asbab - eCommerce HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">
	<style>
		.field_error{
			color:red;
		}
	</style>

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>
<!-- Start Contact Area -->
        <section class="htc__contact__area ptb--10 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="field_error" id="login_email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="field_error" id="login_password_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="user_login()">Login</button>
										<a class="field_error" href="forgot_password.php">Forgot Password?</a>
									</div>
								</form>
								<div class="form-output login_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
				

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="register-form" action="#" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="field_error" id="email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="phonenum" id="phonenum" placeholder="Your Mobile*" style="width:100%">
										</div>
										<span class="field_error" id="phone_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="field_error" id="password_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="user_register()">Register</button>
									</div>
								</form>
								<div class="form-output register_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
        <!-- End Contact Area -->
		
		<script src="js/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/ajax-mail.js"></script>

    
    <!-- Waypoints.min.js. -->
    <script src="js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>
	<script>
	function user_register(){
	jQuery('.field_error').html('');
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var phonenum=jQuery("#phonenum").val();
	var password=jQuery("#password").val();
	var regex = /^\S+@\S+\.\S+$/;
	var regex2 = /^[a-zA-Z\s]+$/; 
	var is_error='';
	if(regex2.test(name)== false){
		jQuery('#name_error').html('Please enter a valid name');
		is_error='yes';
	}if(regex.test(email)== false || email.length<6){
		jQuery('#email_error').html('Valid email is required');
		is_error='yes';
	}if(isNaN(phonenum) || phonenum.length < 10 || phonenum.length > 11){
		jQuery('#phone_error').html('Please enter a valid phone number');
		is_error='yes';
	}if(password=="" || password.length<6){
		jQuery('#password_error').html('A strong password is required');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'register.php',
			type:'post',
			data:'name='+name+'&email='+email+'&phonenum='+phonenum+'&password='+password,
			success:function(result){
				if(result=='email_present'){
					jQuery('#email_error').html('Email already exists');
				}
				if(result=='insert'){
					jQuery('.register_msg p').html('Thank you for registration');
				}
			}
		
		});
	}	
}

function user_login(){
	jQuery('.field_error').html('');
	var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';
	var regex = /^\S+@\S+\.\S+$/;
	if(regex.test(email)== false || email.length < 6){
		jQuery('#login_email_error').html('Email is required');
		is_error='yes';
	}if(password==""){
		jQuery('#login_password_error').html('Password is required');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				if(result=='wrong'){
					jQuery('.login_msg p').html('Please enter valid login details');
				}
				if(result=='valid'){
					window.location.href='../index.php';
				}
			}
		
		});
	}
		
}
	</script>

</body>

</html>