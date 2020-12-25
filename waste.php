<?php
require_once('vendor/autoload.php');

$stripe = [
  $secret_key = "sk_test_51Hj5MzB8kJYNGv8XHRsaFwKs5qeftEKZ8yDu9S9tPZ35CD8LrxfrO1urJP0fF1zgZhtqY0b0yUgsnnB7TGFXLKHC00cgLMo8GG",
  $publishable_key = "pk_test_51Hj5MzB8kJYNGv8XYWUopeRBNqYgbgglAvKs5uUcK7mUCFbhEDDouR1Dja4BhZnR5nvBIObrS5l7VhVKNwcWrROg00WUFYgVPW",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>


if(isset($_POST['submit'])){
	$address=get_safe_value($con,$_POST['address']);
	$city=get_safe_value($con,$_POST['city']); 
	$postcode=get_safe_value($con,$_POST['postcode']); 
	$payment_type=get_safe_value($con,$_POST['payment_type']);
	$user_name=$_SESSION['name'];
	foreach($_SESSION['cart'] as $key => $val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$quantity=$val['quantity'];
		$cart_total=$cart_total+($price*$quantity);
	}
	$total_price= $cart_total;
	$payment_status='pending';
	if($payment_type=='Bank-In'){
		$payment_status='Success';
	}
	$order_status='1';
	$added_on=date('Y-m-d h:i:s');
	
	mysqli_query($con, "insert into `ordered`(user_name, address, city, postcode, payment_type, total_price, payment_status, order_status, added_on) values
	('$user_name', '$address', '$city', '$postcode', '$payment_type', '$total_price', '$payment_status', '$order_status', '$added_on')");

	$order_id=mysqli_insert_id($con);
	
	foreach($_SESSION['cart'] as $key => $val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$quantity=$val['quantity'];
	
		mysqli_query($con, "insert into order_detail(order_id, product_id, quantity, price) values
		('$order_id', '$key', '$quantity', '$price')");
	}
	
	unset($_SESSION['cart'])
	?>
	<script>
		window.location.href='thank_you.php';
	</script>
	<?php
	
	
}