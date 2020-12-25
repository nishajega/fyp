<?php
require('top.php');
require('functions.php');
require_once('config.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
	?>
	<script>
		window.location.href='index.php';
	</script>
	<?php
}

$cart_total=0;

if(isset($_POST['submit'])){
	$address=get_safe_value($con,$_POST['address']);
	$city=get_safe_value($con,$_POST['city']); 
	$postcode=get_safe_value($con,$_POST['postcode']); 
	$user_name=$_SESSION['name'];
	foreach($_SESSION['cart'] as $key => $val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$quantity=$val['quantity'];
		$cart_total=$cart_total+($price*$quantity);
	}
	$total_price= $cart_total;
	$payment_status='pending';
	$order_status='1';
	$added_on=date('Y-m-d h:i:s');
	
	mysqli_query($con, "insert into `ordered`(user_name, address, city, postcode, total_price, payment_status, order_status, added_on) values
	('$user_name', '$address', '$city', '$postcode', '$total_price', '$payment_status', '$order_status', '$added_on')");

	$order_id=mysqli_insert_id($con);
	
	foreach($_SESSION['cart'] as $key => $val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$quantity=$val['quantity'];
	
		mysqli_query($con, "insert into order_detail(order_id, product_id, quantity, price) values
		('$order_id', '$key', '$quantity', '$price')");
	}
	
	
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cart || Asbab - eCommerce HTML5 Template</title>
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
	<link rel="stylesheet" href="css/custom.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
	<style>
	h2{
		margin-left:60px;
		margin-top: 80px;
		font-size: 40px;
		font-weight: bold;
	}
	.product-name{
		font-weight: bold;
	}
	
	.field_error{
		color:red;
	}
	
	</style>
    <!-- Modernizr JS -->
    <script src="user/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
<div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    
									<?php 
									$accordion_class='accordion__title';
									if(!isset($_SESSION['name'])){ 
									$accordion_class='accordion__hide';
									?>
									<div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="login-form" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <label>Email Address</label>
                                                                <input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
																<span class="field_error" id="login_email_error"></span>
															</div>
															
                                                            <div class="single-input">
                                                                <label>Password</label>
                                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
																<span class="field_error" id="login_password_error"></span>
															</div>
															
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                            </div>
                                                        </form>
														<div class="form-output login_msg">
															<p class="form-messege field_error"></p>
														</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="register-form" method="post">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Name</label>
                                                                <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
																<span class="field_error" id="name_error"></span>
															</div>
															<div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
																<span class="field_error" id="email_error"></span>
															</div>
															
                                                            <div class="single-input">
                                                                <label for="user-pass">Phone Number</label>
                                                                <input type="text" name="phonenum" id="phonenum" placeholder="Your Mobile*" style="width:100%">
																<span class="field_error" id="phone_error"></span>
															</div>
															
															<div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                            	<input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
																<span class="field_error" id="password_error"></span>
															</div>
                                                            <div class="dark-btn">
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
                                    </div>
									<?php } ?>
									
									
									<?php 
									if(!isset($_POST['submit'])){ 
									$accordion_class='accordion__hide';
									?>
                                    <div class="<?php echo $accordion_class ?>">
                                        Address Information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                            <form method="post">
                                                <div class="row">
                                        
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address" placeholder="Address" required>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="State" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="int" name="postcode" placeholder="Post code/ zip" required>
                                                        </div>
                                                    </div>
                                                  
                                                </div><br/>
                                        </div>
										<input type="submit" name="submit"/>
											</form>
                                    </div>
									<?php } ?>
									
                                    <div class="accordion__hide">
                                        payment information 
										(Debit/Credit Card)
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
												<form action="complete.php" method="post">
													<script
														src="https://checkout.stripe.com/checkout.js" class="stripe-button"
														data-key="<?php echo $publishable_key?>"
														data-amount="<? $total_price ?>00"
														data-name="Executive Education Programmes"
														data-description="Short Courses"
														data-image="image/logo.png"
														data-currency="myr"
														data-locale="auto"
													>
													</script>
												<input type="hidden" value="<?= $total_price ?>00" name="stripe-amount">
												<input type="hidden" value="OrderID: <?= $order_id ?> User Name: <?= $_SESSION['name'] ?>" name="stripe-desc">
												</form>
                                            </div>
											<div class="single-method">
												
											</div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                                <?php
									$cart_total=0;
									foreach($_SESSION['cart'] as $key => $val){
									$productArr=get_product($con,'','',$key);
									$pname=$productArr[0]['name'];
									$price=$productArr[0]['price'];
									$quantity=$val['quantity'];
									$cart_total=$cart_total+($price*$quantity);
								?>
                                <div class="single-item">
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname ?></a>
                                        <span class="price">RM <?php echo $price*$quantity ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
									<?php } ?>
                            </div>
                            <div class="ordre-details__total">
                                <h5>Total</h5>
                                <span class="price">RM <?php echo $cart_total ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->

<script src="user/js/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
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
	var is_error='';
	if(name==""){
		jQuery('#name_error').html('Name is required');
		is_error='yes';
	}if(email==""){
		jQuery('#email_error').html('Email is required');
		is_error='yes';
	}if(phonenum==""){
		jQuery('#phone_error').html('Phone number is required');
		is_error='yes';
	}if(password==""){
		jQuery('#password_error').html('Password is required');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'user/register.php',
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
	if(email==""){
		jQuery('#login_email_error').html('Email is required');
		is_error='yes';
	}if(password==""){
		jQuery('#login_password_error').html('Password is required');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'user/login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				if(result=='wrong'){
					jQuery('.login_msg p').html('Please enter valid login details');
				}
				if(result=='valid'){
					window.location.href=window.location.href;
				}
			}
		
		});
	}
		
}
</script>
</body>

</html>